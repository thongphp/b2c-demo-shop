<?php declare(strict_types = 1);

namespace Pyz\Zed\TrainingStorage\Persistence;

use Orm\Zed\TrainingStorage\Persistence\PyzTrainingPriceItemStorageQuery;
use Pyz\Zed\TrainingStorage\Persistence\Propel\Mapper\TrainingStorageMapper;
use Spryker\Zed\Kernel\Persistence\AbstractPersistenceFactory;

class TrainingStoragePersistenceFactory extends AbstractPersistenceFactory
{
    /**
     * @return \Orm\Zed\TrainingStorage\Persistence\PyzTrainingPriceItemStorageQuery
     */
    public function createTrainingStorageQuery(): PyzTrainingPriceItemStorageQuery
    {
        return PyzTrainingPriceItemStorageQuery::create();
    }

    /**
     * @return \Pyz\Zed\TrainingStorage\Persistence\Propel\Mapper\TrainingStorageMapper
     */
    public function createTrainingStorageMapper(): TrainingStorageMapper
    {
        return new TrainingStorageMapper();
    }
}
