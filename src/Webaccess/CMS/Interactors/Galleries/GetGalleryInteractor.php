<?php

namespace Webaccess\CMS\Interactors\Galleries;

use CMS\Context;

class GetGalleryInteractor
{
    public function getGalleryByID($galleryID, $structure = false)
    {
        if (!$gallery = Context::getRepository('gallery')->findByID($galleryID)) {
            throw new \Exception('The gallery was not found');
        }

        return ($structure) ? $gallery->toStructure() : $gallery;
    }
}
