<?php

namespace Webaccess\WCMSLaravelGallery\Repositories;

use Webaccess\CMS\Entities\GalleryItem;
use Webaccess\CMS\Repositories\GalleryItemRepositoryInterface;
use Webaccess\WCMSLaravelGallery\Models\GalleryItem as GalleryItemModel;

class EloquentGalleryItemRepository implements GalleryItemRepositoryInterface
{
    public function findByID($galleryItemID)
    {
        if ($galleryItemModel = GalleryItemModel::find($galleryItemID))
            return self::createGalleryItemFromModel($galleryItemModel);

        return false;
    }

    public function findByGalleryID($galleryID)
    {
        $galleryItemModels = GalleryItemModel::where('gallery_id', '=', $galleryID)->orderBy('order', 'asc')->get();

        $galleryItems = [];
        foreach ($galleryItemModels as $i => $galleryItemModel) {
            $galleryItems[]= self::createGalleryItemFromModel($galleryItemModel);
        }

        return $galleryItems;
    }

    public function createGalleryItem(GalleryItem $galleryItem)
    {
        $galleryItemModel = new GalleryItemModel();
        $galleryItemModel->title = $galleryItem->getTitle();
        $galleryItemModel->text = $galleryItem->getText();
        $galleryItemModel->order = $galleryItem->getOrder();
        $galleryItemModel->media_id = $galleryItem->getMediaID();
        $galleryItemModel->link = $galleryItem->getLink();
        $galleryItemModel->gallery_id = $galleryItem->getGalleryID();
        $galleryItemModel->class = $galleryItem->getClass();
        $galleryItemModel->display = $galleryItem->getDisplay();

        $galleryItemModel->save();

        return $galleryItemModel->id;
    }

    public function updateGalleryItem(GalleryItem $galleryItem)
    {
        $galleryItemModel = GalleryItemModel::find($galleryItem->getID());
        $galleryItemModel->title = $galleryItem->getTitle();
        $galleryItemModel->text = $galleryItem->getText();
        $galleryItemModel->order = $galleryItem->getOrder();
        $galleryItemModel->media_id = $galleryItem->getMediaID();
        $galleryItemModel->link = $galleryItem->getLink();
        $galleryItemModel->class = $galleryItem->getClass();
        $galleryItemModel->display = $galleryItem->getDisplay();

        return $galleryItemModel->save();
    }

    public function deleteGalleryItem($galleryItemID)
    {
        $galleryItemModel = GalleryItemModel::find($galleryItemID);

        return $galleryItemModel->delete();
    }

    private static function createGalleryItemFromModel(GalleryItemModel $galleryItemModel)
    {
        $galleryItem = new GalleryItem();
        $galleryItem->setID($galleryItemModel->id);
        $galleryItem->setTitle($galleryItemModel->title);
        $galleryItem->setText($galleryItemModel->text);
        $galleryItem->setOrder($galleryItemModel->order);
        $galleryItem->setMediaID($galleryItemModel->media_id);
        $galleryItem->setExternalURL($galleryItemModel->link);
        $galleryItem->setClass($galleryItemModel->class);
        $galleryItem->setDisplay($galleryItemModel->display);

        return $galleryItem;
    }
} 