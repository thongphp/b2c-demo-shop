<?php declare(strict_types = 1);

namespace Pyz\Zed\TrainingStorage\Business;

use Generated\Shared\Transfer\TrainingStorageItemTransfer;
use Spryker\Zed\Kernel\Business\AbstractFacade;

/**
 * @method \Pyz\Zed\TrainingStorage\Business\TrainingStorageBusinessFactory getFactory()
 */
class TrainingStorageFacade extends AbstractFacade implements TrainingStorageFacadeInterface
{
    /**
     * @inheritDoc
     */
    public function publish(array $transfers): void
    {
        $storageItemTransfers = $this->getFactory()
            ->createMapper()
            ->transferPriceItemTransfersToStorageItemTransfers($transfers);

        foreach ($storageItemTransfers as $storageItemTransfer) {
            $this->saveData($storageItemTransfer);
        }
    }

    /**
     * @param \Generated\Shared\Transfer\TrainingStorageItemTransfer $storageItemTransfer
     */
    private function saveData(TrainingStorageItemTransfer $storageItemTransfer): void
    {
        $this->getFactory()
            ->createWriter()
            ->saveStorageItem($storageItemTransfer);
    }
}
