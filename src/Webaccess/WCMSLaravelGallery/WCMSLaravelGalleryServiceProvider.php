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

        Context::addTo('editorial_menu_items', 'galleries', [
            'route_name' => 'back_galleries_index',
            'class_name' => 'glyphicon-picture',
            'label' => trans('w-cms-laravel-gallery-back::galleries.galleries')
        ]);

        Context::addTo('block_variables', 'galleries', (new GetGalleriesInteractor())->getAll(null, true));
    }

    public function register()
    {
        Context::add('gallery', new EloquentGalleryRepository());
        Context::add('gallery_item',  new EloquentGalleryItemRepository());
        Context::add('block_gallery',  new EloquentGalleryBlockRepository());
    }
}
