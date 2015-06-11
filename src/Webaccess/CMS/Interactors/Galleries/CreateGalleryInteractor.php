<?php

namespace Webaccess\CMS\Interactors\Galleries;

use CMS\Context;
use Webaccess\CMS\Entities\Gallery;
use Webaccess\CMS\Structures\GalleryStructure;

class CreateGalleryInteractor
{
    public function run(GalleryStructure $galleryStructure)
    {
        $gallery = $this->createGalleryFromStructure($galleryStructure);

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

    private function createGalleryFromStructure(GalleryStructure $galleryStructure)
    {
        $gallery = new Gallery();
        $gallery->setIdentifier($galleryStructure->identifier);
        $gallery->setName($galleryStructure->name);
        $gallery->setLangID($galleryStructure->lang_id);
        $gallery->setMediaFormatID($galleryStructure->media_format_id);

        return $gallery;
    }
}
