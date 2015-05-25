<?php

namespace Webaccess\CMS\Interactors\GalleryItems;

use Webaccess\CMS\Repositories\GalleryItemRepositoryInterface;
use Webaccess\CMS\Structures\GalleryItemStructure;

class GetGalleryItemsInteractor
{
    private $repository;

    public function __construct(GalleryItemRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function getAll($galleryID, $structure = false)
    {
        $galleryItems = $this->repository->findByGalleryID($galleryID);

        return ($structure) ? $this->getGalleryItemStructures($galleryItems) : $galleryItems;
    }

    private function getGalleryItemStructures($galleryItems)
    {
        $galleryItemStructures = [];
        if (is_array($galleryItems) && sizeof($galleryItems) > 0) {
            foreach ($galleryItems as $galleryItem) {
                $galleryItemStructures[] = GalleryItemStructure::toStructure($galleryItem);
            }
        }

        return $galleryItemStructures;
    }
}
