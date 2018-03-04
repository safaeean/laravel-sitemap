<?php

namespace safaeean\Sitemap;

use safaeean\Sitemap\Tags\Tag;
use safaeean\Sitemap\Tags\Sitemap;

class SitemapIndex
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
            $tag = Sitemap::create($tag);
        }

        $this->tags[] = $tag;

        return $this;
    }

    /**
     * Get sitemap tag.
     *
     * @param string $url
     *
     * @return \safaeean\Sitemap\Tags\Sitemap|null
     */
    public function getSitemap(string $url)
    {
        return collect($this->tags)->first(function (Tag $tag) use ($url) {
            return $tag->getType() === 'sitemap' && $tag->url === $url;
        });
    }

    /**
     * Check if there is the provided sitemap in the index.
     *
     * @param string $url
     *
     * @return bool
     */
    public function hasSitemap(string $url): bool
    {
        return (bool) $this->getSitemap($url);
    }

    /**
     * Get the inflated template content.
     *
     * @return string
     */
    public function render(): string
    {
        $tags = $this->tags;

        return view('laravel-sitemap::sitemapIndex/index')
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
