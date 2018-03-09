<?php

namespace safaeean\Sitemap;

use safaeean\Sitemap\Tags\Tag;
use safaeean\Sitemap\Tags\Url;

class Sitemap
{
    /** @var array */
    protected $tags = [];

    /**
     * @return static
     */
    public static function create()
    {
        return new static();
    }

    /**
     * @param string|\safaeean\Sitemap\Tags\Tag $tag
     *
     * @return $this
     */
    public function add($tag)
    {
        if (is_string($tag)) {
            $tag = Url::create($tag);
        }

        $this->tags[] = $tag;

        return $this;
    }

    /**
     * @param string $url
     *
     * @return \safaeean\Sitemap\Tags\Url|null
     */
    public function getUrl(string $url)
    {
        return collect($this->tags)->first(function (Tag $tag) use ($url) {
            return $tag->getType() === 'url' && $tag->url === $url;
        });
    }

    public function hasUrl(string $url): bool
    {
        return (bool)$this->getUrl($url);
    }

    public function render($sort = false): string
    {
        if ($sort)
            sort($this->tags);

        $tags = $this->tags;

        return view('laravel-sitemap::sitemap')
            ->with(compact('tags'))
            ->render();
    }


    /**
     * @param string $path
     *
     * @return $this
     */
    public function writeToFile(string $path)
    {
        file_put_contents($path, $this->render());

        return $this;
    }
}
