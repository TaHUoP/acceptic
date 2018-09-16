<?php

namespace Acceptic\Jobs;

use Acceptic\DataSources\Campaign\ArrayDataSource as CampaignDataSource;
use Acceptic\DataSources\Event\ArrayDataSource as EventDataSource;
use Acceptic\Entities\Event;

class OptimizationJob {

    public function run() {
        $campaignDS = new CampaignDataSource();

        // array of Campaign objects
        $_campaigns = $campaignDS->getCampaigns();

        //In real life examples there most likely are ways to get array of Campaign objects
        //already keyed by id (or other field/property) straight from data source
        $campaigns = [];
        foreach ($_campaigns as $campaign) {
            $campaigns[$campaign->getId()] = $campaign;
        }

        $eventDS = new EventDataSource();
        $events_count = [];
        /**
         * @var Event $event
         */
        foreach($eventDS->getEventsSince("2 weeks ago") as $event) {
            $props = $campaigns[$event->getCampaignId()]->getOptimizationProps();

            if ($event->isType($props->sourceEvent))
                $events_count[$event->getCampaignId()][$event->getPublisherId()]['source']++;
            elseif ($event->isType($props->measuredEvent))
                $events_count[$event->getCampaignId()][$event->getPublisherId()]['measured']++;
        }

        foreach ($events_count as $campaign_id => $counts_by_publisher) {
            $blacklist = [];
            $campaign = $campaigns[$campaign_id];
            $old_blacklist = $campaign->getBlackList();
            $props = $campaign->getOptimizationProps();

            foreach ($counts_by_publisher as $publisher_id => $counts) {
                if (
                    $counts['source'] >= $props->threshold
                    && $counts['measured'] < $props->ratioThreshold * $counts['source']
                )
                    $blacklist []= $publisher_id;
            }

            $newly_blacklisted = array_diff($blacklist, $old_blacklist);
            foreach ($newly_blacklisted as $publisher_id) {
                //Send email to publisher that he is blacklisted.
                //I recommend using queues to avoid blocking of current job while the email is sending.
                //Optionally this code can be refactored to send one email to publisher with all
                //campaigns listed in it.
            }

            $unblacklisted = array_diff($old_blacklist, $blacklist);
            foreach ($unblacklisted as $publisher_id) {
                //Send email to publisher that he is removed from blacklist.
                //I recommend using queues to avoid blocking of current job while the email is sending.
                //Optionally this code can be refactored to send one email to publisher with all
                //campaigns listed in it.
            }

            $campaign->saveBlacklist($blacklist);
        }

    }
}