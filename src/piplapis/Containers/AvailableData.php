<?php

namespace Pipl\Containers;

use Pipl\Containers\FieldCount;

class AvailableData
{
    function __construct($basic = NULL, $premium = NULL)
    {
        $this->basic = $basic ? FieldCount::from_array($basic) : NULL;
        $this->premium = $premium ? FieldCount::from_array($premium) : NULL;

    }
    public static function from_array($params) {
        $basic = !empty($params['basic']) ? $params['basic'] : NULL;
        $premium = !empty($params['premium']) ? $params['premium'] : NULL;
        $instance = new self($basic, $premium);
        return $instance;
    }
    public function to_array() {
        $res = array();
        if ($this->basic != NULL)
            $res['basic'] = $this->basic->to_array();
        if ($this->premium != NULL)
            $res['premium'] = $this->premium->to_array();
        return $res;
    }
}