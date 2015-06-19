<?php

namespace Webaccess\WCMSLaravelGallery\Http\Controllers\Back\Editorial;

use Webaccess\CMS\Interactors\GalleryItems\CreateGalleryItemInteractor;
use Webaccess\CMS\Interactors\GalleryItems\DeleteGalleryItemInteractor;
use Webaccess\CMS\Interactors\GalleryItems\GetGalleryItemInteractor;
use Webaccess\CMS\Interactors\GalleryItems\UpdateGalleryItemInteractor;
use CMS\Structures\DataStructure;
use Webaccess\WCMSLaravel\Http\Controllers\Back\AdminController;

class GalleryItemController extends AdminController
{
    public function create()
    {
        $galleryItemStructure = new DataStructure([
            'title' => \Input::get('title'),
            'text' => \Input::get('text'),
            'order' => 999,
            'class' => \Input::get('class'),
            'mediaID' => \Input::get('media_id'),
            'link' => \Input::get('link'),
            'display' => \Input::get('display'),
            'galleryID' => \Input::get('gallery_id'),
            'externalURL' => \Input::get('externalURL'),
        ]);

        try {
            $galleryItemID = (new CreateGalleryItemInteractor())->run($galleryItemStructure);
            $galleryItem = (new GetGalleryItemInteractor())->getGalleryItemByID($galleryItemID, true);

            return json_encode(array('success' => true, 'gallery_item' => $galleryItem->toArray()));
        } catch (\Exception $e) {
            return json_encode(array('success' => false, 'error' => $e->getMessage()));
        }
    }

    public function get_infos($galleryItemID)
    {
        try {
            $galleryItem = (new GetGalleryItemInteractor())->getGalleryItemByID($galleryItemID, true);
            return json_encode(array('success' => true, 'gallery_item' => $galleryItem->toArray()));
        } catch (\Exception $e) {
            return json_encode(array('success' => false, 'error' => $e->getMessage()));
        }
    }

    public function update_infos()
    {
        $galleryItemID = \Input::get('ID');
        $galleryItemStructure = new DataStructure([
            'title' => \Input::get('title'),
            'text' => \Input::get('text'),
            'class' => \Input::get('class'),
            'mediaID' => \Input::get('media_id'),
            'link' => \Input::get('link'),
        ]);

        try {
            (new UpdateGalleryItemInteractor())->run($galleryItemID, $galleryItemStructure);
            return json_encode(array('success' => true));
        } catch (\Exception $e) {
            return json_encode(array('success' => false, 'error' => $e->getMessage()));
        }
    }

    public function update_order()
    {
        $galleryItems = json_decode(\Input::get('gallery_items'));
        for ($i = 0; $i < sizeof($galleryItems ); $i++) {
            $galleryItemID = preg_replace('/mi-/', '', $galleryItems[$i]);
            $galleryItemStructure = new DataStructure([
                'order' => $i + 1,
            ]);

            try {
                (new UpdateGalleryItemInteractor())->run($galleryItemID, $galleryItemStructure);
            } catch (\Exception $e) {
                return json_encode(array('success' => false, 'error' => $e->getMessage()));
            }
        }

        return json_encode(array('success' => true));
    }

    public function display()
    {
        try {
            $galleryItemID = \Input::get('ID');
            $galleryItemStructure = new DataStructure([
                'display'=> \Input::get('display')
            ]);

            (new UpdateGalleryItemInteractor())->run($galleryItemID, $galleryItemStructure);
            return json_encode(array('success' => true));
        } catch (\Exception $e) {
            return json_encode(array('success' => false, 'error' => $e->getMessage()));
        }
    }

    public function delete()
    {
        $galleryItemID = \Input::get('ID');

        try {
            (new DeleteGalleryItemInteractor())->run($galleryItemID);
            return json_encode(array('success' => true));
        } catch (\Exception $e) {
            return json_encode(array('success' => false, 'error' => $e->getMessage()));
        }
    }
} 