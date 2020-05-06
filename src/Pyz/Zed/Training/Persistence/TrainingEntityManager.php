<?php declare(strict_types = 1);

namespace Pyz\Zed\Training\Persistence;

use Generated\Shared\Transfer\PyzTrainingPriceItemEntityTransfer;
use Generated\Shared\Transfer\TrainingPriceItemTransfer;
use Spryker\Zed\Kernel\Persistence\AbstractEntityManager;

class TrainingEntityManager extends AbstractEntityManager implements TrainingEntityManagerInterface
{
    /**
     * @param \Generated\Shared\Transfer\TrainingPriceItemTransfer $trainingPriceItemTransfer
     *
     * @return \Generated\Shared\Transfer\TrainingPriceItemTransfer
     */
    public function saveTrainingPriceItemEntity(TrainingPriceItemTransfer $trainingPriceItemTransfer): TrainingPriceItemTransfer
    {
        $entity = new PyzTrainingPriceItemEntityTransfer();
        $entity->fromArray($trainingPriceItemTransfer->toArray());

        $entity = $this->save($entity);
        $trainingPriceItemTransfer->fromArray($entity->modifiedToArray(), true);

        return $trainingPriceItemTransfer;
    }
}
