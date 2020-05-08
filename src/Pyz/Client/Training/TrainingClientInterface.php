<?php declare(strict_types = 1);

namespace Pyz\Client\Training;

use Generated\Shared\Transfer\ProductViewTransfer;

/**
 * @method \Pyz\Client\Training\TrainingFactory getFactory()
 */
interface TrainingClientInterface
{
    /**
     * @param \Generated\Shared\Transfer\ProductViewTransfer $productViewTransfer
     * @param array $productData
     * @param string $localeName
     *
     * @return \Generated\Shared\Transfer\ProductViewTransfer
     */
    public function extendPrices(ProductViewTransfer $productViewTransfer, array $productData, string $localeName): ProductViewTransfer;
}
