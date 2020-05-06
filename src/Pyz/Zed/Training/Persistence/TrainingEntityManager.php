<?php declare(strict_types = 1);

namespace Pyz\Zed\Training\Persistence;

use Generated\Shared\Transfer\PyzTrainingPriceItemEntityTransfer;
use Generated\Shared\Transfer\TrainingPriceItemTransfer;
use Spryker\Zed\Kernel\Persistence\AbstractEntityManager;

/**
 * @method \Pyz\Zed\Training\Persistence\TrainingPersistenceFactory getFactory()
 */
class TrainingEntityManager extends AbstractEntityManager implements TrainingEntityManagerInterface
{
    /**
     * @param \Generated\Shared\Transfer\TrainingPriceItemTransfer $trainingPriceItemTransfer
     *
     * @return \Generated\Shared\Transfer\TrainingPriceItemTransfer
     */
    public function saveEntity(TrainingPriceItemTransfer $trainingPriceItemTransfer): TrainingPriceItemTransfer
    {
        $query = $this->getFactory()
            ->createTrainingPriceItemQuery();

        $entity = $query->filterByItemNumber($trainingPriceItemTransfer->getItemNumber())
            ->filterByCustomerNumber($trainingPriceItemTransfer->getCustomerNumber())
            ->filterByQuantity($trainingPriceItemTransfer->getQuantity())
            ->findOneOrCreate();

        $entity->setPrice($trainingPriceItemTransfer->getPrice());
        $entity->save();

//        $entity = new PyzTrainingPriceItemEntityTransfer();
//        $entity->fromArray($trainingPriceItemTransfer->toArray());

//        $entity = $this->save($entity);
//        $trainingPriceItemTransfer->fromArray($entity->modifiedToArray(), true);

        return $trainingPriceItemTransfer;
    }
}
