<?php declare(strict_types = 1);

namespace Pyz\Client\Training;

use Generated\Shared\Transfer\MoneyValueTransfer;
use Generated\Shared\Transfer\PriceProductDimensionTransfer;
use Generated\Shared\Transfer\PriceProductTransfer;
use Generated\Shared\Transfer\ProductViewTransfer;
use Generated\Shared\Transfer\TrainingStorageItemTransfer;
use Pyz\Shared\Training\TrainingConstants;
use Spryker\Client\Kernel\AbstractClient;

/**
 * @method \Pyz\Client\Training\TrainingFactory getFactory()
 */
class TrainingClient extends AbstractClient implements TrainingClientInterface
{
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
        $storageReader = $this->getFactory()
            ->getStorageReader();

        $priceItemStorageTransfer = $storageReader->findStorageData(
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

    /**
     * @param int $idProductAbstract
     *
     * @return \Generated\Shared\Transfer\PriceProductTransfer[]
     * @throws \Spryker\Client\Kernel\Exception\Container\ContainerKeyNotFoundException
     */
    public function extendPriceForProductAbstract(int $idProductAbstract): array
    {
        $storageReader = $this->getFactory()
            ->getStorageReader();

        $priceItemStorageTransfer = $storageReader->findData(
            $this->getCustomerNumber(),
            $idProductAbstract,
            $this->getFactory()->getLocaleClient()->getCurrentLocale()
        );

        if (!$priceItemStorageTransfer) {
            return [];
        }

        $priceProductTransfers = [];

        $priceProductDimensionTransfer = new PriceProductDimensionTransfer();
        $priceProductDimensionTransfer->setType(TrainingConstants::DEFAULT_PRICE_DIMENSION_NAME);
        $priceProductDimensionTransfer->setName(TrainingConstants::DEFAULT_PRICE_DIMENSION_NAME);

        $currencyTransfer = $this->getFactory()->getCurrencyClient()->getCurrent();

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
     * @return string
     *
     * @throws \Spryker\Client\Kernel\Exception\Container\ContainerKeyNotFoundException
     */
    private function getCustomerNumber(): string
    {
        $customer = $this->getFactory()->getCustomerClient()->getCustomer();

        if (null === $customer) {
            return $this->getFactory()->getConfig()->getDefaultCustomerNumber();
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
        $quoteTransfer = $this->getFactory()->getCartClient()->getQuote();
        $itemTransfer = $this->getFactory()->getCartClient()->findQuoteItem($quoteTransfer, $productViewTransfer->getSku());

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
