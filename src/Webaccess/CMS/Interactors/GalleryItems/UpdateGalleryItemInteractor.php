<?php

namespace Webaccess\CMS\Interactors\GalleryItems;

use Webaccess\CMS\Structures\GalleryItemStructure;

class UpdateGalleryItemInteractor extends GetGalleryItemInteractor
{
    public function run($galleryItemID, GalleryItemStructure $galleryItemStructure)
    {
        if ($galleryItem = $this->getGalleryItemByID($galleryItemID)) {
            $properties = get_object_vars($galleryItemStructure);
            unset ($properties['ID']);
            foreach ($properties as $property => $value) {
                $method = ucfirst(str_replace('_', '', $property));
                $setter = 'set' . $method;

                if ($galleryItemStructure->$property !== null) {
                    call_user_func_array(array($galleryItem, $setter), array($value));
                }
            }

            $galleryItem->valid();

            $this->repository->updateGalleryItem($galleryItem);
        }
    }
}
