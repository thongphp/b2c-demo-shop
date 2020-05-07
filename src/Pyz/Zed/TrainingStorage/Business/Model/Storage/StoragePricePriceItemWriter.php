<?php declare(strict_types = 1);

namespace Pyz\Zed\TrainingStorage\Business\Model\Storage;

use Generated\Shared\Transfer\TrainingStorageItemTransfer;
use Pyz\Zed\TrainingStorage\Persistence\TrainingStorageEntityManagerInterface;

class StoragePricePriceItemWriter implements StoragePriceItemWriterInterface
{
    /** @var TrainingStorageEntityManagerInterface */
    private $entityManager;

    /** @var bool */
    private $isSendingToQueue;

    /**
     * StoragePriceItemWriter constructor.
     *
     * @param \Pyz\Zed\TrainingStorage\Persistence\TrainingStorageEntityManagerInterface $entityManager
     * @param bool $isSendingToQueue
     */
    public function __construct(TrainingStorageEntityManagerInterface $entityManager, bool $isSendingToQueue)
    {
        $this->entityManager = $entityManager;
        $this->isSendingToQueue = $isSendingToQueue;
    }

    /**
     * @param \Generated\Shared\Transfer\TrainingStorageItemTransfer $storageItemTransfer
     *
     * @return \Generated\Shared\Transfer\TrainingStorageItemTransfer
     */
    public function saveStorageItem(TrainingStorageItemTransfer $storageItemTransfer): TrainingStorageItemTransfer
    {
        return $this->entityManager->saveEntity($storageItemTransfer, $this->isSendingToQueue);
    }
}
