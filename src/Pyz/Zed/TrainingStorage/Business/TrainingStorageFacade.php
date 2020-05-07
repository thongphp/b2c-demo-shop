<?php declare(strict_types = 1);

namespace Pyz\Zed\TrainingStorage\Business;

use Generated\Shared\Transfer\TrainingPriceItemTransfer;
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
        $storageItemTransfers = $this->prepareData($transfers);

        foreach ($storageItemTransfers as $storageItemTransfer) {
            $this->saveData($storageItemTransfer);
        }
    }

    /**
     * @param \Generated\Shared\Transfer\TrainingStorageItemTransfer $storageItemTransfer
     */
    private function saveData(TrainingStorageItemTransfer $storageItemTransfer): void
    {
        $customerItemNumber = $this->generateKeyForStorage($storageItemTransfer);

        $writer = $this->getFactory()->createWriter();

//        $writer->deleteEntitiesByCustomerItemNumber($customerItemNumber);
        $writer->saveStorageItem($storageItemTransfer);
    }

    /**
     * @param \Generated\Shared\Transfer\TrainingPriceItemTransfer[] $transfers
     *
     * @return TrainingStorageItemTransfer[]
     */
    private function prepareData(array $transfers): array
    {
        $results = [];

        foreach ($transfers as $transfer) {
            $customerNumber = $transfer->getCustomerNumber();
            $itemNumber = $transfer->getItemNumber();
            $key = $this->generateKey($transfer);

            if (!isset($results[$key])) {
                $results[$key] = [
                    'customerNumber' => $customerNumber,
                    'itemNumber' => $itemNumber,
                    'prices' => [],
                ];
            }

            $results[$key]['prices'][] = [
                'quantity' => $transfer->getQuantity(),
                'value' => $transfer->getPrice(),
            ];
        }

        $results = array_map(function ($item) {
            $storageItemTransfer = new TrainingStorageItemTransfer();
            $storageItemTransfer->setCustomerNumber($item['customerNumber'])
                ->setItemNumber($item['itemNumber'])
                ->setPrices($item['prices']);

            return $storageItemTransfer;
        }, $results);

        return array_values($results);
    }

    private function generateKey(TrainingPriceItemTransfer $trainingPriceItemTransfer): string
    {
        return $trainingPriceItemTransfer->getCustomerNumber() . '_' . $trainingPriceItemTransfer->getItemNumber();
    }

    private function generateKeyForStorage(TrainingStorageItemTransfer $itemTransfer): string
    {
        return $itemTransfer->getCustomerNumber() . '_' . $itemTransfer->getItemNumber();
    }
}
