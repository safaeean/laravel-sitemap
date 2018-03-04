<?php

namespace safaeean\Sitemap\Crawler;

use safaeean\Crawler\Url;
use safaeean\Crawler\CrawlProfile;

class Profile implements CrawlProfile
{
    /** @var callable */
    protected $profile;

    public function __construct(callable $profile)
    {
        $this->profile = $profile;
    }

    /*
     * Determine if the given url should be crawled.
     */
    public function shouldCrawl(Url $url): bool
    {
        return ($this->profile)($url);
    }
}
