<?php

namespace Webaccess\CMS\Repositories;

use Webaccess\CMS\Entities\GalleryItem;

interface GalleryItemRepositoryInterface
{
    public function findByID($galleryItemID);

    public function findByGalleryID($galleryID);

    public function createGalleryItem(GalleryItem $galleryItem);

    public function updateGalleryItem(GalleryItem $galleryItem);

    public function deleteGalleryItem($galleryItemID);
}
