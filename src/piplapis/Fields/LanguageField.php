<?php

namespace Pipl\Fields;

use Pipl\Fields\Field;

class LanguageField extends Field
{
//  A language the person is familiar with.
    protected $children = array('language', "region", "display");

    function __construct($params=array())
    {
        extract($params);
        parent::__construct($params);

        // `language` is the language code itself. For example "en"
        // `region` is the language region. For example "US"
        // `display` is a display value. For example "en_US"


        if (!empty($language))
        {
            $this->language = $language;
        }
        if (!empty($display))
        {
            $this->display = $display;
        }
        if (!empty($region))
        {
            $this->region = $region;
        }
    }
}