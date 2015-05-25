<?php

namespace Webaccess\CMS\Interactors\Galleries;

use Webaccess\CMS\Repositories\GalleryRepositoryInterface;
use Webaccess\CMS\Structures\GalleryStructure;

class GetGalleryInteractor
{
    protected $repository;

    public function __construct(GalleryRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function getGalleryByID($galleryID, $structure = false)
    {
        if (!$gallery = $this->repository->findByID($galleryID)) {
            throw new \Exception('The gallery was not found');
        }

        return ($structure) ? GalleryStructure::toStructure($gallery) : $gallery;
    }
}
