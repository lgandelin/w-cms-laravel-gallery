<?php

namespace Webaccess\CMS\Interactors\GalleryItems;

use CMS\Context;
use CMS\Interactors\Medias\GetMediaInteractor;
use Webaccess\CMS\Interactors\Galleries\GetGalleryInteractor;
use Webaccess\WCMSLaravel\Helpers\ShortcutHelper;

class GetGalleryItemsInteractor
{
    public function getAll($galleryID, $structure = false)
    {
        $gallery = (new GetGalleryInteractor())->getGalleryByID($galleryID);
        $galleryItems = Context::getRepository('gallery_item')->findByGalleryID($galleryID);

        return ($structure) ? $this->getDataStructures($galleryItems, $gallery->getMediaFormatID()) : $galleryItems;
    }

    private function getDataStructures($galleryItems, $mediaFormatID)
    {
        $galleryItemStructures = [];
        if (is_array($galleryItems) && sizeof($galleryItems) > 0) {
            foreach ($galleryItems as $galleryItem) {
                $galleryItem = $galleryItem->toStructure();

                if ($galleryItem->mediaID) {
                    $galleryItem->media = (new GetMediaInteractor())->getMediaByID($galleryItem->mediaID, $mediaFormatID, true);
                    $galleryItem->media_src = asset(ShortcutHelper::get_uploads_folder() . $galleryItem->media->ID . '/' . $galleryItem->media->fileName);
                    $galleryItem->media_name = $galleryItem->media->name;
                    $galleryItem->mediaID = $galleryItem->media->ID;
                }
                $galleryItemStructures[] = $galleryItem;
            }
        }

        return $galleryItemStructures;
    }
}
