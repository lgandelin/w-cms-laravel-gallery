<?php

namespace Webaccess\CMS\Entities\Blocks;

use CMS\Entities\Block;
use CMS\Entities\Blocks\GalleryBlock as GalleryBlockEntity;
use Webaccess\CMS\Interactors\Galleries\GetGalleryInteractor;
use Webaccess\CMS\Interactors\GalleryItems\GetGalleryItemsInteractor;

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

    public function getContentData()
    {
        if ($this->getGalleryID()) {
            $content = (new GetGalleryInteractor())->getGalleryByID($this->getGalleryID(), true);
            $content->items = (new GetGalleryItemsInteractor())->getAll($this->getGalleryID(), true);

            return $content;
        }

        return null;
    }
}
