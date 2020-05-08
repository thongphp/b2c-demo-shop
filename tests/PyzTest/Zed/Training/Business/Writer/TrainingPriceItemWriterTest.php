<?php declare(strict_types = 1);

namespace PyzTest\Zed\Training\Business\Writer;

use Codeception\Test\Unit;
use Generated\Shared\Transfer\TrainingPriceItemTransfer;
use Pyz\Zed\Training\Persistence\TrainingEntityManager;

class TrainingPriceItemWriterTest extends Unit
{
    /**
     * @throws \Propel\Runtime\Exception\PropelException
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function testSaveEntity(): void
    {
        $writer = new \Pyz\Zed\Training\Business\Model\Writer\PriceItemWriter(new TrainingEntityManager());

        $trainingPriceItemTransfer = new TrainingPriceItemTransfer();
        $trainingPriceItemTransfer->setCustomerNumber('99')
            ->setItemNumber('11')
            ->setQuantity(199)
            ->setPrice(12.49);

        $writer->saveEntity($trainingPriceItemTransfer);

        $trainingPriceItemTransfer->setPrice(99.49);

        $result = $writer->saveEntity($trainingPriceItemTransfer);

        $this->assertEquals(99.49, $result->getPrice());
    }
}
