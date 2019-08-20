<?php

namespace Pipl\Fields;

use Pipl\APIUtil;
use Pipl\Fields\Field;

class OriginCountryField extends Field
{
//  An origin country of the person.
    protected $children = array('country');

    function __construct($params=array())
    {
        extract($params);
        parent::__construct($params);

        // `country` is a two letter country code.

        if (!empty($country))
        {
            $this->country = $country;
        }
    }

    public function __toString(){
        if (!empty($this->country))
        {
            $uppedcoutnry = strtoupper($this->country);
            return array_key_exists($uppedcoutnry, APIUtil::$piplapi_countries) ?
                APIUtil::$piplapi_countries[$uppedcoutnry] : NULL;
        }
        return "";
    }
}