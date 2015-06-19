<?php

namespace Webaccess\CMS\Interactors\GalleryItems;

use CMS\Context;
use Webaccess\WCMSLaravel\Helpers\ShortcutHelper;
use CMS\Interactors\Medias\GetMediaInteractor;

class GetGalleryItemInteractor
{
    public function GetGalleryItemByID($galleryItemID, $structure = false)
    {
        if (!$galleryItem = Context::getRepository('gallery_item')->findByID($galleryItemID)) {
            throw new \Exception('The gallery item was not found');
        }

        if ($structure) {
            $galleryItem = $galleryItem->toStructure();

            if ($galleryItem->mediaID) {
                $galleryItem->media = (new GetMediaInteractor())->getMediaByID($galleryItem->mediaID, true);
                $galleryItem->media_src = asset(ShortcutHelper::get_uploads_folder() . $galleryItem->media->ID . '/' . $galleryItem->media->fileName);
                $galleryItem->media_name = $galleryItem->media->name;
            }
        }

        return $galleryItem;
    }
}
