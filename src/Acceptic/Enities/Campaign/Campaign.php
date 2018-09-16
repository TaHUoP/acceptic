<?php

namespace Acceptic\Entities\Campaign;


class Campaign {
    /**
     * @var OptimizationProps $optProps
     */
    private $optProps;

    /**
     * @var int
     */
    private $id;

    /**
     * @var array
     */
    private $publisherBlacklist;

    public function __construct(OptimizationProps $optimizationProps, int $id)
    {
        $this->optProps = $optimizationProps;
        $this->id = $id;
    }

    public function getOptimizationProps()
    {
        return $this->optProps;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getBlackList()
    {
        return !is_null($this->publisherBlacklist) ? $this->publisherBlacklist : [];
    }

    public function saveBlacklist(array $blacklist)
    {
        //implemented with testing purposes
        $this->publisherBlacklist = $blacklist;
    }
}
