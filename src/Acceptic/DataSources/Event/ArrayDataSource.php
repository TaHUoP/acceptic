<?php

namespace Acceptic\DataSources\Event;


use Acceptic\Contracts\DataSources\EventDataSourceInterface;
use Acceptic\Entities\Event;

class ArrayDataSource implements EventDataSourceInterface
{
    /**
     * In a real life example or in a more extended test task
     * I would use factories to instantiate entities
     */
    public function getEvents() : array
    {
        $events = [];

        for ($i = 1; $i <= 2; $i++) {
            for ($j = 1; $j <= 4; $j++) {
                for ($k = 1; $k <= 10; $k++) {
                    $events []= new Event('install', $i, $j);

                    if ($k < 3 || $j == 2)
                        $events []= new Event('purchase', $i, $j);
                }
            }
        }

        return $events;
    }

    public function getEventsSince(string $since) : array
    {
        return $this->getEvents();
    }
}