<?php

namespace Webaccess\CMS\Interactors\GalleryItems;

use CMS\Context;

class DeleteGalleryItemInteractor extends GetGalleryItemInteractor
{
    public function run($galleryItemID)
    {
        if ($this->getGalleryItemByID($galleryItemID)) {
            Context::getRepository('gallery_item')->deleteGalleryItem($galleryItemID);
        }
    }
}
