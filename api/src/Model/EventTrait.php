<?php

declare(strict_types=1);

namespace Api\Model;

trait EventTrait
{
    private $recordEvents = [];

    protected function recordEvent($event): void
    {
        $this->recordEvents[] = $event;
    }

    public function releaseEvents(): array
    {
        $events = $this->recordEvents;
        $this->recordEvents = [];
        return $events;
    }
}