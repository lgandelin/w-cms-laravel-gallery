<?php

namespace Webaccess\CMS\Interactors\GalleryItems;

use CMS\Context;
use CMS\DataStructure;
use Webaccess\CMS\Entities\GalleryItem;

class CreateGalleryItemInteractor
{
    public function run(DataStructure $galleryItemStructure)
    {
        $galleryItem = new GalleryItem();
        $galleryItem->setInfos($galleryItemStructure);
        $galleryItem->valid();

        return Context::get('gallery_item')->createGalleryItem($galleryItem);
    }
}
