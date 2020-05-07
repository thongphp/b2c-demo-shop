<?php declare(strict_types = 1);

namespace Pyz\Zed\TrainingStorage\Persistence;

use Orm\Zed\TrainingStorage\Persistence\PyzTrainingPriceItemStorageQuery;
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
}
