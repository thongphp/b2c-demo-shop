<?php declare(strict_types = 1);

namespace Pyz\Zed\TrainingStorage\Persistence;

use Generated\Shared\Transfer\PyzTrainingPriceItemStorageEntityTransfer;
use Generated\Shared\Transfer\TrainingStorageItemTransfer;
use Spryker\Zed\Kernel\Persistence\AbstractEntityManager;

/**
 * @method TrainingStoragePersistenceFactory getFactory()
 */
class TrainingStorageEntityManager extends AbstractEntityManager implements TrainingStorageEntityManagerInterface
{
    /**
     * @param \Generated\Shared\Transfer\TrainingStorageItemTransfer $storageItemTransfer
     * @param bool $isSendingToQueue
     *
     * @return \Generated\Shared\Transfer\TrainingStorageItemTransfer
     *
     * @throws \Propel\Runtime\Exception\PropelException
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function saveEntity(TrainingStorageItemTransfer $storageItemTransfer, bool $isSendingToQueue): TrainingStorageItemTransfer
    {
        $customerItemNumber = $storageItemTransfer->getCustomerNumber() . '_' . $storageItemTransfer->getItemNumber();

        $entity = $this->getFactory()
            ->createTrainingStorageQuery()
            ->filterByFkCustomerItemNumber($customerItemNumber)
            ->findOneOrCreate();

        $entity->setData($storageItemTransfer->toArray());
        $entity->setKey($customerItemNumber);
        $entity->setIsSendingToQueue($isSendingToQueue);
        $entity->setLocale('de_DE');
        $entity->save();

        return $storageItemTransfer;
    }
}
