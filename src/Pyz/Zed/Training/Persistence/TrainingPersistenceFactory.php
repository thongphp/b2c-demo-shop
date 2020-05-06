<?php declare(strict_types = 1);

namespace Pyz\Zed\Training\Persistence;

use Orm\Zed\Training\Persistence\PyzTrainingPriceItemQuery;
use Pyz\Zed\Training\Persistence\Propel\Mapper\TrainingMapper;
use Pyz\Zed\Training\Persistence\Propel\Mapper\TrainingMapperInterface;
use Spryker\Zed\Kernel\Persistence\AbstractPersistenceFactory;

/**
 * @method \Pyz\Zed\Training\Persistence\TrainingEntityManager getEntityManager()
 */
class TrainingPersistenceFactory extends AbstractPersistenceFactory
{
    /**
     * @return \Orm\Zed\Training\Persistence\PyzTrainingPriceItemQuery
     */
    public function createTrainingPriceItemQuery(): PyzTrainingPriceItemQuery
    {
        return PyzTrainingPriceItemQuery::create();
    }

    /**
     * @return TrainingMapperInterface
     */
    public function createTrainingMapperToTransfer(): TrainingMapperInterface
    {
        return new TrainingMapper();
    }
}
