<?php

namespace Webaccess\CMS\Interactors\Galleries;

use CMS\Context;
use Webaccess\CMS\Entities\Gallery;
use CMS\Structures\DataStructure;

class CreateGalleryInteractor
{
    public function run(DataStructure $galleryStructure)
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

    private function createGalleryFromStructure(DataStructure $galleryStructure)
    {
        $gallery = new Gallery();
        $gallery->setIdentifier($galleryStructure->identifier);
        $gallery->setName($galleryStructure->name);
        $gallery->setLangID($galleryStructure->lang_id);
        $gallery->setMediaFormatID($galleryStructure->media_format_id);

        return $gallery;
    }
}
