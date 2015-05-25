<?php

namespace Webaccess\CMS\Interactors\GalleryItems;

class DeleteGalleryItemInteractor extends GetGalleryItemInteractor
{
    public function run($galleryItemID)
    {
        if ($this->getGalleryItemByID($galleryItemID)) {
            $this->repository->deleteGalleryItem($galleryItemID);
        }
    }
}
