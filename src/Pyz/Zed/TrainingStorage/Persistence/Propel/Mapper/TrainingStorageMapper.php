<?php declare(strict_types = 1);

namespace Pyz\Zed\TrainingStorage\Persistence\Propel\Mapper;

use Generated\Shared\Transfer\TrainingStorageItemTransfer;
use Orm\Zed\TrainingStorage\Persistence\PyzTrainingPriceItemStorage;

class TrainingStorageMapper
{
    /**
     * @param \Orm\Zed\TrainingStorage\Persistence\PyzTrainingPriceItemStorage $entity
     *
     * @return \Generated\Shared\Transfer\TrainingStorageItemTransfer
     */
    public function transferEntityToTransfer(?PyzTrainingPriceItemStorage $entity): TrainingStorageItemTransfer
    {
        $transfer = new TrainingStorageItemTransfer();

        if (null === $entity) {
            return $transfer;
        }

        $transfer->fromArray($entity->toArray(), true);

        return $transfer;
    }
}
