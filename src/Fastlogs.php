<?php

namespace fastlogs\FastlogsBundle;

use fastlogs\sdk\Sender;

class Fastlogs
{
    private $slug;
    private $url;

    public function __construct($slug, $url)
    {
        $this->slug = $slug;
        $this->url = $url;
    }

    public function add($data, $slug = null)
    {
        $sender = new Sender($this->slug, $this->url);
        try {
            $sender->add($data, $slug);
        }catch (\Exception $e){

        }
    }
}