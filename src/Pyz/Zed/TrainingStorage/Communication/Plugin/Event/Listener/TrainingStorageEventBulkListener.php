<?php declare(strict_types = 1);

namespace Pyz\Zed\TrainingStorage\Communication\Plugin\Event\Listener;

use Spryker\Zed\Event\Dependency\Plugin\EventBulkHandlerInterface;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;

/**
 * @method \Pyz\Zed\TrainingStorage\Business\TrainingStorageFacadeInterface getFacade()
 */
class TrainingStorageEventBulkListener extends AbstractPlugin implements EventBulkHandlerInterface
{
    /**
     * @inheritDoc
     */
    public function handleBulk(array $transfers, $eventName): void
    {
        $this->getFacade()->publish($transfers);
    }
}
