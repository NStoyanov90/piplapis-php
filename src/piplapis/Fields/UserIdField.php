<?php

namespace Pipl\Fields;

use Pipl\Fields\Field;

class UserIdField extends Field
{
    // An ID associated with a person.

    // The ID is a string that's used by the site to uniquely identify a person,
    // it's guaranteed that in the site this string identifies exactly one person.

    protected $children = array('content');

    function __construct($params=array())
    {
        extract($params);
        parent::__construct($params);

        // `content` is the ID itself, it should be a string.


        if (!empty($content))
        {
            $this->content = $content;
        }
    }

    public function is_searchable()
    {
        return (!empty($this->content)) && preg_match('/(.)@(.)/', $this->content);
    }

    public function __toString(){
        return $this->content;
    }
}