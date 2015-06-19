<?php

namespace Webaccess\WCMSLaravelGallery\Http\Controllers\Back\Editorial;

use Webaccess\CMS\Interactors\Galleries\CreateGalleryInteractor;
use Webaccess\CMS\Interactors\Galleries\DeleteGalleryInteractor;
use Webaccess\CMS\Interactors\Galleries\DuplicateGalleryInteractor;
use Webaccess\CMS\Interactors\Galleries\GetGalleriesInteractor;
use Webaccess\CMS\Interactors\Galleries\GetGalleryInteractor;
use Webaccess\CMS\Interactors\Galleries\UpdateGalleryInteractor;
use Webaccess\CMS\Interactors\GalleryItems\GetGalleryItemsInteractor;
use CMS\Structures\DataStructure;
use CMS\Interactors\Medias\GetMediasInteractor;
use CMS\Interactors\MediaFormats\GetMediaFormatsInteractor;
use Webaccess\WCMSLaravel\Http\Controllers\Back\AdminController;

class GalleryController extends AdminController
{
    public function index()
    {
        return view('w-cms-laravel-gallery-back::editorial.galleries.index', [
            'galleries' => (new GetGalleriesInteractor())->getAll($this->getLangID(), true),
            'error' => (\Session::has('error')) ? \Session::get('error') : null
        ]);
    }

    public function create()
    {
        return view('w-cms-laravel-gallery-back::editorial.galleries.create');
    }

    public function store()
    {
        $galleryStructure = new DataStructure([
            'name' => \Input::get('name'),
            'identifier' => \Input::get('identifier'),
            'mediaFormatID' => \Input::get('media_format_id'),
            'langID' => $this->getLangID()
        ]);

        try {
            $galleryID = (new CreateGalleryInteractor())->run($galleryStructure);
            return \Redirect::route('back_galleries_edit', array('galleryID' => $galleryID));
        } catch (\Exception $e) {
            return view('w-cms-laravel-gallery-back::editorial.galleries.create', [
                'error' => $e->getMessage(),
                'gallery' => $galleryStructure
            ]);
        }
    }

    public function edit($galleryID)
    {
        try {
            $gallery = (new GetGalleryInteractor())->getGalleryByID($galleryID, true);
            $gallery->items = (new GetGalleryItemsInteractor())->getAll($galleryID, true);

            return view('w-cms-laravel-gallery-back::editorial.galleries.edit', [
                'gallery' => $gallery,
                'medias' => (new GetMediasInteractor())->getAll(true),
                'media_formats' => (new GetMediaFormatsInteractor())->getAll(true)
            ]);
        } catch (\Exception $e) {
            \Session::flash('error', $e->getMessage());
            return \Redirect::route('back_galleries_index');
        }
    }

    public function update()
    {
        $galleryID = \Input::get('ID');
        $galleryStructure = new DataStructure([
            'name' => \Input::get('name'),
            'identifier' => \Input::get('identifier'),
            'mediaFormatID' => \Input::get('media_format_id'),
        ]);

        try {
            (new UpdateGalleryInteractor())->run($galleryID, $galleryStructure);
            return \Redirect::route('back_galleries_index');
        } catch (\Exception $e) {
            \Session::flash('error', $e->getMessage());
            return \Redirect::route('back_galleries_index');
        }
    }

    public function delete($galleryID)
    {
        try {
            (new DeleteGalleryInteractor())->run($galleryID);
            return \Redirect::route('back_galleries_index');
        } catch (\Exception $e) {
            \Session::flash('error', $e->getMessage());
            return \Redirect::route('back_galleries_index');
        }
    }

    public function duplicate($galleryID)
    {
        try {
            (new DuplicateGalleryInteractor())->run($galleryID);
            return \Redirect::route('back_galleries_index');
        } catch (\Exception $e) {
            \Session::flash('error', $e->getMessage());
            return \Redirect::route('back_galleries_index');
        }
    }
}