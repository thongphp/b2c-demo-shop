<?php declare(strict_types = 1);

namespace Pyz\Zed\Training\Business\Model\Reader;

use Pyz\Zed\Training\Persistence\TrainingRepositoryInterface;

class TrainingPriceItemReader implements TrainingPriceItemReaderInterface
{
    /** @var \Pyz\Zed\Training\Persistence\TrainingRepositoryInterface */
    private $repository;

    /**
     * @param \Pyz\Zed\Training\Persistence\TrainingRepositoryInterface $repository
     */
    public function __construct(TrainingRepositoryInterface $repository)
    {
        $this->repository = $repository;
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
        $entities = $this->repository->findByCustomerNumber($customerNumber);

        if (null === $entities) {
            return [];
        }

        return $entities;
    }

    /**
     * @param string $itemNumber
     *
     * @return \Generated\Shared\Transfer\TrainingPriceItemTransfer[]
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function findByItemNumber(string $itemNumber): array
    {
        $entities = $this->repository->findByItemNumber($itemNumber);

        if (null === $entities) {
            return [];
        }

        return $entities;
    }
}
