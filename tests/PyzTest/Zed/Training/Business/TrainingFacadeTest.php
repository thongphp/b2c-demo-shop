<?php declare(strict_types = 1);

namespace PyzTest\Zed\Training\Business;

use Codeception\Test\Unit;
use Orm\Zed\Training\Persistence\PyzTrainingPriceItem;
use Orm\Zed\Training\Persistence\PyzTrainingPriceItemQuery;

class TrainingFacadeTest extends Unit
{
    /** @var \PyzTest\Zed\Training\TrainingBusinessTester */
    protected $tester;

    /**
     * @throws \Propel\Runtime\Exception\PropelException
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function testImportData(): void
    {
        $trainingFacade = $this->tester->getTrainingFacade();

        $trainingFacade->importDataFromJson(__DIR__ . '/../_data/dara_import.json');

        $results = PyzTrainingPriceItemQuery::create()
            ->filterByCustomerNumber('99')
            ->filterByItemNumber('11')
            ->find();

        $this->assertContainsOnlyInstancesOf(PyzTrainingPriceItem::class, $results);
        $this->assertCount(1, $results);

        /** @var PyzTrainingPriceItem $singleItem */
        $singleItem = $results->getFirst();

        $this->assertEquals('99', $singleItem->getCustomerNumber());
        $this->assertEquals('11', $singleItem->getItemNumber());
        $this->assertEquals(19, $singleItem->getQuantity());
        $this->assertEquals(237.99, $singleItem->getPrice());
    }

    /**
     * @throws \Propel\Runtime\Exception\PropelException
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function testUpdateImportData(): void
    {
        $this->testImportData();

        $trainingFacade = $this->tester->getTrainingFacade();
        $trainingFacade->importDataFromJson(__DIR__ . '/../_data/data_update.json');

        $results = PyzTrainingPriceItemQuery::create()
            ->filterByCustomerNumber('99')
            ->filterByItemNumber('11')
            ->find();

        $this->assertContainsOnlyInstancesOf(PyzTrainingPriceItem::class, $results);
        $this->assertCount(1, $results);

        /** @var PyzTrainingPriceItem $singleItem */
        $singleItem = $results->getFirst();

        $this->assertEquals('99', $singleItem->getCustomerNumber());
        $this->assertEquals('11', $singleItem->getItemNumber());
        $this->assertEquals(19, $singleItem->getQuantity());
        $this->assertEquals(123.59, $singleItem->getPrice());
    }
}
