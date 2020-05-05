<?php declare(strict_types = 1);

namespace PyzTest\Zed\Training\Persistence;

use Codeception\Test\Unit;
use Orm\Zed\Training\Persistence\PyzTrainingPriceItem;
use Pyz\Zed\Training\Persistence\TrainingRepository;

class TrainingRepositoryTest extends Unit
{
    /** @var \PyzTest\Zed\Training\TrainingPersistenceTester */
    protected $tester;

    /** @var TrainingRepository */
    protected $repository;

    protected function setUp(): void
    {
        parent::setUp();

        $this->repository = new TrainingRepository();
    }

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
     *
     * @throws \Propel\Runtime\Exception\PropelException
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function testFindByCustomerNumber(string $customerNumber, int $expectedCount): void
    {
        $this->prepareData();

        $results = $this->repository->findByCustomerNumber($customerNumber);

        $this->assertContainsOnlyInstancesOf(PyzTrainingPriceItem::class, $results);
        $this->assertCount($expectedCount, $results);
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
     *
     * @throws \Propel\Runtime\Exception\PropelException
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function testFindByItemNumber(string $itemNumber, int $expectedCount): void
    {
        $this->prepareData();

        $results = $this->repository->findByItemNumber($itemNumber);

        $this->assertContainsOnlyInstancesOf(PyzTrainingPriceItem::class, $results);
        $this->assertCount($expectedCount, $results);
    }

    /**
     * @throws \Propel\Runtime\Exception\PropelException
     */
    private function prepareData(): void
    {
        $dataJson = __DIR__ . '/../_data/data.json';
        $this->tester->getFacade()->importDataFromJson($dataJson);
    }
}
