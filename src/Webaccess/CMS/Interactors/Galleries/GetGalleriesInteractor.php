<?php

namespace Webaccess\CMS\Interactors\Galleries;

use Webaccess\CMS\Repositories\GalleryRepositoryInterface;
use Webaccess\CMS\Structures\GalleryStructure;

class GetGalleriesInteractor
{
    private $repository;

    public function __construct(GalleryRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }
    
    public function getAll($langID = null, $structure = false)
    {
        $galleries = $this->repository->findAll($langID);

        return ($structure) ? $this->getGalleryStructures($galleries) : $galleries;
    }

    private function getGalleryStructures($galleries)
    {
        $galleryStructures = [];
        if (is_array($galleries) && sizeof($galleries) > 0) {
            foreach ($galleries as $gallery) {
                $galleryStructures[] = GalleryStructure::toStructure($gallery);
            }
        }

        return $galleryStructures;
    }
}
