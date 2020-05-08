<?php declare(strict_types = 1);

namespace Pyz\Client\Training;

use Pyz\Client\Training\Storage\PriceItemStorageReader;
use Pyz\Client\Training\Storage\PriceItemStorageReaderInterface;
use Spryker\Client\Cart\CartClientInterface;
use Spryker\Client\Currency\CurrencyClientInterface;
use Spryker\Client\Customer\CustomerClientInterface;
use Spryker\Client\Kernel\AbstractFactory;
use Spryker\Client\Locale\LocaleClientInterface;
use Spryker\Client\Storage\StorageClientInterface;
use Spryker\Service\Synchronization\SynchronizationServiceInterface;

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
     * @return \Spryker\Client\Storage\StorageClientInterface
     * @throws \Spryker\Client\Kernel\Exception\Container\ContainerKeyNotFoundException
     */
    private function getStorageClient(): StorageClientInterface
    {
        return $this->getProvidedDependency(TrainingDependencyProvider::CLIENT_STORAGE);
    }

    /**
     * @return \Spryker\Service\Synchronization\SynchronizationServiceInterface
     * @throws \Spryker\Client\Kernel\Exception\Container\ContainerKeyNotFoundException
     */
    private function getSynchronizationService(): SynchronizationServiceInterface
    {
        return $this->getProvidedDependency(TrainingDependencyProvider::SERVICE_SYNCHRONIZATION);
    }

    /**
     * @return \Spryker\Client\Cart\CartClientInterface
     * @throws \Spryker\Client\Kernel\Exception\Container\ContainerKeyNotFoundException
     */
    public function getCartClient(): CartClientInterface
    {
        return $this->getProvidedDependency(TrainingDependencyProvider::CLIENT_CART);
    }

    /**
     * @return \Spryker\Client\Customer\CustomerClientInterface
     * @throws \Spryker\Client\Kernel\Exception\Container\ContainerKeyNotFoundException
     */
    public function getCustomerClient(): CustomerClientInterface
    {
        return $this->getProvidedDependency(TrainingDependencyProvider::CLIENT_CUSTOMER);
    }

    /**
     * @return \Spryker\Client\Currency\CurrencyClientInterface
     * @throws \Spryker\Client\Kernel\Exception\Container\ContainerKeyNotFoundException
     */
    public function getCurrencyClient(): CurrencyClientInterface
    {
        return $this->getProvidedDependency(TrainingDependencyProvider::CLIENT_CURRENCY);
    }

    /**
     * @return \Spryker\Client\Locale\LocaleClientInterface
     * @throws \Spryker\Client\Kernel\Exception\Container\ContainerKeyNotFoundException
     */
    public function getLocaleClient(): LocaleClientInterface
    {
        return $this->getProvidedDependency(TrainingDependencyProvider::CLIENT_LOCALE);
    }
}
