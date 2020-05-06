<?php declare(strict_types = 1);

namespace Pyz\Zed\TrainingStorage\Business\Model\Writer;

use Generated\Shared\Transfer\TrainingStorageItemTransfer;

interface TrainingStorageItemWriterInterface
{
    /**
     * @param string $customerItemNumber
     */
    public function deleteEntitiesByCustomerItemNumber(string $customerItemNumber): void;

    /**
     * @param \Generated\Shared\Transfer\TrainingStorageItemTransfer $storageItemTransfer
     *
     * @return \Generated\Shared\Transfer\TrainingStorageItemTransfer
     */
    public function saveStorageItem(TrainingStorageItemTransfer $storageItemTransfer): TrainingStorageItemTransfer;
}
