<?php

namespace Webaccess\CMS\Interactors\GalleryItems;

use CMS\Context;
use Webaccess\WCMSLaravel\Helpers\ShortcutHelper;
use CMS\Interactors\Medias\GetMediaInteractor;
use Webaccess\CMS\Structures\GalleryItemStructure;

class GetGalleryItemInteractor
{
    public function GetGalleryItemByID($galleryItemID, $structure = false)
    {
        if (!$galleryItem = Context::getRepository('gallery_item')->findByID($galleryItemID)) {
            throw new \Exception('The gallery item was not found');
        }

        if ($structure) {
            $galleryItem = GalleryItemStructure::toStructure($galleryItem);

            if ($galleryItem->media_id) {
                $galleryItem->media = (new GetMediaInteractor())->getMediaByID($galleryItem->media_id, true);
                $galleryItem->media_src = asset(ShortcutHelper::get_uploads_folder() . $galleryItem->media->ID . '/' . $galleryItem->media->file_name);
                $galleryItem->media_name = $galleryItem->media->name;
                $galleryItem->media_id = $galleryItem->media->ID;
            }
        }

        return $galleryItem;
    }
}
