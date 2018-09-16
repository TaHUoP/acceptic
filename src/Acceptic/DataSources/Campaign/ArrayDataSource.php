<?php

namespace Acceptic\DataSources\Campaign;


use Acceptic\Contracts\DataSources\CampaignDataSourceInterface;
use Acceptic\Entities\Campaign\Campaign;
use Acceptic\Entities\Campaign\OptimizationProps;

class ArrayDataSource implements CampaignDataSourceInterface
{
    /**
     * In a real life example or in a more extended test task
     * I would use factories to instantiate entities
     */
    public function getCampaigns() : array
    {
        $campaign1 = new Campaign(new OptimizationProps(10, 'install', 'purchase', 0.75), 1);
        //previously blacklisted publisher ids which must not appear
        // in mailing about blacklisting if they will be blacklisted
        // and must appear in mailing about unblacklisting if they will
        // not be blacklisted
        $campaign1->saveBlacklist([2,3]);

        $campaign2 = new Campaign(new OptimizationProps(20, 'install', 'purchase', 0.5), 2);

        return [
            $campaign1,
            $campaign2,
        ];
    }
}