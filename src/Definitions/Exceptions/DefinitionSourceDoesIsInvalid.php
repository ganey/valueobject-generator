<?php
declare(strict_types=1);

namespace Funeralzone\ValueObjectGenerator\Definitions\Exceptions;

final class DefinitionSourceDoesIsInvalid extends \Exception
{
    public function __construct(string $error)
    {
        parent::__construct(sprintf('The supplied definition source is invalid - %s', $error));
    }
}
