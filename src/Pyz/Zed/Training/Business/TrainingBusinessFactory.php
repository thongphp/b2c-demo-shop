<?php declare(strict_types = 1);

namespace Pyz\Zed\Training\Business;

use Pyz\Zed\Training\Business\Model\Importer\JsonImporter;
use Pyz\Zed\Training\Business\Model\Importer\JsonImporterInterface;
use Pyz\Zed\Training\Business\Model\Reader\TrainingPriceItemReader;
use Pyz\Zed\Training\Business\Model\Reader\TrainingPriceItemReaderInterface;
use Pyz\Zed\Training\Business\Model\Writer\TrainingPriceItemWriter;
use Pyz\Zed\Training\Business\Model\Writer\TrainingPriceItemWriterInterface;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;

/**
 * @method \Pyz\Zed\Training\Persistence\TrainingEntityManagerInterface getEntityManager()
 * @method \Pyz\Zed\Training\Persistence\TrainingRepositoryInterface getRepository()
 */
class TrainingBusinessFactory extends AbstractBusinessFactory
{
    /**
     * @return JsonImporterInterface
     */
    public function createDataImportFromJson(): JsonImporterInterface
    {
        return new JsonImporter($this->createPriceItemWriter());
    }

    /**
     * @return \Pyz\Zed\Training\Business\Model\Writer\TrainingPriceItemWriterInterface
     */
    private function createPriceItemWriter(): TrainingPriceItemWriterInterface
    {
        return new TrainingPriceItemWriter($this->getEntityManager());
    }

    /**
     * @return \Pyz\Zed\Training\Business\Model\Reader\TrainingPriceItemReaderInterface
     */
    public function createPriceItemReader(): TrainingPriceItemReaderInterface
    {
        return new TrainingPriceItemReader($this->getRepository());
    }
}
