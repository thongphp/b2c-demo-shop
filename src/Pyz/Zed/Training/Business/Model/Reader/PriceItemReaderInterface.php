<?php declare(strict_types = 1);

namespace Pyz\Zed\Training\Business\Model\Reader;

interface PriceItemReaderInterface
{
    /**
     * @param string $customerNumber
     *
     * @return \Generated\Shared\Transfer\TrainingPriceItemTransfer[]
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function findByCustomerNumber(string $customerNumber): array;

    /**
     * @param string $itemNumber
     *
     * @return \Generated\Shared\Transfer\TrainingPriceItemTransfer[]
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function findByItemNumber(string $itemNumber): array;
}