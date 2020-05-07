<?php declare(strict_types = 1);

namespace Pyz\Zed\TrainingStorage\Business\Model\Mapper;

use Generated\Shared\Transfer\TrainingPriceItemTransfer;
use Generated\Shared\Transfer\TrainingStorageItemTransfer;

class TrainingStorageMapper
{
    /**
     * @param \Generated\Shared\Transfer\TrainingPriceItemTransfer[] $priceItemTransfers
     *
     * @return \Generated\Shared\Transfer\TrainingStorageItemTransfer[]
     */
    public function transferPriceItemTransfersToStorageItemTransfers(array $priceItemTransfers): array
    {
        $results = [];

        foreach ($priceItemTransfers as $priceItemTransfer) {
            $key = $this->generateKey($priceItemTransfer);

            if (!isset($results[$key])) {
                $results[$key] = [
                    'customerNumber' => $priceItemTransfer->getCustomerNumber(),
                    'itemNumber' => $priceItemTransfer->getItemNumber(),
                    'prices' => [],
                ];
            }

            $results[$key]['prices'][] = [
                'quantity' => $priceItemTransfer->getQuantity(),
                'value' => $priceItemTransfer->getPrice(),
            ];
        }

        $results = array_values($results);

        $results = array_map(function ($item) {
            return (new TrainingStorageItemTransfer())->fromArray($item);
        }, $results);

        return $results;
    }

    private function generateKey(TrainingPriceItemTransfer $priceItemTransfer): string
    {
        return $priceItemTransfer->getCustomerNumber() . '_' . $priceItemTransfer->getItemNumber();
    }
}
