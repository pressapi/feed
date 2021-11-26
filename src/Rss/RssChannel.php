<?php

declare(strict_types=1);

namespace PressApi\Feed\Rss;

use DateTimeImmutable;

class RssChannel implements RssTag
{
    private string $title;
    private string $link;
    private string $description;
    private string $language;
    private string $copyright;
    private DateTimeImmutable $pubDate;
    private DateTimeImmutable $lastBuildDate;
    private int $ttl;
    private RssChannelItemList $items;

    public function __construct(
        string $title,
        string $link,
        string $description,
        string $language,
        string $copyright,
        DateTimeImmutable $pubDate,
        DateTimeImmutable $lastBuildDate,
        int $ttl,
        RssChannelItemList $items,
    ) {
        $this->title = $title;
        $this->link = $link;
        $this->description = $description;
        $this->language = $language;
        $this->copyright = $copyright;
        $this->pubDate = $pubDate;
        $this->lastBuildDate = $lastBuildDate;
        $this->ttl = $ttl;
        $this->items = $items;
    }

    public function __toString(): string
    {
        return <<<XML
        <channel>
          <title>{$this->title}</title>
          <link>{$this->link}</link>
          <description>{$this->description}</description>
          <language>{$this->language}</language>
          <copyright>{$this->copyright}</copyright>
          <pubDate>{$this->pubDate->format('r')}</pubDate>
          <lastBuildDate>{$this->lastBuildDate->format('r')}</lastBuildDate>
          <ttl>{$this->ttl}</ttl>
          {$this->items->__toString()}
        </channel>
        XML;
    }
}