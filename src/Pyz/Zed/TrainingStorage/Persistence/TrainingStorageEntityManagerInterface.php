<?php

namespace Pyz\Zed\TrainingStorage\Persistence;

use Generated\Shared\Transfer\TrainingStorageItemTransfer;

interface TrainingStorageEntityManagerInterface
{
    /**
     * @param string $customerItemNumber
     */
    public function deleteEntitiesByCustomerItemNumber(string $customerItemNumber): void;

    /**
     * @param \Generated\Shared\Transfer\TrainingStorageItemTransfer $storageItemTransfer
     *
     * @return \Generated\Shared\Transfer\TrainingStorageItemTransfer
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function saveEntity(TrainingStorageItemTransfer $storageItemTransfer): TrainingStorageItemTransfer;
}
