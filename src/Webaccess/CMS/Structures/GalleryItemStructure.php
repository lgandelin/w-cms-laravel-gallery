<?php

namespace Webaccess\CMS\Structures;

class GalleryItemStructure extends DataStructure
{
    public $ID;
    public $title;
    public $text;
    public $link;
    public $order;
    public $class;
    public $gallery_id;
    public $media_id;
    public $display;

    public static function toStructure($galleryItem)
    {
        $galleryItemStructure = new GalleryItemStructure();
        $galleryItemStructure->ID = $galleryItem->getID();
        $galleryItemStructure->title = $galleryItem->getTitle();
        $galleryItemStructure->text = $galleryItem->getText();
        $galleryItemStructure->link = $galleryItem->getLink();
        $galleryItemStructure->order = $galleryItem->getOrder();
        $galleryItemStructure->gallery_id = $galleryItem->getGalleryID();
        $galleryItemStructure->media_id = $galleryItem->getMediaID();
        $galleryItemStructure->class = $galleryItem->getClass();
        $galleryItemStructure->display = $galleryItem->getDisplay();

        return $galleryItemStructure;
    }
}
