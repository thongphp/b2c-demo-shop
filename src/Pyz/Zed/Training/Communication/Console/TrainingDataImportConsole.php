<?php declare(strict_types = 1);

namespace Pyz\Zed\Training\Communication\Console;

use Spryker\Zed\Kernel\Communication\Console\Console;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * @method \Pyz\Zed\Training\Business\TrainingFacade getFacade()
 */
class TrainingDataImportConsole extends Console
{
    private const COMMAND_NAME = 'training:data-import';
    private const DESCRIPTION = 'Import data';
    private const ARGUMENT_PATH = 'path';

    protected function configure(): void
    {
        parent::configure();

        $this->setName(self::COMMAND_NAME);
        $this->setDescription(self::DESCRIPTION);
        $this->addArgument(self::ARGUMENT_PATH, InputArgument::REQUIRED);
    }

    /**
     * @param \Symfony\Component\Console\Input\InputInterface $input
     * @param \Symfony\Component\Console\Output\OutputInterface $output
     *
     * @return int
     *
     * @throws \Propel\Runtime\Exception\PropelException
     * @throws \Spryker\Zed\Kernel\Exception\Container\ContainerKeyNotFoundException
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function run(InputInterface $input, OutputInterface $output): int
    {
        $jsonFilePath = $input->getArgument(self::ARGUMENT_PATH);

        $this->getFacade()->importDataFromJson($jsonFilePath);

        return self::CODE_SUCCESS;
    }
}
