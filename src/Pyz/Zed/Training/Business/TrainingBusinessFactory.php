<?php declare(strict_types = 1);

namespace Pyz\Zed\Training\Business;

use Pyz\Zed\Training\Business\Model\JsonImporter;
use Pyz\Zed\Training\Business\Reader\TrainingPriceItemReader;
use Pyz\Zed\Training\Business\Reader\TrainingPriceItemReaderInterface;
use Pyz\Zed\Training\Business\Writer\TrainingPriceItemWriter;
use Pyz\Zed\Training\Business\Writer\TrainingPriceItemWriterInterface;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;

/**
 * @method \Pyz\Zed\Training\Persistence\TrainingEntityManagerInterface getEntityManager()
 * @method \Pyz\Zed\Training\Persistence\TrainingRepositoryInterface getRepository()
 */
class TrainingBusinessFactory extends AbstractBusinessFactory
{
    /**
     * @return \Pyz\Zed\Training\Business\Model\JsonImporter
     */
    public function createDataImportFromJson(): JsonImporter
    {
        return new JsonImporter($this->createPriceItemWriter());
    }

    /**
     * @return \Pyz\Zed\Training\Business\Writer\TrainingPriceItemWriterInterface
     */
    private function createPriceItemWriter(): TrainingPriceItemWriterInterface
    {
        return new TrainingPriceItemWriter($this->getEntityManager());
    }

    /**
     * @return \Pyz\Zed\Training\Business\Reader\TrainingPriceItemReaderInterface
     */
    public function createPriceItemReader(): TrainingPriceItemReaderInterface
    {
        return new TrainingPriceItemReader($this->getRepository());
    }
}
