<?php declare(strict_types = 1);

namespace Pyz\Zed\Training\Business;

use Spryker\Zed\Kernel\Business\AbstractFacade;

/**
 * @method \Pyz\Zed\Training\Business\TrainingBusinessFactory getFactory()
 */
class TrainingFacade extends AbstractFacade implements TrainingFacadeInterface
{
    /**
     * @param string $path
     *
     * @throws \Propel\Runtime\Exception\PropelException|\Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function importDataFromJson(string $path): void
    {
        $this->getFactory()->createDataImportFromJson()->importData($path);
    }

    /**
     * @param string $customerNumber
     *
     * @return null|\Generated\Shared\Transfer\TrainingPriceItemTransfer[]
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function findPricesByCustomerNumber(string $customerNumber): ?array
    {
        return $this->getFactory()
            ->createPriceItemReader()
            ->findByCustomerNumber($customerNumber);
    }

    /**
     * @param string $itemNumber
     *
     * @return null|\Generated\Shared\Transfer\TrainingPriceItemTransfer[]
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function findPricesByItemNumber(string $itemNumber): ?array
    {
        return $this->getFactory()
            ->createPriceItemReader()
            ->findByItemNumber($itemNumber);
    }
}
