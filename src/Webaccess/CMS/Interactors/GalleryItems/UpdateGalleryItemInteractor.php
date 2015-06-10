<?php

namespace Webaccess\CMS\Interactors\GalleryItems;

use CMS\Context;
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

            Context::getRepository('gallery_item')->updateGalleryItem($galleryItem);
        }
    }
}
