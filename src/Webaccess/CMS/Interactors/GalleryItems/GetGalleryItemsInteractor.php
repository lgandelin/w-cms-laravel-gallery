<?php

namespace Webaccess\CMS\Interactors\GalleryItems;

use CMS\Context;
use CMS\Interactors\Medias\GetMediaInteractor;
use CMS\Interactors\MediaFormats\GetMediaFormatInteractor;
use Webaccess\CMS\Interactors\Galleries\GetGalleryInteractor;
use Webaccess\WCMSLaravel\Helpers\ShortcutHelper;
use Webaccess\CMS\Structures\GalleryItemStructure;

class GetGalleryItemsInteractor
{
    public function getAll($galleryID, $structure = false)
    {
        $gallery = (new GetGalleryInteractor())->getGalleryByID($galleryID);
        $galleryItems = Context::getRepository('gallery_item')->findByGalleryID($galleryID);

        return ($structure) ? $this->getGalleryItemStructures($galleryItems, $gallery->getMediaFormatID()) : $galleryItems;
    }

    private function getGalleryItemStructures($galleryItems, $mediaFormatID)
    {
        $galleryItemStructures = [];
        if (is_array($galleryItems) && sizeof($galleryItems) > 0) {
            foreach ($galleryItems as $galleryItem) {
                $galleryItem = GalleryItemStructure::toStructure($galleryItem);

                if ($galleryItem->media_id) {
                    $galleryItem->media = (new GetMediaInteractor())->getMediaByID($galleryItem->media_id, true);

                    if ($mediaFormatID) {
                        $mediaFormat = (new GetMediaFormatInteractor())->getMediaFormatByID($mediaFormatID, true);
                        $galleryItem->media->file_name = $mediaFormat->width . '_' . $mediaFormat->height . '_' . $galleryItem->media->file_name;
                    }

                    $galleryItem->media_src = asset(ShortcutHelper::get_uploads_folder() . $galleryItem->media->ID . '/' . $galleryItem->media->file_name);
                    $galleryItem->media_name = $galleryItem->media->name;
                    $galleryItem->media_id = $galleryItem->media->ID;
                }
                $galleryItemStructures[] = $galleryItem;
            }
        }

        return $galleryItemStructures;
    }
}
