<?php declare(strict_types = 1);

namespace Pyz\Zed\Training\Dependency\Plugin\Import;

interface TrainingImportPluginInterface
{
    /**
     * @param \Generated\Shared\Transfer\TrainingPriceItemTransfer[] $data
     *
     * @return \Generated\Shared\Transfer\TrainingPriceItemTransfer[]
     */
    public function persistData(array $data): array;
}
