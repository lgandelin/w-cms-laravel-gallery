<?php

namespace Webaccess\WCMSLaravelGallery\Repositories;

use Webaccess\CMS\Entities\Gallery;
use Webaccess\CMS\Repositories\GalleryRepositoryInterface;
use Webaccess\WCMSLaravelGallery\Models\Gallery as GalleryModel;

class EloquentGalleryRepository implements GalleryRepositoryInterface
{
    public function findByID($galleryID)
    {
        if ($galleryModel = GalleryModel::find($galleryID))
            return self::createGalleryFromModel($galleryModel);

        return false;
    }

    public function findByIdentifier($identifier)
    {
        if ($galleryModel = GalleryModel::where('identifier', '=', $identifier)->first())
            return self::createGalleryFromModel($galleryModel);

        return false;
    }

    public function findAll($langID = null)
    {
        $galleryModels = GalleryModel::get();
        if ($langID) {
            $galleryModels = GalleryModel::where('lang_id', '=', $langID)->get();
        }

        $galleries = [];
        foreach ($galleryModels as $galleryModel) {
            $galleries[]= self::createGalleryFromModel($galleryModel);
        }

        return $galleries;
    }

    public function createGallery(Gallery $gallery)
    {
        $galleryModel = new GalleryModel();
        $galleryModel->name = $gallery->getName();
        $galleryModel->identifier = $gallery->getIdentifier();
        $galleryModel->lang_id = $gallery->getLangID();

        $galleryModel->save();

        return $galleryModel->id;
    }

    public function updateGallery(Gallery $gallery)
    {
        $galleryModel = GalleryModel::find($gallery->getID());
        $galleryModel->name = $gallery->getName();
        $galleryModel->identifier = $gallery->getIdentifier();

        return $galleryModel->save();
    }

    public function deleteGallery($galleryID)
    {
        $galleryModel = GalleryModel::find($galleryID);

        return $galleryModel->delete();
    }

    private static function createGalleryFromModel(GalleryModel $galleryModel)
    {
        $gallery = new Gallery();
        $gallery->setID($galleryModel->id);
        $gallery->setIdentifier($galleryModel->identifier);
        $gallery->setLangID($galleryModel->lang_id);
        $gallery->setName($galleryModel->name);

        return $gallery;
    }
}