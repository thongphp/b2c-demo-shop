<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Client\PriceProductStorage;

use Pyz\Client\Training\Plugin\PriceProductStorageExtension\TrainingPriceProductFilterExpanderProviderPlugin;
use Pyz\Client\Training\Plugin\PriceProductStorageExtension\TrainingPriceDimensionProviderPlugin;
use Spryker\Client\PriceProductStorage\PriceProductStorageDependencyProvider as SprykerPriceProductStorageDependencyProvider;
use Spryker\Client\PriceProductVolume\Plugin\PriceProductStorageExtension\PriceProductVolumeExtractorPlugin;

class PriceProductStorageDependencyProvider extends SprykerPriceProductStorageDependencyProvider
{
    /**
     * @return \Spryker\Client\PriceProductStorageExtension\Dependency\Plugin\PriceProductStoragePricesExtractorPluginInterface[]
     */
    protected function getPriceProductPricesExtractorPlugins(): array
    {
        return [
            new PriceProductVolumeExtractorPlugin(),
        ];
    }

    public function getPriceDimensionStorageReaderPlugins(): array
    {
        $priceDimensionStorageReaderPlugins = parent::getPriceDimensionStorageReaderPlugins();

        $priceDimensionStorageReaderPlugins[] = new TrainingPriceDimensionProviderPlugin();

        return $priceDimensionStorageReaderPlugins;
    }

    protected function getPriceProductFilterExpanderPlugins(): array
    {
        $priceProductFilterExpanderPlugins = parent::getPriceProductFilterExpanderPlugins();

        $priceProductFilterExpanderPlugins[] = new TrainingPriceProductFilterExpanderProviderPlugin();

        return $priceProductFilterExpanderPlugins;
    }
}
