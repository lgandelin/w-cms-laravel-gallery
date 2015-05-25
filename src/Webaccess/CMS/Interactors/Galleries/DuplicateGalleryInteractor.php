<?php

namespace CMS\Interactors\Galleries;

use Webaccess\CMS\Interactors\GalleryItems\CreateGalleryItemInteractor;
use Webaccess\CMS\Interactors\GalleryItems\GetGalleryItemsInteractor;
use Webaccess\CMS\Repositories\GalleryRepositoryInterface;
use Webaccess\CMS\Structures\GalleryItemStructure;
use Webaccess\CMS\Structures\GalleryStructure;

class DuplicateGalleryInteractor extends GetGalleryInteractor
{
    public function __construct(
        GalleryRepositoryInterface $repository,
        CreateGalleryInteractor $createGalleryInteractor,
        GetGalleryItemsInteractor $getGalleryItemsInteractor,
        CreateGalleryItemInteractor $createGalleryItemInteractor
    ) {
        parent::__construct($repository);

        $this->createGalleryInteractor = $createGalleryInteractor;
        $this->getGalleryItemsInteractor = $getGalleryItemsInteractor;
        $this->createGalleryItemInteractor = $createGalleryItemInteractor;
    }

    public function run($galleryID)
    {
        if ($gallery = $this->getGalleryByID($galleryID)) {
            $newGalleryID = $this->duplicateGallery($gallery);

            $galleryItems = $this->getGalleryItemsInteractor->getAll($galleryID);
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
        $galleryDuplicated->setLangID($gallery->getLangID());

        return $this->createGalleryInteractor->run(GalleryStructure::toStructure($galleryDuplicated));
    }

    private function duplicateGalleryItem($galleryItem, $newGalleryID)
    {
        $galleryItemStructure = GalleryItemStructure::toStructure($galleryItem);
        $galleryItemStructure->ID = null;
        $galleryItemStructure->gallery_id = $newGalleryID;

        $this->createGalleryItemInteractor->run($galleryItemStructure);
    }
}
