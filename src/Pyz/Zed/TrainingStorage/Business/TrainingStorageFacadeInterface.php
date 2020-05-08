<?php declare(strict_types = 1);

namespace Pyz\Zed\TrainingStorage\Business;

interface TrainingStorageFacadeInterface
{
    /**
     * @param \Generated\Shared\Transfer\TrainingPriceItemTransfer[] $transfers
     */
    public function publish(array $transfers): void;
}
