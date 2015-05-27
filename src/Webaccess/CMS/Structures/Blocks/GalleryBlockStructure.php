<?php

namespace Webaccess\CMS\Structures\Blocks;

use CMS\Structures\BlockStructure;
use Webaccess\CMS\Entities\Blocks\GalleryBlock;

class GalleryBlockStructure extends BlockStructure
{
    public $gallery_id;

    public function getBlock()
    {
        return new GalleryBlock();
    }
}