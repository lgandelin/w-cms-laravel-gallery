<?php

namespace Webaccess\CMS\Entities\Blocks;

use CMS\Entities\Block;
use CMS\Entities\Blocks\GalleryBlock as GalleryBlockEntity;
use CMS\Structures\BlockStructure;
use Webaccess\CMS\Structures\Blocks\GalleryBlockStructure;

class GalleryBlock extends Block
{
    private $galleryID;

    public function setGalleryID($galleryID)
    {
        $this->galleryID = $galleryID;
    }

    public function getGalleryID()
    {
        return $this->galleryID;
    }

    public function getStructure()
    {
        $blockStructure = new GalleryBlockStructure();
        $blockStructure->gallery_id = $this->getGalleryID();

        return $blockStructure;
    }

    public function getBlockable() {
        return \Webaccess\WCMSLaravelGallery\Models\GalleryBlock::create([
            'gallery_id' => $this->getID()
        ]);
    }

    public function updateContent(BlockStructure $blockStructure)
    {
        if ($blockStructure->gallery_id !== null && $blockStructure->gallery_id != $this->getGalleryID()) {
            $this->setGalleryID($blockStructure->gallery_id);
        }
    }
}
