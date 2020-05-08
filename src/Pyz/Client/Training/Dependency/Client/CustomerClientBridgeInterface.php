<?php declare(strict_types = 1);

namespace Pyz\Client\Training\Dependency\Client;

use Generated\Shared\Transfer\CustomerTransfer;

interface CustomerClientBridgeInterface
{
    /**
     * @return \Generated\Shared\Transfer\CustomerTransfer|null
     */
    public function getCustomer(): ?CustomerTransfer;
}
