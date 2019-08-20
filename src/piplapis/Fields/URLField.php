<?php

namespace Pipl\Fields;

use Pipl\APIUtil;

class URLField extends Field
{
    //  A URL that's related to a person. Can either be a source of data
    //  about the person, or a URL otherwise related to the person.

    protected $attributes = array('category', 'sponsored', 'source_id', 'name', 'domain');
    protected $children = array('url');

    function __construct($params=array())
    {
        extract($params);
        parent::__construct($params);

        //    `url` is the URL address itself
        //    `domain` is the URL's domain
        //    `name` is the website name
        //    `category` is the URL's category.
        //
        //    `url`, `category`, `domain` and `name` should all be strings.
        //
        //    `sponsored` is a boolean - whether the URL is sponsored or not

        if (!empty($url))
        {
            $this->url = $url;
        }
        if (!empty($category))
        {
            $this->category = $category;
        }
        if (!empty($source_id))
        {
            $this->source_id = $source_id;
        }
        if (!empty($name))
        {
            $this->name = $name;
        }
        if (!empty($domain))
        {
            $this->domain = $domain;
        }
        if (!empty($sponsored))
        {
            $this->sponsored = $sponsored;
        }
    }

    public function is_valid_url()
    {
        // A bool value that indicates whether the URL is a valid URL.
        return (!empty($this->url) && APIUtil::piplapi_is_valid_url($this->url));
    }

    public function is_searchable()
    {
        return (!empty($this->url));
    }

    public function __toString(){
        return $this->url ? $this->url : $this->name;
    }
}