<?php

namespace Webaccess\CMS\Structures;

class GalleryStructure extends DataStructure
{
    public $ID;
    public $identifier;
    public $name;
    public $lang_id;

    public static function toStructure($gallery)
    {
        $galleryStructure = new GalleryStructure();
        $galleryStructure->ID = $gallery->getID();
        $galleryStructure->identifier = $gallery->getIdentifier();
        $galleryStructure->name = $gallery->getName();
        $galleryStructure->lang_id = $gallery->getLangID();

        return $galleryStructure;
    }
}
