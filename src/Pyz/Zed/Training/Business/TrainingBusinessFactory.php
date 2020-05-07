<?php declare(strict_types = 1);

namespace Pyz\Zed\Training\Business;

use Pyz\Zed\Training\Business\Model\Importer\JsonImporter;
use Pyz\Zed\Training\Business\Model\Importer\JsonImporterInterface;
use Pyz\Zed\Training\Business\Model\Reader\PriceItemReader;
use Pyz\Zed\Training\Business\Model\Reader\PriceItemReaderInterface;
use Pyz\Zed\Training\Business\Model\Writer\PriceItemWriter;
use Pyz\Zed\Training\Business\Model\Writer\PriceItemWriterInterface;
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
     * @return \Pyz\Zed\Training\Business\Model\Reader\PriceItemReaderInterface
     */
    public function createPriceItemReader(): PriceItemReaderInterface
    {
        return new PriceItemReader($this->getRepository());
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
     * @return \Pyz\Zed\Training\Business\Model\Writer\PriceItemWriterInterface
     */
    public function createPriceItemWriter(): PriceItemWriterInterface
    {
        return new PriceItemWriter($this->getEntityManager());
    }
}
