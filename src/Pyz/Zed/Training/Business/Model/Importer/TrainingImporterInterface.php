<?php declare(strict_types = 1);

namespace Pyz\Zed\Training\Business\Model\Importer;

interface TrainingImporterInterface
{
    public function import(): void;
}
