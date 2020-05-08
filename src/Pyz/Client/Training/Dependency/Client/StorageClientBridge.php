<?php declare(strict_types = 1);

namespace Pyz\Client\Training\Dependency\Client;

class StorageClientBridge implements StorageClientBridgeInterface
{
    /**
     * @var \Spryker\Client\Storage\StorageClientInterface
     */
    protected $storageClient;

    /**
     * @param \Spryker\Client\Storage\StorageClientInterface $storageClient
     */
    public function __construct($storageClient)
    {
        $this->storageClient = $storageClient;
    }

    /**
     * @param string $key
     *
     * @return mixed
     */
    public function get($key)
    {
        return $this->storageClient->get($key);
    }

    /**
     * @param string[] $keys
     *
     * @return mixed
     */
    public function getMulti(array $keys)
    {
        return $this->storageClient->getMulti($keys);
    }
}
