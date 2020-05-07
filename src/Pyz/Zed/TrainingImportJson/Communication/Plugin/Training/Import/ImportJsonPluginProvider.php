<?php declare(strict_types = 1);

namespace Pyz\Zed\TrainingImportJson\Communication\Plugin\Training\Import;

use Pyz\Zed\Training\Dependency\Plugin\Import\TrainingImportPluginInterface;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;

/**
 * @method \Pyz\Zed\TrainingImportJson\Business\TrainingImportJsonFacade getFacade()
 */
class ImportJsonPluginProvider extends AbstractPlugin implements TrainingImportPluginInterface
{
    /**
     * @param \Generated\Shared\Transfer\TrainingPriceItemTransfer[] $data
     *
     * @return \Generated\Shared\Transfer\TrainingPriceItemTransfer[]
     */
    public function persistData(array $data): array
    {
        return $this->getFacade()->persistData($data);
    }
}
