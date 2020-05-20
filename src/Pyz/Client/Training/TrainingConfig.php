<?php declare(strict_types=1);

namespace Pyz\Client\Training;

use Spryker\Client\Kernel\AbstractBundleConfig;

class TrainingConfig extends AbstractBundleConfig
{
    /**
     * @return string
     */
    public function getDefaultCustomerNumber(): string
    {
        return '27';
    }
}
