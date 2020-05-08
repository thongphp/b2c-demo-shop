<?php declare(strict_types = 1);

namespace Pyz\Client\Training;

use Pyz\Client\Training\Dependency\Client\CartClientBridgeInterface;
use Pyz\Client\Training\Dependency\Client\CustomerClientBridgeInterface;
use Pyz\Client\Training\Dependency\Client\StorageClientBridgeInterface;
use Pyz\Client\Training\Dependency\Service\SynchronizationServiceBridgeInterface;
use Pyz\Client\Training\Storage\PriceItemStorageReader;
use Pyz\Client\Training\Storage\PriceItemStorageReaderInterface;
use Spryker\Client\Kernel\AbstractFactory;

/**
 * @method \Pyz\Client\Training\TrainingConfig getConfig()
 */
class TrainingFactory extends AbstractFactory
{
    /**
     * @return \Pyz\Client\Training\Storage\PriceItemStorageReaderInterface
     * @throws \Spryker\Client\Kernel\Exception\Container\ContainerKeyNotFoundException
     */
    public function getStorageReader(): PriceItemStorageReaderInterface
    {
        return new PriceItemStorageReader(
            $this->getStorageClient(),
            $this->getSynchronizationService()
        );
    }

    /**
     * @return \Pyz\Client\Training\Dependency\Client\StorageClientBridgeInterface
     * @throws \Spryker\Client\Kernel\Exception\Container\ContainerKeyNotFoundException
     */
    private function getStorageClient(): StorageClientBridgeInterface
    {
        return $this->getProvidedDependency(TrainingDependencyProvider::CLIENT_STORAGE);
    }

    /**
     * @return \Pyz\Client\Training\Dependency\Service\SynchronizationServiceBridgeInterface
     * @throws \Spryker\Client\Kernel\Exception\Container\ContainerKeyNotFoundException
     */
    private function getSynchronizationService(): SynchronizationServiceBridgeInterface
    {
        return $this->getProvidedDependency(TrainingDependencyProvider::SERVICE_SYNCHRONIZATION);
    }

    /**
     * @return \Pyz\Client\Training\Dependency\Client\CartClientBridgeInterface
     * @throws \Spryker\Client\Kernel\Exception\Container\ContainerKeyNotFoundException
     */
    public function getCartClient(): CartClientBridgeInterface
    {
        return $this->getProvidedDependency(TrainingDependencyProvider::CLIENT_CART);
    }

    /**
     * @return \Pyz\Client\Training\Dependency\Client\CustomerClientBridgeInterface
     * @throws \Spryker\Client\Kernel\Exception\Container\ContainerKeyNotFoundException
     */
    public function getCustomerClient(): CustomerClientBridgeInterface
    {
        return $this->getProvidedDependency(TrainingDependencyProvider::CLIENT_CUSTOMER);
    }
}
