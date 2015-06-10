<?php

namespace Webaccess\CMS\Interactors\GalleryItems;

use CMS\Context;
use Webaccess\CMS\Structures\GalleryItemStructure;

class GetGalleryItemInteractor
{
    public function getGalleryItemByID($galleryItemID, $structure = false)
    {
        if (!$gallery = Context::getRepository('gallery_item')->findByID($galleryItemID)) {
            throw new \Exception('The gallery item was not found');
        }

        return ($structure) ? GalleryItemStructure::toStructure($gallery) : $gallery;
    }
}
