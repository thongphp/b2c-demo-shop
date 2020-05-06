<?php declare(strict_types = 1);

namespace Pyz\Zed\TrainingStorage\Business;

use Pyz\Zed\TrainingStorage\Business\Model\Writer\TrainingStorageItemWriter;
use Pyz\Zed\TrainingStorage\Business\Model\Writer\TrainingStorageItemWriterInterface;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;

/**
 * @method \Pyz\Zed\TrainingStorage\Persistence\TrainingStorageEntityManager getEntityManager()
 */
class TrainingStorageBusinessFactory extends AbstractBusinessFactory
{
    /**
     * @return TrainingStorageItemWriterInterface
     */
    public function createWriter(): TrainingStorageItemWriterInterface
    {
        return new TrainingStorageItemWriter(
            $this->getEntityManager()
        );
    }
}
