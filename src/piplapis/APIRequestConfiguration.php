<?php

namespace Pipl;

class APIRequestConfiguration
{

    public $api_key = NULL;
    public $minimum_probability = NULL;
    public $minimum_match = NULL;
    public $show_sources = NULL;
    public $live_feeds = NULL;
    public $use_https = NULL;
    public $hide_sponsored = NULL;
    public $match_requirements = NULL;
    public $source_category_requirements = NULL;
    public $infer_persons = NULL;

    function __construct($api_key = "YOUR_KEY", $minimum_probability = NULL, $minimum_match = NULL, $show_sources = NULL,
                         $live_feeds = NULL, $hide_sponsored = NULL, $use_https = false, $match_requirements = NULL,
                         $source_category_requirements = NULL, $infer_persons = NULL)
    {
        $this->api_key = $api_key;
        $this->minimum_probability = $minimum_probability;
        $this->minimum_match = $minimum_match;
        $this->show_sources = $show_sources;
        $this->live_feeds = $live_feeds;
        $this->hide_sponsored = $hide_sponsored;
        $this->use_https = $use_https;
        $this->match_requirements = $match_requirements;
        $this->source_category_requirements = $source_category_requirements;
        $this->infer_persons = $infer_persons;
    }

}