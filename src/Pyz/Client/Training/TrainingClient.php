<?php declare(strict_types = 1);

namespace Pyz\Client\Training;

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
    public function extendPrices(ProductViewTransfer $productViewTransfer, array $productData, string $localeName): ProductViewTransfer
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

        return $productViewTransfer;
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
