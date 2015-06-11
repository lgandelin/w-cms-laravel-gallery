<?php

namespace Webaccess\CMS\Interactors\GalleryItems;

use CMS\Context;
use Webaccess\CMS\Entities\GalleryItem;
use Webaccess\CMS\Structures\GalleryItemStructure;

class CreateGalleryItemInteractor
{
    public function run(GalleryItemStructure $galleryItemStructure)
    {
        $galleryItem = $this->createFromGalleryItemStructure($galleryItemStructure);

        $galleryItem->valid();

        return Context::getRepository('gallery_item')->createGalleryItem($galleryItem);
    }

    private function createFromGalleryItemStructure($galleryItemStructure)
    {
        $galleryItem = new GalleryItem();
        if ($galleryItemStructure->title !== null) {
            $galleryItem->setTitle($galleryItemStructure->title);
        }
        if ($galleryItemStructure->text !== null) {
            $galleryItem->setText($galleryItemStructure->text);
        }
        if ($galleryItemStructure->order !== null) {
            $galleryItem->setOrder($galleryItemStructure->order);
        }
        if ($galleryItemStructure->link !== null) {
            $galleryItem->setLink($galleryItemStructure->link);
        }
        if ($galleryItemStructure->class !== null) {
            $galleryItem->setClass($galleryItemStructure->class);
        }
        if ($galleryItemStructure->media_id !== null) {
            $galleryItem->setMediaID($galleryItemStructure->media_id);
        }
        if ($galleryItemStructure->gallery_id !== null) {
            $galleryItem->setGalleryID($galleryItemStructure->gallery_id);
        }
        if ($galleryItemStructure->display !== null) {
            $galleryItem->setDisplay($galleryItemStructure->display);
        }

        return $galleryItem;
    }
}
