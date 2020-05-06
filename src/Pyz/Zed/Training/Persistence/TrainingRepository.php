<?php declare(strict_types = 1);

namespace Pyz\Zed\Training\Persistence;

use Spryker\Zed\Kernel\Persistence\AbstractRepository;

/**
 * @method \Pyz\Zed\Training\Persistence\TrainingPersistenceFactory getFactory()
 */
class TrainingRepository extends AbstractRepository implements TrainingRepositoryInterface
{
    /**
     * @param string $productId
     *
     * @return \Generated\Shared\Transfer\TrainingPriceItemTransfer[]
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function findByItemNumber(string $productId): array
    {
        $pyzTrainingPriceItemCollection = $this->getFactory()
            ->createTrainingPriceItemQuery()
            ->filterByItemNumber($productId)
            ->find();

        return $this->getFactory()
            ->createTrainingMapperToTransfer()
            ->transferEntitiesToTransfers($pyzTrainingPriceItemCollection->getData());
    }

    /**
     * @param string $customerNumber
     *
     * @return \Generated\Shared\Transfer\TrainingPriceItemTransfer[]
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function findByCustomerNumber(string $customerNumber): array
    {
        $pyzTrainingPriceItemCollection = $this->getFactory()
            ->createTrainingPriceItemQuery()
            ->filterByCustomerNumber($customerNumber)
            ->find();

        return $this->getFactory()
            ->createTrainingMapperToTransfer()
            ->transferEntitiesToTransfers($pyzTrainingPriceItemCollection->getData());
    }
}
