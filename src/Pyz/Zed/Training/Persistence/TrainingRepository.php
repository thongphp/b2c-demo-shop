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
     * @return array|null
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function findByItemNumber(string $productId): ?array
    {
        $pyzTrainingPriceItemCollection = $this->getFactory()
            ->createTrainingPriceItemQuery()
            ->filterByItemNumber($productId)
            ->find();

        if (!$pyzTrainingPriceItemCollection->count()) {
            return null;
        }

        return $pyzTrainingPriceItemCollection->getData();
    }

    /**
     * @param string $customerNumber
     *
     * @return array|null
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function findByCustomerNumber(string $customerNumber): ?array
    {
        $pyzTrainingPriceItemCollection = $this->getFactory()
            ->createTrainingPriceItemQuery()
            ->filterByCustomerNumber($customerNumber)
            ->find();

        if (!$pyzTrainingPriceItemCollection->count()) {
            return null;
        }

        return $pyzTrainingPriceItemCollection->getData();
    }
}
