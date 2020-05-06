<?php declare(strict_types = 1);

namespace Pyz\Zed\Training\Communication\Plugin\Event\Listener;

use Generated\Shared\Transfer\TrainingPriceItemTransfer;
use Spryker\Shared\Kernel\Transfer\TransferInterface;
use Spryker\Zed\Event\Dependency\Plugin\EventBulkHandlerInterface;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;

/**
 * @method \Pyz\Zed\Training\Business\TrainingFacadeInterface getFacade()
 */
class TrainingEventListener extends AbstractPlugin implements EventBulkHandlerInterface
{
    /**
     * @param \Spryker\Shared\Kernel\Transfer\TransferInterface[] $transfers
     * @param string $eventName
     */
    public function handleBulk(array $transfers, $eventName): void
    {
        foreach ($transfers as $transfer) {
            $this->saveData($transfer);
        }
    }

    /**
     * @param \Spryker\Shared\Kernel\Transfer\TransferInterface $transfer
     */
    private function saveData(TransferInterface $transfer): void
    {
        $trainingPriceItemTransfer = new TrainingPriceItemTransfer();
        $trainingPriceItemTransfer->fromArray($transfer->toArray(), true);

        $this->getFacade()->savePriceItem($trainingPriceItemTransfer);
    }
}
