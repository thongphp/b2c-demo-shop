<?php declare(strict_types=1);

namespace Pyz\Client\Training\Plugin\PriceProductStorageExtension;

use Generated\Shared\Transfer\MoneyValueTransfer;
use Generated\Shared\Transfer\PriceProductDimensionTransfer;
use Generated\Shared\Transfer\PriceProductTransfer;
use Spryker\Client\Kernel\AbstractPlugin;
use Spryker\Client\PriceProductStorageExtension\Dependency\Plugin\PriceProductStoragePriceDimensionPluginInterface;

/**
 * @method \Pyz\Client\Training\TrainingFactory getFactory()
 */
class PriceDimensionPlugin extends AbstractPlugin implements PriceProductStoragePriceDimensionPluginInterface
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
        if ($idProductAbstract !== 30) {
            return [];
        }

        $priceDimensionTransfer = new PriceProductDimensionTransfer();
        $priceDimensionTransfer->setType('PRICE_DIMENSION_DEFAULT_TRAINING');

        $money = new MoneyValueTransfer();
        $money->setCurrency($this->getFactory()->getCurrencyClient()->getCurrent());
        $money->setNetAmount(9999);
        $money->setGrossAmount(8888);

        $priceProductTransfer = new PriceProductTransfer();
        $priceProductTransfer->setPriceTypeName('DEFAULT');
        $priceProductTransfer->setPriceDimension($priceDimensionTransfer);
        $priceProductTransfer->setIdProductAbstract(30);
        $priceProductTransfer->setMoneyValue($money);

        return [$priceProductTransfer];
    }

    public function getDimensionName(): string
    {
        return 'PRICE_DIMENSION_DEFAULT_TRAINING';
    }
}
