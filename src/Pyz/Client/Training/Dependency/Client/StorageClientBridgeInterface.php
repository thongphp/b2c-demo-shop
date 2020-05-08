<?php declare(strict_types = 1);

namespace Pyz\Client\Training\Dependency\Client;

interface StorageClientBridgeInterface
{
    /**
     * @param string $key
     *
     * @return mixed
     */
    public function get($key);

    /**
     * @param string[] $keys
     *
     * @return mixed
     */
    public function getMulti(array $keys);
}
