<?php

namespace Webaccess\CMS\Interactors\Galleries;

use CMS\Context;

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
                $galleryStructures[] = $gallery->toStructure();
            }
        }

        return $galleryStructures;
    }
}
