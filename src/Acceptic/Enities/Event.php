<?php

namespace Acceptic\Entities;


class Event {
    private $type;
    private $campaignId;
    private $publisherId;

    public function __construct(string $type, int $campaignId, int $publisherId)
    {
        $this->type = $type;
        $this->campaignId = $campaignId;
        $this->publisherId = $publisherId;
    }

    public function getType()
    {
        // for example "install"
        return $this->type;
    }

    public function isType(string $type)
    {
        // for example "install"
        return $this->type === $type;
    }

    public function getCampaignId()
    {
        return $this->campaignId;
    }

    public function getPublisherId()
    {
        return $this->publisherId;
    }
}