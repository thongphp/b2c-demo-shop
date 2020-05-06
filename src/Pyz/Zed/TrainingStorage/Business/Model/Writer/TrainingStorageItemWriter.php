<?php declare(strict_types = 1);

namespace Pyz\Zed\TrainingStorage\Business\Model\Writer;

use Generated\Shared\Transfer\TrainingStorageItemTransfer;
use Pyz\Zed\TrainingStorage\Persistence\TrainingStorageEntityManagerInterface;

class TrainingStorageItemWriter implements TrainingStorageItemWriterInterface
{
    /** @var TrainingStorageEntityManagerInterface */
    private $entityManager;

    /**
     * TrainingStorageWriter constructor.
     *
     * @param TrainingStorageEntityManagerInterface $entityManager
     */
    public function __construct(TrainingStorageEntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @param string $customerItemNumber
     */
    public function deleteEntitiesByCustomerItemNumber(string $customerItemNumber): void
    {
        $this->entityManager->deleteEntitiesByCustomerItemNumber($customerItemNumber);
    }

    /**
     * @param \Generated\Shared\Transfer\TrainingStorageItemTransfer $storageItemTransfer
     *
     * @return \Generated\Shared\Transfer\TrainingStorageItemTransfer
     */
    public function saveStorageItem(TrainingStorageItemTransfer $storageItemTransfer): TrainingStorageItemTransfer
    {
        return $this->entityManager->saveEntity($storageItemTransfer);
    }
}
