<?php

namespace Acceptic\Contracts\DataSources;


interface EventDataSourceInterface
{
    public function getEvents() : array;

    public function getEventsSince(string $since) : array;
}