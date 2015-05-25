<?php

namespace Webaccess\CMS\Interactors\GalleryItems;

use Webaccess\CMS\Repositories\GalleryItemRepositoryInterface;
use Webaccess\CMS\Structures\GalleryItemStructure;

class GetGalleryItemInteractor
{
    protected $repository;

    public function __construct(GalleryItemRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function getGalleryItemByID($galleryItemID, $structure = false)
    {
        if (!$gallery = $this->repository->findByID($galleryItemID)) {
            throw new \Exception('The gallery item was not found');
        }

        return ($structure) ? GalleryItemStructure::toStructure($gallery) : $gallery;
    }
}
