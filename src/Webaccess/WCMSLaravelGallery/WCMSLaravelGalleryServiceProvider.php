<?php

namespace Webaccess\WCMSLaravelGallery;

use CMS\Context;
use Webaccess\CMS\Interactors\Galleries\GetGalleriesInteractor;
use Webaccess\WCMSLaravel\Helpers\WCMSLaravelModuleServiceProvider;
use Webaccess\WCMSLaravelGallery\Repositories\Blocks\EloquentGalleryBlockRepository;
use Webaccess\WCMSLaravelGallery\Repositories\EloquentGalleryItemRepository;
use Webaccess\WCMSLaravelGallery\Repositories\EloquentGalleryRepository;

class WCMSLaravelGalleryServiceProvider extends WCMSLaravelModuleServiceProvider {

    public function boot()
    {
        include(__DIR__ . '/Http/routes.php');
        parent::initModule('gallery', __DIR__ . '/../../');

        $this->app->make('AdminMenu')->addItem([
            'route_name' => 'back_galleries_index',
            'class_name' => 'glyphicon-picture',
            'label' => trans('w-cms-laravel-gallery-back::galleries.galleries')
        ]);

        \App::make('BlockTypesVariable')->addVariable('galleries', (new GetGalleriesInteractor())->getAll(null, true));
    }

    public function register()
    {
        Context::addRepository('gallery', new EloquentGalleryRepository());
        Context::addRepository('gallery_item',  new EloquentGalleryItemRepository());
        Context::addRepository('block_gallery',  new EloquentGalleryBlockRepository());
    }
}
