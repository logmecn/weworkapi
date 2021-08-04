<?php

namespace WeWorkApi\DataStructure\Message;

use WeWorkApi\Utils\Utils;



class MpNewsArticle {
    public $title = null; // string
    public $thumb_media_id = null; // string
    public $author = null; // string
    public $content_source_url = null; // string
    public $content = null; // string
    public $digest = null; // string

    public function __construct(
        $title=null,
        $thumb_media_id=null,
        $author=null,
        $content_source_url=null,
        $content=null,
        $digest=null)
    {
        $this->title = $title;
        $this->thumb_media_id = $thumb_media_id;
        $this->author = $author;
        $this->content_source_url = $content_source_url;
        $this->content = $content;
        $this->digest = $digest;
    }

    public function CheckMessageSendArgs()
    {
        Utils::checkNotEmptyStr($this->title, "title");
        Utils::checkNotEmptyStr($this->thumb_media_id, "thumb_media_id");
        Utils::checkNotEmptyStr($this->content, "content");
    }

    public function Article2Array()
    {
        $args = array();

        Utils::setIfNotNull($this->title, "title", $args);
        Utils::setIfNotNull($this->thumb_media_id , "thumb_media_id", $args);
        Utils::setIfNotNull($this->author, "author", $args);
        Utils::setIfNotNull($this->content_source_url, "content_source_url", $args);
        Utils::setIfNotNull($this->content, "content", $args);
        Utils::setIfNotNull($this->digest, "digest", $args);

        return $args;
    }
}