<?php

namespace Webaccess\CMS\Interactors\Galleries;

use CMS\Context;
use CMS\DataStructure;

class UpdateGalleryInteractor extends GetGalleryInteractor
{
    public function run($galleryID, DataStructure $galleryStructure)
    {
        if ($gallery = $this->getGalleryByID($galleryID)) {
            $gallery->setInfos($galleryStructure);
            $gallery->valid();

            if ($this->anotherGalleryExistsWithSameIdentifier($galleryID, $gallery->getIdentifier())) {
                throw new \Exception('There is already a gallery with the same identifier');
            }

            Context::getRepository('gallery')->updateGallery($gallery);
        }
    }

    private function anotherGalleryExistsWithSameIdentifier($galleryID, $galleryIdentifier)
    {
        $existingGallery = Context::getRepository('gallery')->findByIdentifier($galleryIdentifier);

        return ($existingGallery && $existingGallery->getID() != $galleryID);
    }
}
