<url>
    @if (! empty($tag->url))
    <loc>{{ $tag->url }}</loc>
    @endif

    @if (count($tag->alternates))
    @foreach ($tag->alternates as $alternate)
    <xhtml:link rel="alternate" hreflang="{{ $alternate->locale }}" href="{{ $alternate->url }}" />
    @endforeach
    @endif

    @if (! empty($tag->lastModificationDate))
    <lastmod>{{ $tag->lastModificationDate->format(DateTime::ATOM) }}</lastmod>
    @endif

    @if (! empty($tag->changeFrequency))
    <changefreq>{{ $tag->changeFrequency }}</changefreq>
    @endif

    @if (! empty($tag->priority))
    <priority>{{ $tag->priority }}</priority>
    @endif


    @if (is_array($tag->images) && count($tag->images))
        @foreach($tag->images as $image)
            @if(@$image['name'])
                <image:image>
                    <image:loc>{{ $image['name'] }}</image:loc>
                    @if(@$image['title'])<image:caption><![CDATA[{{ $image['title'] }}]]></image:caption>@endif

                </image:image>
            @endif
        @endforeach
    @endif
</url>
