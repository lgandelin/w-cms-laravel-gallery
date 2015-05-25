<?php

namespace Webaccess\WCMSLaravelGallery\Http\Controllers\Back\Editorial;

use Webaccess\CMS\Structures\GalleryStructure;
use Webaccess\WCMSLaravel\Http\Controllers\Back\AdminController;

class GalleryController extends AdminController
{
    public function index()
    {
        return view('w-cms-laravel::back.editorial.galleries.index', [
            'galleries' => \App::make('GetGalleriesInteractor')->getAll($this->getLangID(), true),
            'error' => (\Session::has('error')) ? \Session::get('error') : null
        ]);
    }

    public function create()
    {
        return view('w-cms-laravel::back.editorial.galleries.create');
    }

    public function store()
    {
        $galleryStructure = new GalleryStructure([
            'identifier' => \Input::get('identifier'),
            'name' => \Input::get('name'),
            'lang_id' => $this->getLangID()
        ]);

        try {
            $galleryID = \App::make('CreateGalleryInteractor')->run($galleryStructure);
            return \Redirect::route('back_galleries_edit', array('galleryID' => $galleryID));
        } catch (\Exception $e) {
            return view('w-cms-laravel::back.editorial.galleries.create', [
                'error' => $e->getMessage(),
                'gallery' => $galleryStructure
            ]);
        }
    }

    public function edit($galleryID)
    {
        try {
            $gallery = \App::make('GetGalleryInteractor')->getGalleryByID($galleryID, true);
            $gallery->items = \App::make('GetGalleryItemsInteractor')->getAll($galleryID, true);

            return view('w-cms-laravel::back.editorial.galleries.edit', [
                'gallery' => $gallery,
                'pages' => \App::make('GetPagesInteractor')->getAll($this->getLangID(), true)
            ]);
        } catch (\Exception $e) {
            \Session::flash('error', $e->getMessage());
            return \Redirect::route('back_galleries_index');
        }
    }

    public function update()
    {
        $galleryID = \Input::get('ID');
        $galleryStructure = new GalleryStructure([
            'name' => \Input::get('name'),
            'identifier' => \Input::get('identifier'),
        ]);

        try {
            \App::make('UpdateGalleryInteractor')->run($galleryID, $galleryStructure);
            return \Redirect::route('back_galleries_index');
        } catch (\Exception $e) {
            \Session::flash('error', $e->getMessage());
            return \Redirect::route('back_galleries_index');
        }
    }

    public function delete($galleryID)
    {
        try {
            \App::make('DeleteGalleryInteractor')->run($galleryID);
            return \Redirect::route('back_galleries_index');
        } catch (\Exception $e) {
            \Session::flash('error', $e->getMessage());
            return \Redirect::route('back_galleries_index');
        }
    }

    public function duplicate($galleryID)
    {
        try {
            \App::make('DuplicateGalleryInteractor')->run($galleryID);
            return \Redirect::route('back_galleries_index');
        } catch (\Exception $e) {
            \Session::flash('error', $e->getMessage());
            return \Redirect::route('back_galleries_index');
        }
    }
}