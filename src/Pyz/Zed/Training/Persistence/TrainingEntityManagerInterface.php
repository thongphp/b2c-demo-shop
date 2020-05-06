<?php declare(strict_types = 1);

namespace Pyz\Zed\Training\Persistence;

use Generated\Shared\Transfer\TrainingPriceItemTransfer;

interface TrainingEntityManagerInterface
{
    /**
     * @param \Generated\Shared\Transfer\TrainingPriceItemTransfer $trainingPriceItemTransfer
     *
     * @return \Generated\Shared\Transfer\TrainingPriceItemTransfer
     *
     * @throws \Propel\Runtime\Exception\PropelException
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function saveTrainingPriceItemEntity(TrainingPriceItemTransfer $trainingPriceItemTransfer): TrainingPriceItemTransfer;
}
