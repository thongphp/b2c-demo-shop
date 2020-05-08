<?php declare(strict_types = 1);

namespace Pyz\Client\Training\Dependency\Service;

use Spryker\Service\Synchronization\Dependency\Plugin\SynchronizationKeyGeneratorPluginInterface;

interface SynchronizationServiceBridgeInterface
{
    /**
     * @param string $resourceName
     *
     * @return \Spryker\Service\Synchronization\Dependency\Plugin\SynchronizationKeyGeneratorPluginInterface
     */
    public function getStorageKeyBuilder($resourceName): SynchronizationKeyGeneratorPluginInterface;
}
