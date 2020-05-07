<?php declare(strict_types = 1);

namespace Pyz\Zed\Training\Business\Model\Importer;

use Generated\Shared\Transfer\TrainingPriceItemTransfer;
use Pyz\Shared\TrainingStorage\TrainingStorageEvents;
use Pyz\Zed\Training\Dependency\Facade\TrainingToEventBridgeInterface;
use Pyz\Zed\Training\Dependency\TrainingEvents;

class TrainingImporter implements TrainingImporterInterface
{
    /** @var \Pyz\Zed\Training\Dependency\Facade\TrainingToEventBridgeInterface  */
    private $eventFacade;

    /** @var \Pyz\Zed\Training\Dependency\Plugin\Import\TrainingImportPluginInterface[] */
    private $importers;

    /**
     * @param \Pyz\Zed\Training\Dependency\Facade\TrainingToEventBridgeInterface $eventFacade
     * @param \Pyz\Zed\Training\Dependency\Plugin\Import\TrainingImportPluginInterface[] $importers
     */
    public function __construct(TrainingToEventBridgeInterface $eventFacade, array $importers)
    {
        $this->eventFacade = $eventFacade;
        $this->importers = $importers;
    }

    public function import(): void
    {
        $data = [];
        foreach ($this->importers as $importer) {
            $data = $importer->persistData($data);
        }

        $this->eventFacade->triggerBulk(TrainingEvents::DATA_BULK_IMPORT, $data);
        $this->eventFacade->triggerBulk(TrainingStorageEvents::DATA_BULK_PUBLISH, $data);
    }
}
