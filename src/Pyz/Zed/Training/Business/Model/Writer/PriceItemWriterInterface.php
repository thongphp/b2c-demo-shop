<?php declare(strict_types = 1);

namespace Pyz\Zed\Training\Business\Model\Writer;

use Generated\Shared\Transfer\TrainingPriceItemTransfer;

interface PriceItemWriterInterface
{
    /**
     * @param \Generated\Shared\Transfer\TrainingPriceItemTransfer $trainingPriceItemTransfer
     *
     * @return \Generated\Shared\Transfer\TrainingPriceItemTransfer
     * @throws \Propel\Runtime\Exception\PropelException
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function saveEntity(TrainingPriceItemTransfer $trainingPriceItemTransfer): TrainingPriceItemTransfer;
}