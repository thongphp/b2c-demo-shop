<?php declare(strict_types = 1);

namespace Pyz\Zed\Training\Business\Model\Writer;

use Generated\Shared\Transfer\TrainingPriceItemTransfer;
use Pyz\Zed\Training\Persistence\TrainingEntityManagerInterface;

class TrainingPriceItemWriter implements TrainingPriceItemWriterInterface
{
    /** @var \Pyz\Zed\Training\Persistence\TrainingEntityManager */
    private $entityManager;

    /**
     * @param \Pyz\Zed\Training\Persistence\TrainingEntityManagerInterface $entityManager
     */
    public function __construct(TrainingEntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @param \Generated\Shared\Transfer\TrainingPriceItemTransfer $trainingPriceItemTransfer
     *
     * @return \Generated\Shared\Transfer\TrainingPriceItemTransfer
     * @throws \Propel\Runtime\Exception\PropelException
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function saveEntity(TrainingPriceItemTransfer $trainingPriceItemTransfer): TrainingPriceItemTransfer
    {
        return $this->entityManager->saveTrainingPriceItemEntity($trainingPriceItemTransfer);
    }
}
