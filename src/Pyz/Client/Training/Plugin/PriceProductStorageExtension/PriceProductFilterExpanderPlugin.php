<?php declare(strict_types = 1);

namespace Pyz\Client\Training\Plugin\PriceProductStorageExtension;

use Generated\Shared\Transfer\PriceProductDimensionTransfer;
use Generated\Shared\Transfer\PriceProductFilterTransfer;
use Generated\Shared\Transfer\ProductViewTransfer;
use Spryker\Client\Kernel\AbstractPlugin;
use Spryker\Client\PriceProductStorageExtension\Dependency\Plugin\PriceProductFilterExpanderPluginInterface;

class PriceProductFilterExpanderPlugin extends AbstractPlugin implements PriceProductFilterExpanderPluginInterface
{
    public function expand(ProductViewTransfer $productViewTransfer, PriceProductFilterTransfer $priceProductFilterTransfer): PriceProductFilterTransfer
    {
        $priceDimension = new PriceProductDimensionTransfer();
        $priceDimension->setType('PRICE_DIMENSION_DEFAULT_TRAINING');

        $priceProductFilterTransfer->setPriceDimension($priceDimension);
        $priceProductFilterTransfer->setIdProductAbstract(30);

        return $priceProductFilterTransfer;
    }
}
