<?php declare(strict_types = 1);

namespace Pyz\Client\Training\Plugin\PriceProductStorageExtension;

use Generated\Shared\Transfer\PriceProductDimensionTransfer;
use Generated\Shared\Transfer\PriceProductFilterTransfer;
use Generated\Shared\Transfer\ProductViewTransfer;
use Pyz\Shared\Training\TrainingConstants;
use Spryker\Client\Kernel\AbstractPlugin;
use Spryker\Client\PriceProductStorageExtension\Dependency\Plugin\PriceProductFilterExpanderPluginInterface;

class TrainingPriceProductFilterExpanderProviderPlugin extends AbstractPlugin implements PriceProductFilterExpanderPluginInterface
{
    /**
     * @param \Generated\Shared\Transfer\ProductViewTransfer $productViewTransfer
     * @param \Generated\Shared\Transfer\PriceProductFilterTransfer $priceProductFilterTransfer
     *
     * @return \Generated\Shared\Transfer\PriceProductFilterTransfer
     */
    public function expand(ProductViewTransfer $productViewTransfer, PriceProductFilterTransfer $priceProductFilterTransfer): PriceProductFilterTransfer
    {
        $priceDimension = new PriceProductDimensionTransfer();
        $priceDimension->setType(TrainingConstants::DEFAULT_PRICE_DIMENSION_NAME);

        $priceProductFilterTransfer->setPriceDimension($priceDimension);
        $priceProductFilterTransfer->setIdProductAbstract($productViewTransfer->getIdProductAbstract());

        return $priceProductFilterTransfer;
    }
}
