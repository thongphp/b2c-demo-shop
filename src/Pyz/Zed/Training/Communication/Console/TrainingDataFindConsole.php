<?php declare(strict_types = 1);

namespace Pyz\Zed\Training\Communication\Console;

use Spryker\Zed\Kernel\Communication\Console\Console;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * @method \Pyz\Zed\Training\Business\TrainingFacade getFacade()
 */
class TrainingDataFindConsole extends Console
{
    private const COMMAND_NAME = 'training:find';
    private const DESCRIPTION = 'List imported data';
    private const OPTION_CUSTOMER_NUMBER = 'customer';
    private const OPTION_CUSTOMER_NUMBER_SHORT = 'c';
    private const OPTION_ITEM_NUMBER = 'item';
    private const OPTION_ITEM_NUMBER_SHORT = 'i';

    protected function configure(): void
    {
        parent::configure();

        $this->setName(self::COMMAND_NAME);
        $this->setDescription(self::DESCRIPTION);
        $this->addOption(self::OPTION_CUSTOMER_NUMBER, self::OPTION_CUSTOMER_NUMBER_SHORT, InputOption::VALUE_OPTIONAL);
        $this->addOption(self::OPTION_ITEM_NUMBER, self::OPTION_ITEM_NUMBER_SHORT, InputOption::VALUE_OPTIONAL);
    }

    /**
     * @param \Symfony\Component\Console\Input\InputInterface $input
     * @param \Symfony\Component\Console\Output\OutputInterface $output
     *
     * @return int
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function run(InputInterface $input, OutputInterface $output): int
    {
        $results = null;

        $customerNumber = (string) $input->getOption(self::OPTION_CUSTOMER_NUMBER);
        $itemNumber = (string) $input->getOption(self::OPTION_ITEM_NUMBER);

        if (!empty($customerNumber)) {
            $results = $this->getFacade()->findPricesByCustomerNumber($customerNumber);
        } elseif (!empty($itemNumber)) {
            $results = $this->getFacade()->findPricesByItemNumber($itemNumber);
        }

        foreach ($results as $result) {
            /** @var \Generated\Shared\Transfer\TrainingPriceItemTransfer $result */
            dump($result->toArray());
        }

        return self::CODE_SUCCESS;
    }
}
