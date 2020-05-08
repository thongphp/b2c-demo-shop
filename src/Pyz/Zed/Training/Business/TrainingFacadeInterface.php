<?php declare(strict_types = 1);

namespace Pyz\Zed\Training\Business;

use Generated\Shared\Transfer\TrainingPriceItemTransfer;

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
     * @return \Generated\Shared\Transfer\TrainingPriceItemTransfer[]
     */
    public function findPricesByCustomerNumber(string $customerNumber): array;

    /**
     * @param string $itemNumber
     *
     * @return \Generated\Shared\Transfer\TrainingPriceItemTransfer[]
     */
    public function findPricesByItemNumber(string $itemNumber): array;

    /**
     * @param \Generated\Shared\Transfer\TrainingPriceItemTransfer $trainingPriceItemTransfer
     */
    public function savePriceItem(TrainingPriceItemTransfer $trainingPriceItemTransfer): void;
}
