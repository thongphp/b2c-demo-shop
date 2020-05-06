<?php declare(strict_types = 1);

namespace Pyz\Zed\TrainingStorage\Communication\Plugin\Event\Subscriber;

use Pyz\Shared\TrainingStorage\TrainingStorageEvents;
use Pyz\Zed\TrainingStorage\Communication\Plugin\Event\Listener\TrainingStorageEventBulkListener;
use Spryker\Zed\Event\Dependency\EventCollectionInterface;
use Spryker\Zed\Event\Dependency\Plugin\EventSubscriberInterface;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;

class TrainingStorageEventSubscriber extends AbstractPlugin implements EventSubscriberInterface
{
    /**
     * @param \Spryker\Zed\Event\Dependency\EventCollectionInterface $eventCollection
     *
     * @return \Spryker\Zed\Event\Dependency\EventCollectionInterface
     */
    public function getSubscribedEvents(EventCollectionInterface $eventCollection): EventCollectionInterface
    {
        $eventCollection->addListener(
            TrainingStorageEvents::TRAINING_STORAGE_PUBLISH_BULK,
            new TrainingStorageEventBulkListener()
        );

        return $eventCollection;
    }
}
