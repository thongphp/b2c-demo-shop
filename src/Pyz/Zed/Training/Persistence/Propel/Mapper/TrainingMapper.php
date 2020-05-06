<?php declare(strict_types = 1);

namespace Pyz\Zed\Training\Persistence\Propel\Mapper;

use Generated\Shared\Transfer\TrainingPriceItemTransfer;
use Orm\Zed\Training\Persistence\PyzTrainingPriceItem;

class TrainingMapper implements TrainingMapperInterface
{
    /**
     * @param \Orm\Zed\Training\Persistence\PyzTrainingPriceItem $trainingPriceItem
     *
     * @return \Generated\Shared\Transfer\TrainingPriceItemTransfer
     */
    public function transferEntityToTransfer(PyzTrainingPriceItem $trainingPriceItem): TrainingPriceItemTransfer
    {
        $trainingPriceItemTransfer = new TrainingPriceItemTransfer();
        $trainingPriceItemTransfer->fromArray($trainingPriceItem->toArray(), true);

        return $trainingPriceItemTransfer;
    }

    /**
     * @param \Orm\Zed\Training\Persistence\PyzTrainingPriceItem[] $trainingPriceItems
     *
     * @return TrainingPriceItemTransfer[]
     */
    public function transferEntitiesToTransfers(array $trainingPriceItems): array
    {
        return array_map(function (PyzTrainingPriceItem $trainingPriceItem) {
            return $this->transferEntityToTransfer($trainingPriceItem);
        }, $trainingPriceItems);
    }
}
