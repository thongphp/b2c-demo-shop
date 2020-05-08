<?php declare(strict_types = 1);

namespace Pyz\Zed\Training\Dependency\Facade;

use Spryker\Shared\Kernel\Transfer\TransferInterface;
use Spryker\Zed\Event\Business\EventFacadeInterface;

class TrainingToEventBridge implements TrainingToEventBridgeInterface
{
    /** @var \Spryker\Zed\Event\Business\EventFacadeInterface */
    private $eventFacade;

    /**
     * @param \Spryker\Zed\Event\Business\EventFacadeInterface $eventFacade
     */
    public function __construct(EventFacadeInterface $eventFacade)
    {
        $this->eventFacade = $eventFacade;
    }

    /**
     * @inheritDoc
     */
    public function trigger(string $eventName, TransferInterface $transfer): void
    {
        $this->eventFacade->trigger($eventName, $transfer);
    }

    /**
     * @inheritDoc
     */
    public function triggerBulk(string $eventName, array $transfers): void
    {
        $this->eventFacade->triggerBulk($eventName, $transfers);
    }
}
