<?php
declare(strict_types=1);

namespace Funeralzone\ValueObjectGenerator\Definitions\Events;

use Funeralzone\ValueObjectGenerator\Definitions\Deltas\DeltaPayload;
use Funeralzone\ValueObjectGenerator\Definitions\Location;
use Funeralzone\ValueObjectGenerator\Definitions\Models\ModelPayload;

final class Event
{
    private $location;
    private $definitionName;
    private $payload;
    private $deltas;
    private $meta;

    public function __construct(
        Location $location,
        string $definitionName,
        ModelPayload $payload,
        DeltaPayload $deltas,
        EventMeta $meta
    ) {
        $this->location = $location;
        $this->definitionName = $definitionName;
        $this->payload = $payload;
        $this->deltas = $deltas;
        $this->meta = $meta;
    }

    public function location(): Location
    {
        return $this->location;
    }

    public function definitionName(): string
    {
        return $this->definitionName;
    }

    public function payload(): ModelPayload
    {
        return $this->payload;
    }

    public function deltas(): DeltaPayload
    {
        return $this->deltas;
    }

    public function meta(): EventMeta
    {
        return $this->meta;
    }
}