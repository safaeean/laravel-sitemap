<?= '<'.'?'.'xml version="1.0" encoding="UTF-8"?>' ?>
<?= '<'.'?xml-stylesheet type="text/xsl" href="/css/main-sitemap.xsl"'."?>" ?>
<sitemapindex xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
@foreach($tags as $tag)
    @include('laravel-sitemap::sitemapIndex/' . $tag->getType())
@endforeach
</sitemapindex>
