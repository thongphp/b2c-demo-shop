<?php declare(strict_types = 1);

namespace Pyz\Zed\Training\Business\Model\Importer;

use Generated\Shared\Transfer\TrainingPriceItemTransfer;
use Pyz\Shared\TrainingStorage\TrainingStorageEvents;
use Pyz\Zed\Training\Dependency\Facade\TrainingToEventBridgeInterface;
use Pyz\Zed\Training\Dependency\TrainingEvents;

class JsonImporter implements JsonImporterInterface
{
    /** @var \Pyz\Zed\Training\Dependency\Facade\TrainingToEventBridgeInterface */
    private $eventFacade;

    /**
     * JsonImporter constructor.
     *
     * @param \Pyz\Zed\Training\Dependency\Facade\TrainingToEventBridgeInterface $eventFacade
     */
    public function __construct(TrainingToEventBridgeInterface $eventFacade)
    {
        $this->eventFacade = $eventFacade;
    }

    /**
     * @param string $path
     */
    public function importData(string $path): void
    {
        $jsonFileContent = file_get_contents($path);
        $data = json_decode($jsonFileContent, true);

        $this->bulkProcess($data);
    }

    private function bulkProcess(array $data): void
    {
        $transfers = [];

        foreach ($data as $datum) {
            $prices = $datum['prices'];

            foreach ($prices as $price) {
                $trainingPriceItemTransfer = new TrainingPriceItemTransfer();
                $trainingPriceItemTransfer->setCustomerNumber($datum['customer_number']);
                $trainingPriceItemTransfer->setItemNumber($datum['item_number']);
                $trainingPriceItemTransfer->setQuantity((int)$price['quantity']);
                $trainingPriceItemTransfer->setPrice((float)$price['value']);

                $transfers[] = $trainingPriceItemTransfer;
            }
        }

        $this->eventFacade->triggerBulk(TrainingEvents::DATA_BULK_IMPORT, $transfers);
        $this->eventFacade->triggerBulk(TrainingStorageEvents::DATA_BULK_PUBLISH, $transfers);
    }
}
