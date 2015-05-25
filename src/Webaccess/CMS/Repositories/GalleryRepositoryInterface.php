<?php

namespace Webaccess\CMS\Repositories;

use Webaccess\CMS\Entities\Gallery;

interface GalleryRepositoryInterface
{
    public function findByID($galleryID);

    public function findByIdentifier($galleryIdentifier);

    public function findAll($langID = null);

    public function createGallery(Gallery $gallery);

    public function updateGallery(Gallery $gallery);

    public function deleteGallery($galleryID);
}
