<?php

namespace Webaccess\CMS\Structures;

use CMS\Structures\DataStructure;

class GalleryStructure extends DataStructure
{
    public $ID;
    public $identifier;
    public $name;
    public $media_format_id;
    public $lang_id;

    public static function toStructure($gallery)
    {
        $galleryStructure = new GalleryStructure();
        $galleryStructure->ID = $gallery->getID();
        $galleryStructure->identifier = $gallery->getIdentifier();
        $galleryStructure->name = $gallery->getName();
        $galleryStructure->media_format_id = $gallery->getMediaFormatID();
        $galleryStructure->lang_id = $gallery->getLangID();

        return $galleryStructure;
    }
}
