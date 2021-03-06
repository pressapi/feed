<?php

declare(strict_types=1);

namespace Test\PressApi\Feed\Unit\Rss;

use DateTimeImmutable;
use PHPUnit\Framework\TestCase;
use PressApi\Feed\Rss\RssItem;
use PressApi\Feed\RssCategory;
use PressApi\Feed\RssTagList;

class RssItemTest extends TestCase
{
    public function testRenderRssItem(): void
    {
        $rssItem = new RssItem(
            enclosure: 'https://my-webiste/my-article/image.jpg',
            title: 'Foo Bar',
            description: 'Foo Bar Description',
            content: 'Foo Bar Content',
            pubDate: new DateTimeImmutable('2021-11-26 15:20:25 UTC'),
            author: 'Arthur Dent',
            link: 'https://my-webiste/my-article.html',
            categories: new RssTagList([new RssCategory('Foo')]),
        );

        $this->assertEquals(
            <<<XML
            <item>
              <enclosure url="https://my-webiste/my-article/image.jpg" type="image/jpeg"/>
              <title>Foo Bar</title>
              <description>Foo Bar Description</description>
              <content><![CDATA[Foo Bar Content]]></content>
              <pubDate>2021-11-26 15:20:25</pubDate>
              <author>Arthur Dent</author>
              <link>https://my-webiste/my-article.html</link>
              <category><![CDATA[Foo]]></category>
            </item>
            XML,
            $rssItem->__toString(),
        );
    }
}
