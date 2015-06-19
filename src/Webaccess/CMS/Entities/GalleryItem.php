<?php

namespace Webaccess\CMS\Entities;

use CMS\Entities\Entity;

class GalleryItem extends Entity
{
    private $ID;
    private $title;
    private $text;
    private $link;
    private $order;
    private $class;
    private $display;
    private $mediaID;
    private $galleryID;

    public function setID($ID)
    {
        $this->ID = $ID;
    }

    public function getID()
    {
        return $this->ID;
    }

    public function setTitle($title)
    {
        $this->title = $title;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function setText($text)
    {
        $this->text = $text;
    }

    public function getText()
    {
        return $this->text;
    }

    public function setLink($link)
    {
        $this->link = $link;
    }

    public function getLink()
    {
        return $this->link;
    }

    public function setOrder($order)
    {
        $this->order = $order;
    }

    public function getOrder()
    {
        return $this->order;
    }

    public function setMediaID($mediaID)
    {
        $this->mediaID = $mediaID;
    }

    public function getMediaID()
    {
        return $this->mediaID;
    }

    public function setGalleryID($galleryID)
    {
        $this->galleryID = $galleryID;
    }

    public function getGalleryID()
    {
        return $this->galleryID;
    }

    public function setClass($class)
    {
        $this->class = $class;
    }

    public function getClass()
    {
        return $this->class;
    }

    public function setDisplay($display)
    {
        $this->display = $display;
    }

    public function getDisplay()
    {
        return $this->display;
    }

    public function valid()
    {
        if (!is_int($this->getOrder())) {
            throw new \InvalidArgumentException('You must provide an integer for the gallery item order');
        }

        return true;
    }
}
