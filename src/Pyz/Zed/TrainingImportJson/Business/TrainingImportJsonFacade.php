<?php declare(strict_types = 1);

namespace Pyz\Zed\TrainingImportJson\Business;

use Generated\Shared\Transfer\TrainingPriceItemTransfer;

class TrainingImportJsonFacade
{
    /**
     * @param \Generated\Shared\Transfer\TrainingPriceItemTransfer[] $data
     *
     * @return \Generated\Shared\Transfer\TrainingPriceItemTransfer[]
     */
    public function persistData(array $data): array
    {
        $data = array_merge($data, $this->getDataFromJsonFile());

        return $data;
    }

    private function getDataFromJsonFile(): array
    {
        $jsonData = json_decode(file_get_contents(__DIR__ . '/../_data/data.json'), true);
        $results = [];

        foreach ($jsonData as $datum) {
            $prices = $datum['prices'];

            foreach ($prices as $price) {
                $trainingPriceItemTransfer = new TrainingPriceItemTransfer();
                $trainingPriceItemTransfer->setCustomerNumber($datum['customer_number']);
                $trainingPriceItemTransfer->setItemNumber($datum['item_number']);
                $trainingPriceItemTransfer->setQuantity((int)$price['quantity']);
                $trainingPriceItemTransfer->setPrice((float)$price['value']);

                $results[] = $trainingPriceItemTransfer;
            }
        }

        return $results;
    }
}
