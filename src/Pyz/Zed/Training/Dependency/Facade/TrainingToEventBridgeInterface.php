<?php declare(strict_types = 1);

namespace Pyz\Zed\Training\Dependency\Facade;

use Spryker\Shared\Kernel\Transfer\TransferInterface;

interface TrainingToEventBridgeInterface
{
    /**
     * @param string $eventName
     * @param \Spryker\Shared\Kernel\Transfer\TransferInterface $transfer
     */
    public function trigger(string $eventName, TransferInterface $transfer): void;

    /**
     * @param string $eventName
     * @param \Spryker\Shared\Kernel\Transfer\TransferInterface[] $transfers
     */
    public function triggerBulk(string $eventName, array $transfers): void;
}
