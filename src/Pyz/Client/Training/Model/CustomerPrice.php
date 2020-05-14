<?php declare(strict_types = 1);

namespace Pyz\Client\Training\Model;

use Generated\Shared\Transfer\MoneyValueTransfer;
use Generated\Shared\Transfer\PriceProductDimensionTransfer;
use Generated\Shared\Transfer\PriceProductTransfer;
use Generated\Shared\Transfer\ProductViewTransfer;
use Generated\Shared\Transfer\TrainingStorageItemTransfer;
use Pyz\Client\Training\Storage\PriceItemStorageReaderInterface;
use Pyz\Client\Training\TrainingConfig;
use Pyz\Shared\Training\TrainingConstants;
use Spryker\Client\Cart\CartClientInterface;
use Spryker\Client\Currency\CurrencyClientInterface;
use Spryker\Client\Customer\CustomerClientInterface;
use Spryker\Client\Locale\LocaleClientInterface;

class CustomerPrice implements CustomerPriceInterface
{
    /** @var \Pyz\Client\Training\Storage\PriceItemStorageReaderInterface */
    private $storageReader;

    /** @var \Spryker\Client\Currency\CurrencyClientInterface */
    private $currencyClient;

    /** @var \Spryker\Client\Locale\LocaleClientInterface */
    private $localeClient;

    /** @var \Spryker\Client\Customer\CustomerClientInterface */
    private $customerClient;

    /** @var \Spryker\Client\Cart\CartClientInterface */
    private $cartClient;

    /** @var \Pyz\Client\Training\TrainingConfig */
    private $config;

    /**
     * @param \Pyz\Client\Training\Storage\PriceItemStorageReaderInterface $storageReader
     * @param \Spryker\Client\Currency\CurrencyClientInterface $currencyClient
     * @param \Spryker\Client\Locale\LocaleClientInterface $localeClient
     * @param \Spryker\Client\Customer\CustomerClientInterface $customerClient
     * @param \Spryker\Client\Cart\CartClientInterface $cartClient
     * @param \Pyz\Client\Training\TrainingConfig $config
     */
    public function __construct(
        PriceItemStorageReaderInterface $storageReader,
        CurrencyClientInterface $currencyClient,
        LocaleClientInterface $localeClient,
        CustomerClientInterface $customerClient,
        CartClientInterface $cartClient,
        TrainingConfig $config
    ) {
        $this->storageReader = $storageReader;
        $this->currencyClient = $currencyClient;
        $this->localeClient = $localeClient;
        $this->customerClient = $customerClient;
        $this->cartClient = $cartClient;
        $this->config = $config;
    }

    /**
     * @param int $idProductAbstract
     *
     * @return \Generated\Shared\Transfer\PriceProductTransfer[]
     */
    public function extendPriceForProductAbstract(int $idProductAbstract): array
    {
        $priceItemStorageTransfer = $this->storageReader->findData(
            $this->getCustomerNumber(),
            $idProductAbstract,
            $this->localeClient->getCurrentLocale()
        );

        if (!$priceItemStorageTransfer) {
            return [];
        }

        $priceProductTransfers = [];

        $priceProductDimensionTransfer = new PriceProductDimensionTransfer();
        $priceProductDimensionTransfer->setType(TrainingConstants::DEFAULT_PRICE_DIMENSION_NAME);
        $priceProductDimensionTransfer->setName(TrainingConstants::DEFAULT_PRICE_DIMENSION_NAME);

        $currencyTransfer = $this->currencyClient->getCurrent();

        foreach ($priceItemStorageTransfer->getPrices() as $price) {
            $newPrice = $price[TrainingConstants::DATA_PRICE_VALUE_KEY] * 100;

            $moneyValueTransfer = new MoneyValueTransfer();
            $moneyValueTransfer->setCurrency($currencyTransfer)
                ->setNetAmount($newPrice)
                ->setGrossAmount($newPrice);

            $priceProductTransfer = new PriceProductTransfer();
            $priceProductTransfer->setPriceTypeName('DEFAULT');
            $priceProductTransfer->setPriceDimension($priceProductDimensionTransfer);
            $priceProductTransfer->setIdProductAbstract($idProductAbstract);
            $priceProductTransfer->setMoneyValue($moneyValueTransfer);
            $quantity = $price[TrainingConstants::DATA_PRICE_QUANTITY_KEY] === 1 ? 0 : $price[TrainingConstants::DATA_PRICE_QUANTITY_KEY];
            $priceProductTransfer->setVolumeQuantity($quantity);

            $priceProductTransfers[] = $priceProductTransfer;
        }

        return $priceProductTransfers;
    }

    /**
     * @param \Generated\Shared\Transfer\ProductViewTransfer $productViewTransfer
     * @param array $productData
     * @param string $localeName
     *
     * @return \Generated\Shared\Transfer\ProductViewTransfer
     * @throws \Spryker\Client\Kernel\Exception\Container\ContainerKeyNotFoundException
     */
    public function extendsPricesForProductView(ProductViewTransfer $productViewTransfer, array $productData, string $localeName): ProductViewTransfer
    {
        $priceItemStorageTransfer = $this->storageReader->findStorageData(
            $this->getCustomerNumber(),
            $productViewTransfer,
            $localeName
        );

        if (!$priceItemStorageTransfer) {
            return $productViewTransfer;
        }

        $itemQuantityInCart = $this->getItemQuantityInCart($productViewTransfer);
        $itemQuantityInCart = $itemQuantityInCart ?? 1;

        $newPrice = $this->selectPriceBaseOnQuantity($priceItemStorageTransfer, $itemQuantityInCart);

        if (null === $newPrice) {
            return $productViewTransfer;
        }

        $productViewTransfer->setPrice($newPrice);
        $productViewTransfer->getCurrentProductPrice();

        return $productViewTransfer;
    }

    private function getCustomerNumber(): string
    {
        $customer = $this->customerClient->getCustomer();

        if (null === $customer) {
            return $this->config->getDefaultCustomerNumber();
        }

        return (string) $customer->getIdCustomer();
    }

    /**
     * @param \Generated\Shared\Transfer\ProductViewTransfer $productViewTransfer
     *
     * @return int|null
     * @throws \Spryker\Client\Kernel\Exception\Container\ContainerKeyNotFoundException
     */
    private function getItemQuantityInCart(ProductViewTransfer $productViewTransfer): ?int
    {
        $quoteTransfer = $this->cartClient->getQuote();
        $itemTransfer = $this->cartClient->findQuoteItem($quoteTransfer, $productViewTransfer->getSku());

        if (!$itemTransfer) {
            return null;
        }

        return null === $itemTransfer->getQuantity() ? null : (int) $itemTransfer->getQuantity();
    }

    /**
     * @param \Generated\Shared\Transfer\TrainingStorageItemTransfer $storageItemTransfer
     * @param int $itemQuantityInCart
     *
     * @return int|null
     */
    private function selectPriceBaseOnQuantity(TrainingStorageItemTransfer $storageItemTransfer, int $itemQuantityInCart): ?int
    {
        $prices = $storageItemTransfer->getPrices();
        $correctPrice = null;
        $defaultPrice = null;

        foreach ($prices as $price) {
            if ($price[TrainingConstants::DATA_PRICE_QUANTITY_KEY] === 1) {
                $defaultPrice = $price[TrainingConstants::DATA_PRICE_VALUE_KEY];
            }

            if ($price[TrainingConstants::DATA_PRICE_QUANTITY_KEY] === $itemQuantityInCart) {
                $correctPrice = $price[TrainingConstants::DATA_PRICE_VALUE_KEY];
                break;
            }
        }

        $correctPrice = $correctPrice ?? $defaultPrice;

        return null === $correctPrice ? null : (int) ($correctPrice * 100);
    }
}
