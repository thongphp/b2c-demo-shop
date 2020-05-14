<?php declare(strict_types = 1);

namespace Pyz\Client\Training\Model;

use Generated\Shared\Transfer\ProductViewTransfer;

interface CustomerPriceInterface
{
    /**
     * @param int $idProductAbstract
     *
     * @return \Generated\Shared\Transfer\PriceProductTransfer[]
     */
    public function extendPriceForProductAbstract(int $idProductAbstract): array;

    /**
     * @param \Generated\Shared\Transfer\ProductViewTransfer $productViewTransfer
     * @param array $productData
     * @param string $localeName
     *
     * @return \Generated\Shared\Transfer\ProductViewTransfer
     * @throws \Spryker\Client\Kernel\Exception\Container\ContainerKeyNotFoundException
     */
    public function extendsPricesForProductView(ProductViewTransfer $productViewTransfer, array $productData, string $localeName): ProductViewTransfer;
}
