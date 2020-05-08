<?php declare(strict_types = 1);

namespace Pyz\Client\Training\Storage;

use Generated\Shared\Transfer\ProductViewTransfer;
use Generated\Shared\Transfer\SynchronizationDataTransfer;
use Generated\Shared\Transfer\TrainingStorageItemTransfer;
use Pyz\Client\Training\Dependency\Client\StorageClientBridgeInterface;
use Pyz\Client\Training\Dependency\Service\SynchronizationServiceBridgeInterface;
use Pyz\Shared\Training\TrainingConstants;

class PriceItemStorageReader implements PriceItemStorageReaderInterface
{
    /** @var \Pyz\Client\Training\Dependency\Client\StorageClientBridgeInterface */
    private $storageClient;

    /** @var \Pyz\Client\Training\Dependency\Service\SynchronizationServiceBridgeInterface */
    private $synchronizationService;

    /**
     * @param \Pyz\Client\Training\Dependency\Client\StorageClientBridgeInterface $storageClient
     * @param \Pyz\Client\Training\Dependency\Service\SynchronizationServiceBridgeInterface $synchronizationService
     */
    public function __construct(
        StorageClientBridgeInterface $storageClient,
        SynchronizationServiceBridgeInterface $synchronizationService
    ) {
        $this->storageClient = $storageClient;
        $this->synchronizationService = $synchronizationService;
    }

    /**
     * @param string $customerNumber
     * @param int $idProductAbstract
     * @param string $localeName
     *
     * @return \Generated\Shared\Transfer\TrainingStorageItemTransfer|null
     */
    public function findData(string $customerNumber, int $idProductAbstract, string $localeName): ?TrainingStorageItemTransfer
    {
        $reference = $customerNumber . '_' . $idProductAbstract;
        $key = $this->getStorageKey($reference, $localeName);

        $storagePriceData = $this->storageClient->get($key);

        if (!$storagePriceData) {
            return null;
        }

        $trainingStorageItemTransfer = new TrainingStorageItemTransfer();
        $trainingStorageItemTransfer->fromArray($storagePriceData, true);

        return $trainingStorageItemTransfer;
    }

    /**
     * @param string $customerNumber
     * @param \Generated\Shared\Transfer\ProductViewTransfer $productViewTransfer
     * @param string $localeName
     *
     * @return array|\Generated\Shared\Transfer\TrainingStorageItemTransfer|null
     */
    public function findStorageData(string $customerNumber, ProductViewTransfer $productViewTransfer, string $localeName): ?TrainingStorageItemTransfer
    {
        $reference = $customerNumber . '_' . $productViewTransfer->getIdProductAbstract();
        $key = $this->getStorageKey($reference, $localeName);

        $storagePriceData = $this->storageClient->get($key);

        if (!$storagePriceData) {
            return null;
        }

        $trainingStorageItemTransfer = new TrainingStorageItemTransfer();
        $trainingStorageItemTransfer->fromArray($storagePriceData, true);

        return $trainingStorageItemTransfer;
    }

    /**
     * @param string $reference
     * @param string $localeName
     *
     * @return string
     */
    private function getStorageKey(string $reference, string $localeName): string
    {
        $synchronizationDataTransfer = new SynchronizationDataTransfer();
        $synchronizationDataTransfer
            ->setReference($reference)
            ->setLocale($localeName);

        return $this->synchronizationService
            ->getStorageKeyBuilder(TrainingConstants::TRAINING_RESOURCE_NAME)
            ->generateKey($synchronizationDataTransfer);
    }
}
