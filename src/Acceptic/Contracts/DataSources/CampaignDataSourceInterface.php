<?php

namespace Acceptic\Contracts\DataSources;


interface CampaignDataSourceInterface
{
    public function getCampaigns() : array;
}