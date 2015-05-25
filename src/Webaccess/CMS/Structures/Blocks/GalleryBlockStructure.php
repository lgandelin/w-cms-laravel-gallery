<?php

namespace Webaccess\CMS\Structures\Blocks;

use Webaccess\CMS\Entities\Blocks\GalleryBlock;
use Webaccess\CMS\Structures\BlockStructure;

class GalleryBlockStructure extends BlockStructure
{
    public $gallery_id;

    public function getBlock()
    {
        return new GalleryBlock();
    }
}