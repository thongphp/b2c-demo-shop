<?php declare(strict_types = 1);

namespace Pyz\Zed\Training;

use Pyz\Zed\Training\Dependency\Facade\TrainingToEventBridge;
use Pyz\Zed\TrainingImportJson\Communication\Plugin\Training\Import\ImportJsonPluginProvider;
use Spryker\Zed\Kernel\AbstractBundleDependencyProvider;
use Spryker\Zed\Kernel\Container;

class TrainingDependencyProvider extends AbstractBundleDependencyProvider
{
    public const FACADE_EVENT = 'FACADE_EVENT';
    public const PLUGIN_IMPORT_COLLECTION = 'PLUGIN_IMPORT_COLLECTION';

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function provideBusinessLayerDependencies(Container $container): Container
    {
        $container = parent::provideBusinessLayerDependencies($container);

        $container = $this->addEventFacade($container);
        $container = $this->addImportPluginCollection($container);

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    private function addEventFacade(Container $container): Container
    {
        $container[static::FACADE_EVENT] = function (Container $container) {
            return new TrainingToEventBridge($container->getLocator()->event()->facade());
        };

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    private function addImportPluginCollection(Container $container): Container
    {
        $container[static::PLUGIN_IMPORT_COLLECTION] = function (Container $container) {
            return [
                new ImportJsonPluginProvider(),
            ];
        };

        return $container;
    }
}
