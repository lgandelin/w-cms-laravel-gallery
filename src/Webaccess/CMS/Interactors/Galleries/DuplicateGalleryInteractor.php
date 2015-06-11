<?php

namespace Webaccess\CMS\Interactors\Galleries;

use Webaccess\CMS\Interactors\GalleryItems\CreateGalleryItemInteractor;
use Webaccess\CMS\Interactors\GalleryItems\GetGalleryItemsInteractor;
use Webaccess\CMS\Structures\GalleryItemStructure;
use Webaccess\CMS\Structures\GalleryStructure;

class DuplicateGalleryInteractor extends GetGalleryInteractor
{
    public function run($galleryID)
    {
        if ($gallery = $this->getGalleryByID($galleryID)) {
            $newGalleryID = $this->duplicateGallery($gallery);

            $galleryItems = (new GetGalleryItemsInteractor())->getAll($galleryID);
            foreach ($galleryItems as $galleryItem) {
                $this->duplicateGalleryItem($galleryItem, $newGalleryID);
            }
        }
    }

    private function duplicateGallery($gallery)
    {
        $galleryDuplicated = clone $gallery;
        $galleryDuplicated->setID(null);
        $galleryDuplicated->setName($gallery->getName() . ' - COPY');
        $galleryDuplicated->setIdentifier($gallery->getIdentifier() . '-copy');
        $galleryDuplicated->setMediaFormatID($gallery->getMediaFormatID());
        $galleryDuplicated->setLangID($gallery->getLangID());

        return (new CreateGalleryInteractor())->run(GalleryStructure::toStructure($galleryDuplicated));
    }

    private function duplicateGalleryItem($galleryItem, $newGalleryID)
    {
        $galleryItemStructure = GalleryItemStructure::toStructure($galleryItem);
        $galleryItemStructure->ID = null;
        $galleryItemStructure->gallery_id = $newGalleryID;

        (new CreateGalleryItemInteractor())->run($galleryItemStructure);
    }
}
