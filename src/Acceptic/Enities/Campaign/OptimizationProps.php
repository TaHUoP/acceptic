<?php

namespace Acceptic\Entities\Campaign;


class OptimizationProps {
    public $threshold, $sourceEvent, $measuredEvent, $ratioThreshold;

    public function __construct(int $threshold, string $sourceEvent, string $measuredEvent, float $ratioThreshold)
    {
        $this->threshold = $threshold;
        $this->sourceEvent = $sourceEvent;
        $this->measuredEvent = $measuredEvent;
        $this->ratioThreshold = $ratioThreshold;
    }
}