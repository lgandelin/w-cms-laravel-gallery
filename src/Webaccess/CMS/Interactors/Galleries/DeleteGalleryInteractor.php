<?php

namespace Webaccess\CMS\Interactors\Galleries;

use CMS\Context;
use Webaccess\CMS\Interactors\GalleryItems\DeleteGalleryItemInteractor;
use Webaccess\CMS\Interactors\GalleryItems\GetGalleryItemsInteractor;

class DeleteGalleryInteractor extends GetGalleryInteractor
{
    public function run($galleryID)
    {
        if ($this->getGalleryByID($galleryID)) {
            $this->deleteGalleryItems($galleryID);
            Context::getRepository('gallery')->deleteGallery($galleryID);
        }
    }

    private function deleteGalleryItems($galleryID)
    {
        $galleryItems = (new GetGalleryItemsInteractor())->getAll($galleryID);

        foreach ($galleryItems as $galleryItem) {
            (new DeleteGalleryItemInteractor())->run($galleryItem->getID());
        }
    }
}
