<?php declare(strict_types = 1);

namespace Pyz\Zed\Training\Persistence;

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
     *
     * @throws \Propel\Runtime\Exception\PropelException
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function saveTrainingPriceItemEntity(TrainingPriceItemTransfer $trainingPriceItemTransfer): TrainingPriceItemTransfer
    {
        $query = $this->getFactory()
            ->createTrainingPriceItemQuery();

        $trainingPriceItemEntity = $query->filterByItemNumber($trainingPriceItemTransfer->getItemNumber())
            ->filterByCustomerNumber($trainingPriceItemTransfer->getCustomerNumber())
            ->filterByQuantity($trainingPriceItemTransfer->getQuantity())
            ->findOneOrCreate();

        $trainingPriceItemEntity->setPrice($trainingPriceItemTransfer->getPrice());
        $result = $trainingPriceItemEntity->save();

        if (!$result) {
            return $trainingPriceItemTransfer;
        }

        $trainingPriceItemTransfer->fromArray($trainingPriceItemEntity->toArray(), true);

        return $trainingPriceItemTransfer;
    }
}
