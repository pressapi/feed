<?php

declare(strict_types=1);

namespace Test\PressApi\Feed\Unit\Atom;

use DateTimeImmutable;
use PHPUnit\Framework\TestCase;
use PressApi\Feed\Atom\Atom;
use PressApi\Feed\Atom\AtomChannel;
use PressApi\Feed\Atom\AtomChannelItem;
use PressApi\Feed\Atom\AtomChannelItemCategory;
use PressApi\Feed\Atom\AtomXmlns;
use PressApi\Feed\RssTagList;

class AtomFullRssTest extends TestCase
{
    private const RSS_XML = <<<XML
<?xml version="1.0" encoding="UTF-8"?>
<rss xmlns:content="http://purl.org/rss/1.0/modules/content/" xmlns:atom="http://www.w3.org/2005/Atom" version="2.0">
  <channel>
    <title>My Channel</title>
    <link>https://my-website/my-channel</link>
    <description>My Channel Description</description>
    <language>en-US</language>
    <copyright>PressApi</copyright>
    <pubDate>Fri, 26 Nov 2021 10:15:16 +0000</pubDate>
    <lastBuildDate>Fri, 26 Nov 2021 10:20:30 +0000</lastBuildDate>
    <ttl>60</ttl>
    <item>
      <title><![CDATA[Item 1 Title]]></title>
      <link>http://my-website/my-channel/item-1.html</link>
      <description><![CDATA[Item 1 Description]]></description>
      <content:encoded><![CDATA[Item 1 Content]]></content:encoded>
      <guid>item-1.html</guid>
      <pubDate>Fri, 26 Nov 2021 10:15:16 +0000</pubDate>
      <author>Arthur Dent</author>
      <category><![CDATA[Foo]]></category>
      <category><![CDATA[Bar]]></category>
    </item>
    <item>
      <title><![CDATA[Item 2 Title]]></title>
      <link>http://my-website/my-channel/item-2.html</link>
      <description><![CDATA[Item 2 Description]]></description>
      <content:encoded><![CDATA[Item 2 Content]]></content:encoded>
      <guid>item-2.html</guid>
      <pubDate>Fri, 26 Nov 2021 10:15:16 +0000</pubDate>
      <author>John Travolta</author>
      <category><![CDATA[Biz]]></category>
      <category><![CDATA[Baz]]></category>
    </item>
  </channel>
</rss>
XML;

    public function testRenderFullRss(): void
    {
        $rss = new Atom(
            xmlns: new AtomXmlns(),
            channel: new AtomChannel(
                title: 'My Channel',
                link: 'https://my-website/my-channel',
                description: 'My Channel Description',
                language: 'en-US',
                copyright: 'PressApi',
                pubDate: new DateTimeImmutable('2021-11-26 10:15:16 UTC'),
                lastBuildDate: new DateTimeImmutable('2021-11-26 10:20:30 UTC'),
                ttl: 60,
                items: new RssTagList([
                    new AtomChannelItem(
                        title: 'Item 1 Title',
                        link: 'http://my-website/my-channel/item-1.html',
                        description: 'Item 1 Description',
                        content: 'Item 1 Content',
                        guid: 'item-1.html',
                        pubDate: new DateTimeImmutable('2021-11-26 10:15:16 UTC'),
                        author: 'Arthur Dent',
                        categories: new RssTagList([
                            new AtomChannelItemCategory('Foo'),
                            new AtomChannelItemCategory('Bar'),
                        ]),
                    ),
                    new AtomChannelItem(
                        title: 'Item 2 Title',
                        link: 'http://my-website/my-channel/item-2.html',
                        description: 'Item 2 Description',
                        content: 'Item 2 Content',
                        guid: 'item-2.html',
                        pubDate: new DateTimeImmutable('2021-11-26 10:15:16 UTC'),
                        author: 'John Travolta',
                        categories: new RssTagList([
                            new AtomChannelItemCategory('Biz'),
                            new AtomChannelItemCategory('Baz'),
                        ]),
                    ),
                ]),
            ),
        );

        $this->assertXmlStringEqualsXmlString(self::RSS_XML, "{$rss}");
    }
}
