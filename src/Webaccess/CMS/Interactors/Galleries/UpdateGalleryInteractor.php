<?php

namespace CMS\Interactors\Galleries;

class UpdateGalleryInteractor extends GetGalleryInteractor
{
    public function run($galleryID, $galleryStructure)
    {
        if ($gallery = $this->getGalleryByID($galleryID)) {
            if (
                isset($galleryStructure->name) &&
                $galleryStructure->name !== null &&
                $gallery->getName() != $galleryStructure->name
            ) {
                $gallery->setName($galleryStructure->name);
            }
            if (
                isset($galleryStructure->identifier) &&
                $galleryStructure->identifier !== null &&
                $gallery->getIdentifier() != $galleryStructure->identifier
            ) {
                $gallery->setIdentifier($galleryStructure->identifier);
            }

            $gallery->valid();

            if ($this->anotherGalleryExistsWithSameIdentifier($galleryID, $gallery->getIdentifier())) {
                throw new \Exception('There is already a gallery with the same identifier');
            }

            $this->repository->updateGallery($gallery);
        }
    }

    private function anotherGalleryExistsWithSameIdentifier($galleryID, $galleryIdentifier)
    {
        $existingGallery = $this->repository->findByIdentifier($galleryIdentifier);

        return ($existingGallery && $existingGallery->getID() != $galleryID);
    }
}
