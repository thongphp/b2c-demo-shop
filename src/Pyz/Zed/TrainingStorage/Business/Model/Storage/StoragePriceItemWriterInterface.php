<?php declare(strict_types = 1);

namespace Pyz\Zed\TrainingStorage\Business\Model\Storage;

use Generated\Shared\Transfer\TrainingStorageItemTransfer;

interface StoragePriceItemWriterInterface
{
    /**
     * @param \Generated\Shared\Transfer\TrainingStorageItemTransfer $storageItemTransfer
     *
     * @return \Generated\Shared\Transfer\TrainingStorageItemTransfer
     */
    public function saveStorageItem(TrainingStorageItemTransfer $storageItemTransfer): TrainingStorageItemTransfer;
}
