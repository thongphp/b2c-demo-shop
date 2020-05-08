<?php declare(strict_types = 1);

namespace Pyz\Client\Training\Storage;

use Generated\Shared\Transfer\ProductViewTransfer;
use Generated\Shared\Transfer\TrainingStorageItemTransfer;

interface PriceItemStorageReaderInterface
{
    /**
     * @param string $customerNumber
     * @param \Generated\Shared\Transfer\ProductViewTransfer $productViewTransfer
     * @param string $localeName
     *
     * @return \Generated\Shared\Transfer\TrainingStorageItemTransfer|null
     */
    public function findStorageData(string $customerNumber, ProductViewTransfer $productViewTransfer, string $localeName): ?TrainingStorageItemTransfer;

    /**
     * @param string $customerNumber
     * @param int $idProductAbstract
     * @param string $localeName
     *
     * @return \Generated\Shared\Transfer\TrainingStorageItemTransfer|null
     */
    public function findData(string $customerNumber, int $idProductAbstract, string $localeName): ?TrainingStorageItemTransfer;
}
