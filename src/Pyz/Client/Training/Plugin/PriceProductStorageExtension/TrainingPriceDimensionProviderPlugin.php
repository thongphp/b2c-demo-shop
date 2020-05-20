<?php declare(strict_types = 1);

namespace Pyz\Client\Training\Plugin\PriceProductStorageExtension;

use Pyz\Shared\Training\TrainingConstants;
use Spryker\Client\Kernel\AbstractPlugin;
use Spryker\Client\PriceProductStorageExtension\Dependency\Plugin\PriceProductStoragePriceDimensionPluginInterface;

/**
 * @method \Pyz\Client\Training\TrainingClientInterface getClient()()
 */
class TrainingPriceDimensionProviderPlugin extends AbstractPlugin implements PriceProductStoragePriceDimensionPluginInterface
{
    /**
     * @param int $idProductConcrete
     *
     * @return \Generated\Shared\Transfer\PriceProductTransfer[]
     */
    public function findProductConcretePrices(int $idProductConcrete): array
    {
        return [];
    }

    /**
     * @param int $idProductAbstract
     *
     * @return \Generated\Shared\Transfer\PriceProductTransfer[]
     */
    public function findProductAbstractPrices(int $idProductAbstract): array
    {
        return $this->getClient()->extendPriceForProductAbstract($idProductAbstract);
    }

    /**
     * @return string
     */
    public function getDimensionName(): string
    {
        return TrainingConstants::DEFAULT_PRICE_DIMENSION_NAME;
    }
}
