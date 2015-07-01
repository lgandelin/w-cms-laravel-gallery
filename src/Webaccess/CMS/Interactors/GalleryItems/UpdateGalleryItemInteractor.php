<?php

namespace Webaccess\CMS\Interactors\GalleryItems;

use CMS\Context;
use CMS\DataStructure;

class UpdateGalleryItemInteractor extends GetGalleryItemInteractor
{
    public function run($galleryItemID, DataStructure $galleryItemStructure)
    {
        if ($galleryItem = $this->getGalleryItemByID($galleryItemID)) {
            $galleryItem->setInfos($galleryItemStructure);
            $galleryItem->valid();

            Context::get('gallery_item')->updateGalleryItem($galleryItem);
        }
    }
}
