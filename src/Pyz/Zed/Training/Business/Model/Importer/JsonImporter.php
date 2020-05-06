<?php declare(strict_types = 1);

namespace Pyz\Zed\Training\Business\Model\Importer;

use Generated\Shared\Transfer\TrainingPriceItemTransfer;
use Pyz\Zed\Training\Business\Model\Writer\TrainingPriceItemWriterInterface;

class JsonImporter implements JsonImporterInterface
{
    /** @var \Pyz\Zed\Training\Business\Model\Writer\TrainingPriceItemWriterInterface */
    private $writer;

    /**
     * @param \Pyz\Zed\Training\Business\Model\Writer\TrainingPriceItemWriterInterface $writer
     */
    public function __construct(TrainingPriceItemWriterInterface $writer)
    {
        $this->writer = $writer;
    }

    /**
     * @param string $path
     *
     * @throws \Propel\Runtime\Exception\PropelException|\Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function importData(string $path): void
    {
        $jsonFileContent = file_get_contents($path);
        $data = json_decode($jsonFileContent, true);

        foreach ($data as $datum) {
            $prices = $datum['prices'];

            foreach ($prices as $price) {
                $trainingPriceItemTransfer = new TrainingPriceItemTransfer();
                $trainingPriceItemTransfer->setCustomerNumber($datum['customer_number']);
                $trainingPriceItemTransfer->setItemNumber($datum['item_number']);
                $trainingPriceItemTransfer->setQuantity((int) $price['quantity']);
                $trainingPriceItemTransfer->setPrice((float) $price['value']);

                $this->writer->saveEntity($trainingPriceItemTransfer);
            }
        }
    }
}
