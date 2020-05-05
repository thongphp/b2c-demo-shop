<?php declare(strict_types = 1);

namespace PyzTest\Zed\Training\Business\Reader;

use Codeception\Test\Unit;
use Generated\Shared\Transfer\TrainingPriceItemTransfer;

class TrainingPriceItemReaderTest extends Unit
{
    /** @var \PyzTest\Zed\Training\TrainingPersistenceTester */
    protected $tester;

    public function findByCustomerNumberDataProvider(): array
    {
        return [
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
     */
    public function testFindByCustomerNumber(string $customerNumber, int $expectedCount): void
    {
        $this->prepareData();

        $prices = $this->tester->getFacade()->findPricesByCustomerNumber($customerNumber);

        $this->assertContainsOnlyInstancesOf(TrainingPriceItemTransfer::class, $prices);
        $this->assertCount($expectedCount, $prices);
    }

    public function findByItemNumberDataProvider(): array
    {
        return [
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
     */
    public function testFindByItemNumber(string $itemNumber, int $expectedCount): void
    {
        $this->prepareData();

        $prices = $this->tester->getFacade()->findPricesByItemNumber($itemNumber);

        $this->assertContainsOnlyInstancesOf(TrainingPriceItemTransfer::class, $prices);
        $this->assertCount($expectedCount, $prices);
    }

    private function prepareData(): void
    {
        $dataJson = __DIR__ . '/../../_data/data.json';
        $this->tester->getFacade()->importDataFromJson($dataJson);
    }
}
