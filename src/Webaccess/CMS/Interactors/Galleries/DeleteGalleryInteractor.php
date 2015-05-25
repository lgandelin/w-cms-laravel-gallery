<?php

namespace Webaccess\CMS\Interactors\Galleries;

use Webaccess\CMS\Interactors\GalleryItems\DeleteGalleryItemInteractor;
use Webaccess\CMS\Interactors\GalleryItems\GetGalleryItemsInteractor;
use Webaccess\CMS\Repositories\GalleryRepositoryInterface;

class DeleteGalleryInteractor extends GetGalleryInteractor
{
    protected $repository;
    private $getGalleryItemsInteractor;
    private $deleteGalleryItemInteractor;

    public function __construct(
        GalleryRepositoryInterface $repository,
        GetGalleryItemsInteractor $getGalleryItemsInteractor,
        DeleteGalleryItemInteractor $deleteGalleryItemInteractor
    ) {
        $this->repository = $repository;
        $this->getGalleryItemsInteractor = $getGalleryItemsInteractor;
        $this->deleteGalleryItemInteractor = $deleteGalleryItemInteractor;
    }

    public function run($galleryID)
    {
        if ($this->getGalleryByID($galleryID)) {
            $this->deleteGalleryItems($galleryID);
            $this->repository->deleteGallery($galleryID);
        }
    }

    private function deleteGalleryItems($galleryID)
    {
        $galleryItems = $this->getGalleryItemsInteractor->getAll($galleryID);

        foreach ($galleryItems as $galleryItem) {
            $this->deleteGalleryItemInteractor->run($galleryItem->getID());
        }
    }
}
