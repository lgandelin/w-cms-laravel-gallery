<?php

namespace Webaccess\CMS\Interactors\Galleries;

use Webaccess\CMS\Entities\Gallery;
use Webaccess\CMS\Repositories\GalleryRepositoryInterface;
use Webaccess\CMS\Structures\GalleryStructure;

class CreateGalleryInteractor
{
    private $repository;

    public function __construct(GalleryRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function run(GalleryStructure $galleryStructure)
    {
        $gallery = $this->createGalleryFromStructure($galleryStructure);

        $gallery->valid();

        if ($this->anotherExistingGalleryWithSameIdentifier($gallery->getIdentifier())) {
            throw new \Exception('There is already a gallery with the same identifier');
        }

        return $this->repository->createGallery($gallery);
    }

    private function anotherExistingGalleryWithSameIdentifier($identifier)
    {
        return $this->repository->findByIdentifier($identifier);
    }

    private function createGalleryFromStructure(GalleryStructure $galleryStructure)
    {
        $gallery = new Gallery();
        $gallery->setIdentifier($galleryStructure->identifier);
        $gallery->setName($galleryStructure->name);
        $gallery->setLangID($galleryStructure->lang_id);

        return $gallery;
    }
}
