<?php

namespace Webaccess\CMS\Interactors\Galleries;

use CMS\Context;
use Webaccess\CMS\Structures\GalleryStructure;

class GetGalleriesInteractor
{
    public function getAll($langID = null, $structure = false)
    {
        $galleries = Context::getRepository('gallery')->findAll($langID);

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
