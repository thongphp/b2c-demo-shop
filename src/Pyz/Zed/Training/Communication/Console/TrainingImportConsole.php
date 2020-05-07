<?php declare(strict_types = 1);

namespace Pyz\Zed\Training\Communication\Console;

use Spryker\Zed\Kernel\Communication\Console\Console;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * @method \Pyz\Zed\Training\Business\TrainingFacadeInterface getFacade()
 */
class TrainingImportConsole extends Console
{
    private const COMMAND_NAME = 'training:import-new';

    protected function configure(): void
    {
        parent::configure();

        $this->setName(self::COMMAND_NAME);
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
        $this->getFacade()->import();

        return self::CODE_SUCCESS;
    }
}
