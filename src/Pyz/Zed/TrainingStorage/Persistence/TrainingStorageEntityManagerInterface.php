<?php declare(strict_types = 1);

namespace Pyz\Zed\TrainingStorage\Persistence;

use Generated\Shared\Transfer\TrainingStorageItemTransfer;

interface TrainingStorageEntityManagerInterface
{
    /**
     * @param \Generated\Shared\Transfer\TrainingStorageItemTransfer $storageItemTransfer
     * @param bool $isSendingToQueue
     *
     * @return \Generated\Shared\Transfer\TrainingStorageItemTransfer
     */
    public function saveEntity(TrainingStorageItemTransfer $storageItemTransfer, bool $isSendingToQueue): TrainingStorageItemTransfer;
}
