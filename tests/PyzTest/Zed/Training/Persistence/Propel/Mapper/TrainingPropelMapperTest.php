<?php declare(strict_types = 1);

namespace PyzTest\Zed\Training\Persistence\Propel\Mapper;

use Codeception\Test\Unit;
use Orm\Zed\Training\Persistence\PyzTrainingPriceItem;
use Pyz\Zed\Training\Persistence\Propel\Mapper\TrainingMapper;

class TrainingPropelMapperTest extends Unit
{
    public function testConvertEntityToTransfer(): void
    {
        $entity = new PyzTrainingPriceItem();
        $entity->setCustomerNumber('10')
            ->setItemNumber('20')
            ->setQuantity(99)
            ->setPrice(14.99);

        $transfer = (new TrainingMapper())->transferEntityToTransfer($entity);

        $this->assertEquals('10', $transfer->getCustomerNumber());
        $this->assertEquals('20', $transfer->getItemNumber());
        $this->assertEquals(99, $transfer->getQuantity());
        $this->assertEquals(14.99, $transfer->getPrice());
    }

    public function testConvertEntitiesToTransfers(): void
    {
        $firstEntity = new PyzTrainingPriceItem();
        $firstEntity->setCustomerNumber('10')
            ->setItemNumber('20')
            ->setQuantity(99)
            ->setPrice(14.99);
        $secondEntity = new PyzTrainingPriceItem();
        $secondEntity->setCustomerNumber('15')
            ->setItemNumber('25')
            ->setQuantity(35)
            ->setPrice(44.69);

        $transfers = (new TrainingMapper())->transferEntitiesToTransfers([$firstEntity, $secondEntity]);

        [$firstTransfer, $secondTransfer] = $transfers;

        $this->assertEquals('10', $firstTransfer->getCustomerNumber());
        $this->assertEquals('20', $firstTransfer->getItemNumber());
        $this->assertEquals(99, $firstTransfer->getQuantity());
        $this->assertEquals(14.99, $firstTransfer->getPrice());

        $this->assertEquals('15', $secondTransfer->getCustomerNumber());
        $this->assertEquals('25', $secondTransfer->getItemNumber());
        $this->assertEquals(35, $secondTransfer->getQuantity());
        $this->assertEquals(44.69, $secondTransfer->getPrice());
    }
}
