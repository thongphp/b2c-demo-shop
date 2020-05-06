<?php declare(strict_types = 1);

namespace PyzTest\Zed\Training\Persistence;

use Codeception\Test\Unit;
use Generated\Shared\Transfer\TrainingPriceItemTransfer;
use Orm\Zed\Training\Persistence\PyzTrainingPriceItem;
use Orm\Zed\Training\Persistence\PyzTrainingPriceItemQuery;
use Pyz\Zed\Training\Persistence\TrainingEntityManager;

class TrainingEntityManagerTest extends Unit
{
    /**
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function testSaveEntity(): void
    {
        $trainingPriceItemTransfer = new TrainingPriceItemTransfer();
        $trainingPriceItemTransfer->setCustomerNumber('99')
            ->setItemNumber('11')
            ->setQuantity(199)
            ->setPrice(12.49);

        $entityManager = new TrainingEntityManager();
        $entityManager->saveEntity($trainingPriceItemTransfer);

        $query = PyzTrainingPriceItemQuery::create()
            ->filterByCustomerNumber('99')
            ->filterByItemNumber('11');

        $results = $query->find();

        $this->assertCount(1, $results);
        $this->assertContainsOnlyInstancesOf(PyzTrainingPriceItem::class, $results);

        /** @var PyzTrainingPriceItem $price */
        $price = $results->getFirst();
        $this->assertSame(199, $price->getQuantity());
        $this->assertSame(12.49, $price->getPrice());
    }
}
