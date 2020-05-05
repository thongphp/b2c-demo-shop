<?php

namespace Pyz\Zed\Training\Persistence\Model\Writer;

use Generated\Shared\Transfer\TrainingPriceItemTransfer;

interface TrainingPriceItemWriterInterface
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
