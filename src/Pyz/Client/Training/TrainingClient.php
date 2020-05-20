<?php declare(strict_types = 1);

namespace Pyz\Client\Training;

use Generated\Shared\Transfer\ProductViewTransfer;
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
        return $this->getFactory()->getCustomerPrice()->extendsPricesForProductView($productViewTransfer, $productData, $localeName);
    }

    /**
     * @param int $idProductAbstract
     *
     * @return \Generated\Shared\Transfer\PriceProductTransfer[]
     * @throws \Spryker\Client\Kernel\Exception\Container\ContainerKeyNotFoundException
     */
    public function extendPriceForProductAbstract(int $idProductAbstract): array
    {
        return $this->getFactory()->getCustomerPrice()->extendPriceForProductAbstract($idProductAbstract);
    }
}
