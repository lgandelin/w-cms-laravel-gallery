<?php

namespace Webaccess\CMS\Interactors\Galleries;

use CMS\Context;

class UpdateGalleryInteractor extends GetGalleryInteractor
{
    public function run($galleryID, $galleryStructure)
    {
        if ($gallery = $this->getGalleryByID($galleryID)) {
            $properties = get_object_vars($galleryStructure);
            unset ($properties['ID']);
            foreach ($properties as $property => $value) {
                $method = ucfirst(str_replace('_', '', $property));
                $setter = 'set' . $method;

                if ($galleryStructure->$property !== null) {
                    call_user_func_array(array($gallery, $setter), array($value));
                }
            }

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
