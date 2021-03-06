<?php
declare(strict_types=1);

namespace Funeralzone\ValueObjectGenerator\Definitions\Models;

use Countable;
use Funeralzone\ValueObjectGenerator\Definitions\Models\Exceptions\InvalidModel;
use Funeralzone\ValueObjectGenerator\Definitions\Models\Exceptions\ModelDoesNotExist;

final class ModelSet implements Countable
{
    private $models;
    private $modelsByName;

    public function __construct(array $models)
    {
        $this->validateInput($models);
        $this->models = $models;
        $this->modelsByName = $this->indexModelsByName($models);
    }

    public function all(): array
    {
        return $this->models;
    }

    public function allByName(): array
    {
        return $this->modelsByName;
    }

    public function hasByName(string $name): bool
    {
        return array_key_exists($name, $this->modelsByName);
    }

    public function getByName(string $name): Model
    {
        if ($this->hasByName($name)) {
            return $this->modelsByName[$name];
        } else {
            throw new ModelDoesNotExist($name);
        }
    }

    public function count()
    {
        return count($this->models);
    }

    private function indexModelsByName(array $models): array
    {
        $indexedModels = [];
        foreach ($models as $model) {
            /** @var Model $model */
            $indexedModels[$model->definitionName()] = $model;

            $indexedModels = array_merge(
                $indexedModels,
                $this->indexModelsByName($model->children()->all())
            );
        }
        return $indexedModels;
    }

    private function validateInput(array $models): void
    {
        foreach ($models as $model) {
            if (! $model instanceof Model) {
                throw new InvalidModel;
            }
        }
    }
}
