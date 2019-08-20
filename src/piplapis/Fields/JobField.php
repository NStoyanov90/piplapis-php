<?php

namespace Pipl\Fields;

use Pipl\Fields\Field;

class JobField extends Field
{
    // Job information of a person.

    protected $children = array('title', 'organization', 'industry', 'date_range', 'display');

    function __construct($params=array())
    {
        extract($params);
        parent::__construct($params);

        // `title`, `organization`, `industry`, should all be strings.
        // `date_range` is A DateRange object (DateRangeField),
        // that's the time the person held this job.

        if (!empty($title))
        {
            $this->title = $title;
        }
        if (!empty($organization))
        {
            $this->organization = $organization;
        }
        if (!empty($industry))
        {
            $this->industry = $industry;
        }
        if (!empty($display))
        {
            $this->display = $display;
        }
        if (!empty($date_range))
        {
            $this->date_range = $date_range;
        }
    }

}