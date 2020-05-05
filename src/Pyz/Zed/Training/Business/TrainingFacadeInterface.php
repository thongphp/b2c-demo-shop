<?php declare(strict_types = 1);

namespace Pyz\Zed\Training\Business;

interface TrainingFacadeInterface
{
    /**
     * @param string $path
     *
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function importDataFromJson(string $path): void;

    /**
     * @param string $customerNumber
     *
     * @return null|\Generated\Shared\Transfer\TrainingPriceItemTransfer[]
     */
    public function findPricesByCustomerNumber(string $customerNumber): ?array;

    /**
     * @param string $itemNumber
     *
     * @return null|\Generated\Shared\Transfer\TrainingPriceItemTransfer[]
     */
    public function findPricesByItemNumber(string $itemNumber): ?array;
}
