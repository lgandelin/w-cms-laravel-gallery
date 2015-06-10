<?php

namespace Webaccess\CMS\Interactors\GalleryItems;

use CMS\Context;
use Webaccess\CMS\Structures\GalleryItemStructure;

class GetGalleryItemsInteractor
{
    public function getAll($galleryID, $structure = false)
    {
        $galleryItems = Context::getRepository('gallery_item')->findByGalleryID($galleryID);

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
