<?php declare(strict_types = 1);

namespace Pyz\Client\Training\Plugin\PriceProductStorageExtension;

use Generated\Shared\Transfer\ProductViewTransfer;
use Spryker\Client\Kernel\AbstractPlugin;
use Spryker\Client\ProductStorageExtension\Dependency\Plugin\ProductViewExpanderPluginInterface;

/**
 * @method \Pyz\Client\Training\TrainingClientInterface getClient()
 */
class ProductViewExpanderPlugin extends AbstractPlugin implements ProductViewExpanderPluginInterface
{
    /**
     * @param \Generated\Shared\Transfer\ProductViewTransfer $productViewTransfer
     * @param array $productData
     * @param string $localeName
     *
     * @return \Generated\Shared\Transfer\ProductViewTransfer|void
     */
    public function expandProductViewTransfer(ProductViewTransfer $productViewTransfer, array $productData, $localeName): ProductViewTransfer
    {
        return $this->getClient()->extendPrices($productViewTransfer, $productData, $localeName);
    }
}
