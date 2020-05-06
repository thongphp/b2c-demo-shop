<?php declare(strict_types = 1);

namespace Pyz\Zed\TrainingStorage;

use Spryker\Zed\Kernel\AbstractBundleConfig;

class TrainingStorageConfig extends AbstractBundleConfig
{
    /**
     * @deprecated Use `\Spryker\Zed\SynchronizationBehavior\SynchronizationBehaviorConfig::isSynchronizationEnabled()` instead.
     *
     * @return bool
     */
    public function isSendingToQueue(): bool
    {
        return true;
    }
}
