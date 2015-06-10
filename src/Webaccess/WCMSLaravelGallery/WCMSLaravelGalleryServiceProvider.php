<?php

namespace Webaccess\WCMSLaravelGallery;

use CMS\Context;
use Webaccess\WCMSLaravel\Helpers\WCMSLaravelModuleServiceProvider;
use Webaccess\WCMSLaravelGallery\BlockTypes\GalleryBlockType;
use Webaccess\WCMSLaravelGallery\Repositories\EloquentGalleryItemRepository;
use Webaccess\WCMSLaravelGallery\Repositories\EloquentGalleryRepository;

class WCMSLaravelGalleryServiceProvider extends WCMSLaravelModuleServiceProvider {

    public function boot()
    {
        include(__DIR__ . '/Http/routes.php');
        parent::initModule('gallery', __DIR__ . '/../../');
        $this->app->make('block_type')->addBlockType(new GalleryBlockType());
    }

    public function register()
    {
        Context::addRepository('gallery', new EloquentGalleryRepository());
        Context::addRepository('gallery_item',  new EloquentGalleryItemRepository());
    }
}
