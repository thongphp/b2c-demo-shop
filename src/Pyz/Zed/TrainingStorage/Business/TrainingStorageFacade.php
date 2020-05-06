<?php declare(strict_types = 1);

namespace Pyz\Zed\TrainingStorage\Business;

use Generated\Shared\Transfer\TrainingStorageItemTransfer;
use Spryker\Zed\Kernel\Business\AbstractFacade;

class TrainingStorageFacade extends AbstractFacade implements TrainingStorageFacadeInterface
{
    /**
     * @inheritDoc
     */
    public function publish(array $transfers): void
    {
        dump($transfers);
        exit;
        $data = $this->prepareData($transfers);
    }

    /**
     * @param \Generated\Shared\Transfer\TrainingStorageItemTransfer[] $transfers
     *
     * @return array
     */
    private function prepareData(array $transfers): array
    {
        $results = [];

        foreach ($transfers as $transfer) {
            $customerNumber = $transfer->getCustomerNumber();
            $itemNumber = $transfer->getItemNumber();
            $key = $this->generateKey($transfer);
            dump($transfer);
        }

        return $results;
    }

    private function generateKey(TrainingStorageItemTransfer $storageItemTransfer): string
    {
        return $storageItemTransfer->getCustomerNumber() . '_' . $storageItemTransfer->getItemNumber();
    }
}
