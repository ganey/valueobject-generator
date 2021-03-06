<?php
declare(strict_types=1);

namespace Funeralzone\ValueObjectGenerator\Definitions;

use Funeralzone\ValueObjectGenerator\Definitions\Models\ModelSet;

final class Definition
{
    private $models;

    public function __construct(
        ModelSet $models
    ) {
        $this->models = $models;
    }

    public function models(): ModelSet
    {
        return $this->models;
    }

    public function merge(Definition ...$definitions): Definition
    {
        if (count($definitions)) {
            array_unshift($definitions, $this);

            $models = [];
            foreach ($definitions as $definition) {
                foreach ($definition->models->all() as $model) {
                    $models[] = $model;
                }
            }

            return new Definition(
                new ModelSet($models)
            );
        } else {
            return $this;
        }
    }
}
