<?php

namespace Webaccess\CMS\Interactors\Galleries;

use CMS\Context;
use CMS\DataStructure;
use Webaccess\CMS\Entities\Gallery;

class CreateGalleryInteractor
{
    public function run(DataStructure $galleryStructure)
    {
        $gallery = new Gallery();
        $gallery->setInfos($galleryStructure);
        $gallery->valid();

        if ($this->anotherExistingGalleryWithSameIdentifier($gallery->getIdentifier())) {
            throw new \Exception('There is already a gallery with the same identifier');
        }

        return Context::getRepository('gallery')->createGallery($gallery);
    }

    private function anotherExistingGalleryWithSameIdentifier($identifier)
    {
        return Context::getRepository('gallery')->findByIdentifier($identifier);
    }
}
