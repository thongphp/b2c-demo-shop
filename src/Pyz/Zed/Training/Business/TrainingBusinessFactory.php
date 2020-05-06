<?php declare(strict_types = 1);

namespace Pyz\Zed\Training\Business;

use Pyz\Zed\Training\Business\Model\Importer\JsonImporter;
use Pyz\Zed\Training\Business\Model\Importer\JsonImporterInterface;
use Pyz\Zed\Training\Business\Model\Reader\TrainingPriceItemReader;
use Pyz\Zed\Training\Business\Model\Reader\TrainingPriceItemReaderInterface;
use Pyz\Zed\Training\Business\Model\Writer\TrainingPriceItemWriter;
use Pyz\Zed\Training\Business\Model\Writer\TrainingPriceItemWriterInterface;
use Pyz\Zed\Training\Dependency\Facade\TrainingToEventBridgeInterface;
use Pyz\Zed\Training\TrainingDependencyProvider;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;

/**
 * @method \Pyz\Zed\Training\Persistence\TrainingEntityManagerInterface getEntityManager()
 * @method \Pyz\Zed\Training\Persistence\TrainingRepositoryInterface getRepository()
 */
class TrainingBusinessFactory extends AbstractBusinessFactory
{
    /**
     * @return JsonImporterInterface
     *
     * @throws \Spryker\Zed\Kernel\Exception\Container\ContainerKeyNotFoundException
     */
    public function createDataImportFromJson(): JsonImporterInterface
    {
        return new JsonImporter($this->getEventFacade());
    }

    /**
     * @return \Pyz\Zed\Training\Business\Model\Reader\TrainingPriceItemReaderInterface
     */
    public function createPriceItemReader(): TrainingPriceItemReaderInterface
    {
        return new TrainingPriceItemReader($this->getRepository());
    }

    /**
     * @return \Pyz\Zed\Training\Dependency\Facade\TrainingToEventBridgeInterface
     *
     * @throws \Spryker\Zed\Kernel\Exception\Container\ContainerKeyNotFoundException
     */
    public function getEventFacade(): TrainingToEventBridgeInterface
    {
        return $this->getProvidedDependency(TrainingDependencyProvider::FACADE_EVENT);
    }

    /**
     * @return \Pyz\Zed\Training\Business\Model\Writer\TrainingPriceItemWriterInterface
     */
    public function createPriceItemWriter(): TrainingPriceItemWriterInterface
    {
        return new TrainingPriceItemWriter($this->getEntityManager());
    }
}
