<?php declare(strict_types = 1);

namespace Pyz\Zed\TrainingStorage\Persistence;

use Generated\Shared\Transfer\TrainingStorageItemTransfer;
use Orm\Zed\TrainingStorage\Persistence\PyzTrainingPriceItemStorage;
use Spryker\Zed\Kernel\Persistence\AbstractEntityManager;

/**
 * @method TrainingStoragePersistenceFactory getFactory()
 */
class TrainingStorageEntityManager extends AbstractEntityManager implements TrainingStorageEntityManagerInterface
{
    /**
     * @param string $customerItemNumber
     */
    public function deleteEntitiesByCustomerItemNumber(string $customerItemNumber): void
    {
        $this->getFactory()
            ->createTrainingStorageQuery()
            ->findByFkCustomerItemNumber($customerItemNumber)
            ->delete();
    }

    /**
     * @param \Generated\Shared\Transfer\TrainingStorageItemTransfer $storageItemTransfer
     *
     * @return \Generated\Shared\Transfer\TrainingStorageItemTransfer
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function saveEntity(TrainingStorageItemTransfer $storageItemTransfer): TrainingStorageItemTransfer
    {
        $customerItemNumber = $storageItemTransfer->getCustomerNumber() . '_' . $storageItemTransfer->getItemNumber();

        $entity = new PyzTrainingPriceItemStorage();
        $entity->setData($storageItemTransfer->toArray());
        $entity->setFkCustomerItemNumber($customerItemNumber);
        $entity->setKey($customerItemNumber);
        $entity->save();

        return $storageItemTransfer;
    }
}
