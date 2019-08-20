<?php

namespace Pipl\Fields;

use Pipl\Fields\Field;

class EducationField extends Field
{
    // Education information of a person.

    protected $children = array('degree', 'school', 'date_range', 'display');

    function __construct($params=array())
    {
        extract($params);
        parent::__construct($params);

        // `degree` and `school` should both be strings.
        // `date_range` is A DateRange object (DateRangeField),
        // that's the time the person was studying.

        if (!empty($degree))
        {
            $this->degree = $degree;
        }
        if (!empty($school))
        {
            $this->school = $school;
        }
        if (!empty($date_range))
        {
            $this->date_range = $date_range;
        }
        if (!empty($display))
        {
            $this->display = $display;
        }
    }
}