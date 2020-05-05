<?php declare(strict_types = 1);

namespace Pyz\Zed\Training\Persistence;

/**
 * @method \Pyz\Zed\Training\Persistence\TrainingPersistenceFactory getFactory()
 */
interface TrainingRepositoryInterface
{
    /**
     * @param string $productId
     *
     * @return array|null
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function findByItemNumber(string $productId): ?array;

    /**
     * @param string $customerNumber
     *
     * @return array|null
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function findByCustomerNumber(string $customerNumber): ?array;
}
