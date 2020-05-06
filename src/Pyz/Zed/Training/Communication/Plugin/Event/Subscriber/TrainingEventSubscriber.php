<?php declare(strict_types = 1);

namespace Pyz\Zed\Training\Communication\Plugin\Event\Subscriber;

use Pyz\Zed\Training\Communication\Plugin\Event\Listener\TrainingEventBulkListener;
use Pyz\Zed\Training\Dependency\TrainingEvents;
use Spryker\Zed\Event\Dependency\EventCollectionInterface;
use Spryker\Zed\Event\Dependency\Plugin\EventSubscriberInterface;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;

class TrainingEventSubscriber extends AbstractPlugin implements EventSubscriberInterface
{
    /**
     * @param \Spryker\Zed\Event\Dependency\EventCollectionInterface $eventCollection
     *
     * @return \Spryker\Zed\Event\Dependency\EventCollectionInterface
     */
    public function getSubscribedEvents(EventCollectionInterface $eventCollection): EventCollectionInterface
    {
        $eventCollection->addListenerQueued(
            TrainingEvents::DATA_BULK_IMPORT,
            new TrainingEventBulkListener()
        );

        return $eventCollection;
    }
}
