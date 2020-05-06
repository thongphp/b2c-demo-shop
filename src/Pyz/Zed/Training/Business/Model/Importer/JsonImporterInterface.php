<?php declare(strict_types = 1);

namespace Pyz\Zed\Training\Business\Model\Importer;

interface JsonImporterInterface
{
    /**
     * @param string $path
     *
     * @throws \Propel\Runtime\Exception\PropelException|\Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function importData(string $path): void;
}
