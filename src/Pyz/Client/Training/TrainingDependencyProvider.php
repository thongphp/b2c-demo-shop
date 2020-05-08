<?php declare(strict_types = 1);

namespace Pyz\Client\Training;

use Pyz\Client\Training\Dependency\Client\CartClientBridge;
use Pyz\Client\Training\Dependency\Client\CustomerClientBridge;
use Pyz\Client\Training\Dependency\Client\StorageClientBridge;
use Pyz\Client\Training\Dependency\Service\SynchronizationServiceBridge;
use Spryker\Client\Kernel\AbstractDependencyProvider;
use Spryker\Client\Kernel\Container;

class TrainingDependencyProvider extends AbstractDependencyProvider
{
    public const CLIENT_STORAGE = 'CLIENT_STORAGE';
    public const CLIENT_CART = 'CLIENT_CART';
    public const CLIENT_CUSTOMER = 'CLIENT_CUSTOMER';
    public const CLIENT_PRICE = 'CLIENT_PRICE';
    public const CLIENT_PRICE_PRODUCT = 'CLIENT_PRICE_PRODUCT';
    public const CLIENT_CURRENCY = 'CLIENT_CURRENCY';
    public const CLIENT_PRODUCT_STORAGE = 'CLIENT_PRODUCT_STORAGE';
    public const CLIENT_PRICE_PRODUCT_STORAGE = 'CLIENT_PRICE_PRODUCT_STORAGE';
    public const SERVICE_SYNCHRONIZATION = 'SERVICE_SYNCHRONIZATION';

    /**
     * @param \Spryker\Client\Kernel\Container $container
     *
     * @return \Spryker\Client\Kernel\Container
     */
    public function provideServiceLayerDependencies(Container $container): Container
    {
        $container = parent::provideServiceLayerDependencies($container);
        $container = $this->addStorageClient($container);
        $container = $this->addSynchronizationService($container);
        $container = $this->addCartClient($container);
        $container = $this->addCustomerClient($container);
        $container = $this->addPriceClient($container);
        $container = $this->addCurrencyClient($container);
        $container = $this->addPriceProductClient($container);
        $container = $this->addProductStorageClient($container);
        $container = $this->addPriceProductStorageClient($container);

        return $container;
    }

    /**
     * @param \Spryker\Client\Kernel\Container $container
     *
     * @return \Spryker\Client\Kernel\Container
     */
    private function addStorageClient(Container $container): Container
    {
        $container[self::CLIENT_STORAGE] = function (Container $container) {
            return new StorageClientBridge($container->getLocator()->storage()->client());
        };

        return $container;
    }

    /**
     * @param \Spryker\Client\Kernel\Container $container
     *
     * @return \Spryker\Client\Kernel\Container
     */
    private function addSynchronizationService(Container $container): Container
    {
        $container[self::SERVICE_SYNCHRONIZATION] = function (Container $container) {
            return new SynchronizationServiceBridge($container->getLocator()->synchronization()->service());
        };

        return $container;
    }

    /**
     * @param \Spryker\Client\Kernel\Container $container
     *
     * @return \Spryker\Client\Kernel\Container
     */
    private function addCartClient(Container $container): Container
    {
        $container[self::CLIENT_CART] = function (Container $container) {
            return new CartClientBridge($container->getLocator()->cart()->client());
        };

        return $container;
    }

    /**
     * @param \Spryker\Client\Kernel\Container $container
     *
     * @return \Spryker\Client\Kernel\Container
     */
    private function addCustomerClient(Container $container): Container
    {
        $container[self::CLIENT_CUSTOMER] = function (Container $container) {
            return new CustomerClientBridge($container->getLocator()->customer()->client());
        };

        return $container;
    }

    /**
     * @param \Spryker\Client\Kernel\Container $container
     *
     * @return \Spryker\Client\Kernel\Container
     */
    private function addPriceClient(Container $container): Container
    {
        $container[self::CLIENT_PRICE] = function (Container $container) {
            return $container->getLocator()->price()->client();
        };

        return $container;
    }

    /**
     * @param \Spryker\Client\Kernel\Container $container
     *
     * @return \Spryker\Client\Kernel\Container
     */
    private function addCurrencyClient(Container $container): Container
    {
        $container[self::CLIENT_CURRENCY] = function (Container $container) {
            return $container->getLocator()->currency()->client();
        };

        return $container;
    }

    private function addPriceProductClient(Container $container): Container
    {
        $container[self::CLIENT_PRICE_PRODUCT] = function (Container $container) {
            return $container->getLocator()->priceProduct()->client();
        };

        return $container;
    }

    private function addProductStorageClient(Container $container): Container
    {
        $container[self::CLIENT_PRODUCT_STORAGE] = function (Container $container) {
            return $container->getLocator()->productStorage()->client();
        };

        return $container;
    }

    private function addPriceProductStorageClient(Container $container): Container
    {
        $container[self::CLIENT_PRICE_PRODUCT_STORAGE] = function (Container $container) {
            return $container->getLocator()->priceProductStorage()->client();
        };

        return $container;
    }
}
