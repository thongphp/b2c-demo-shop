<?php declare(strict_types = 1);

namespace PyzTest\Zed\Training\Business\Reader;

use Codeception\Test\Unit;
use Generated\Shared\Transfer\TrainingPriceItemTransfer;
use Pyz\Zed\Training\Business\Model\Reader\PriceItemReader;
use Pyz\Zed\Training\Persistence\TrainingRepository;

class TrainingPriceItemReaderTest extends Unit
{
    /** @var \PyzTest\Zed\Training\TrainingPersistenceTester */
    protected $tester;

    public function findByCustomerNumberDataProvider(): array
    {
        return [
            [
                'customerNumber' => '77',
                'expectedCount' => 0,
            ],
            [
                'customerNumber' => '27',
                'expectedCount' => 4,
            ],
            [
                'customerNumber' => '28',
                'expectedCount' => 2,
            ]
        ];
    }

    /**
     * @dataProvider findByCustomerNumberDataProvider
     *
     * @param string $customerNumber
     * @param int $expectedCount
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException|\Propel\Runtime\Exception\PropelException
     */
    public function testFindByCustomerNumber(string $customerNumber, int $expectedCount): void
    {
        $this->prepareData();

        $trainingPriceItemReader = new PriceItemReader(new TrainingRepository());

        $prices = $trainingPriceItemReader->findByCustomerNumber($customerNumber);

        $this->assertContainsOnlyInstancesOf(TrainingPriceItemTransfer::class, $prices);
        $this->assertCount($expectedCount, $prices);
    }

    public function findByItemNumberDataProvider(): array
    {
        return [
            [
                'itemNumber' => '99',
                'expectedCount' => 0,
            ],
            [
                'itemNumber' => '30',
                'expectedCount' => 5,
            ],
            [
                'itemNumber' => '31',
                'expectedCount' => 1,
            ]
        ];
    }

    /**
     * @dataProvider findByItemNumberDataProvider
     *
     * @param string $itemNumber
     * @param int $expectedCount
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException|\Propel\Runtime\Exception\PropelException
     */
    public function testFindByItemNumber(string $itemNumber, int $expectedCount): void
    {
        $this->prepareData();

        $trainingPriceItemReader = new PriceItemReader(new TrainingRepository());

        $prices = $trainingPriceItemReader->findByItemNumber($itemNumber);

        $this->assertContainsOnlyInstancesOf(TrainingPriceItemTransfer::class, $prices);
        $this->assertCount($expectedCount, $prices);
    }

    /**
     * @throws \Propel\Runtime\Exception\PropelException
     */
    private function prepareData(): void
    {
        $dataJson = __DIR__ . '/../../_data/data.json';
        $this->tester->getFacade()->importDataFromJson($dataJson);
    }
}
