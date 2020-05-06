<?php declare(strict_types = 1);

namespace Pyz\Zed\Training\Persistence\Propel\Mapper;

use Generated\Shared\Transfer\TrainingPriceItemTransfer;
use Orm\Zed\Training\Persistence\PyzTrainingPriceItem;

interface TrainingMapperInterface
{
    /**
     * @param \Orm\Zed\Training\Persistence\PyzTrainingPriceItem $trainingPriceItem
     *
     * @return \Generated\Shared\Transfer\TrainingPriceItemTransfer
     */
    public function transferEntityToTransfer(PyzTrainingPriceItem $trainingPriceItem): TrainingPriceItemTransfer;

    /**
     * @param \Orm\Zed\Training\Persistence\PyzTrainingPriceItem[] $trainingPriceItems
     *
     * @return TrainingPriceItemTransfer[]
     */
    public function transferEntitiesToTransfers(array $trainingPriceItems): array;
}
