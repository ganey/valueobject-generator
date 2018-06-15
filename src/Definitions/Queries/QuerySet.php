<?php
declare(strict_types=1);

namespace Funeralzone\ValueObjectGenerator\Definitions\Queries;

use Countable;
use Funeralzone\ValueObjectGenerator\Definitions\Queries\Exceptions\InvalidQuery;

final class QuerySet implements Countable
{
    private $commands;

    public function __construct(array $commands)
    {
        $this->validateInput($commands);
        $this->commands = $commands;
    }

    public function all(): array
    {
        return $this->commands;
    }

    public function count()
    {
        return count($this->commands);
    }

    private function validateInput(array $commands): void
    {
        foreach ($commands as $model) {
            if (! $model instanceof Query) {
                throw new InvalidQuery;
            }
        }
    }
}