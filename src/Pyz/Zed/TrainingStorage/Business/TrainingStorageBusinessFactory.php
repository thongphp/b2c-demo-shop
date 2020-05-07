<?php declare(strict_types = 1);

namespace Pyz\Zed\TrainingStorage\Business;

use Pyz\Zed\TrainingStorage\Business\Model\Mapper\TrainingStorageMapper;
use Pyz\Zed\TrainingStorage\Business\Model\Storage\StoragePriceItemWriter;
use Pyz\Zed\TrainingStorage\Business\Model\Storage\StoragePriceItemWriterInterface;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;

/**
 * @method \Pyz\Zed\TrainingStorage\Persistence\TrainingStorageEntityManager getEntityManager()
 * @method \Pyz\Zed\TrainingStorage\TrainingStorageConfig getConfig()
 */
class TrainingStorageBusinessFactory extends AbstractBusinessFactory
{
    /**
     * @return StoragePriceItemWriterInterface
     */
    public function createWriter(): StoragePriceItemWriterInterface
    {
        return new StoragePriceItemWriter(
            $this->getEntityManager(),
            $this->getConfig()->isSendingToQueue()
        );
    }

    /**
     * @return \Pyz\Zed\TrainingStorage\Business\Model\Mapper\TrainingStorageMapper
     */
    public function createMapper(): TrainingStorageMapper
    {
        return new TrainingStorageMapper();
    }
}
