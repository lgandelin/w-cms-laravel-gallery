<?php

namespace Webaccess\WCMSLaravelGallery;

use Webaccess\CMS\Interactors\Galleries\CreateGalleryInteractor;
use Webaccess\CMS\Interactors\Galleries\DeleteGalleryInteractor;
use Webaccess\CMS\Interactors\Galleries\DuplicateGalleryInteractor;
use Webaccess\CMS\Interactors\Galleries\GetGalleriesInteractor;
use Webaccess\CMS\Interactors\Galleries\GetGalleryInteractor;
use Webaccess\CMS\Interactors\Galleries\UpdateGalleryInteractor;
use Webaccess\CMS\Interactors\GalleryItems\CreateGalleryItemInteractor;
use Webaccess\CMS\Interactors\GalleryItems\DeleteGalleryItemInteractor;
use Webaccess\CMS\Interactors\GalleryItems\GetGalleryItemInteractor;
use Webaccess\CMS\Interactors\GalleryItems\GetGalleryItemsInteractor;
use Webaccess\CMS\Interactors\GalleryItems\UpdateGalleryItemInteractor;
use Webaccess\WCMSLaravel\Helpers\WCMSLaravelModuleServiceProvider;
use Webaccess\WCMSLaravelGallery\Repositories\EloquentGalleryItemRepository;
use Webaccess\WCMSLaravelGallery\Repositories\EloquentGalleryRepository;

class WCMSLaravelGalleryServiceProvider extends WCMSLaravelModuleServiceProvider {

    public function boot()
    {
        include(__DIR__ . '/Http/routes.php');
        parent::initModule('gallery', __DIR__ . '/../../');

        //Add the menu item
        $this->app->make('AdminMenu')->addItem([
            'route_name' => 'back_galleries_index',
            'class_name' => 'glyphicon-picture',
            'label' => trans('w-cms-laravel-gallery-back::galleries.galleries')
        ]);

        //Add the new block type
        $this->app->make('block_type')->addBlockType([
            'code' => 'gallery',
            'name' => 'Gallery block',
            'content_view' => 'w-cms-laravel-gallery-back::editorial.blocks.gallery',
            'order' => 8
        ]);
    }

    public function register()
    {
        //Galleries
        $this->app->bind('CreateGalleryInteractor', function() {
            return new CreateGalleryInteractor(new EloquentGalleryRepository());
        });

        $this->app->bind('GetGalleryInteractor', function() {
            return new GetGalleryInteractor(new EloquentGalleryRepository());
        });

        $this->app->bind('GetGalleriesInteractor', function() {
            return new GetGalleriesInteractor(new EloquentGalleryRepository());
        });

        $this->app->bind('UpdateGalleryInteractor', function() {
            return new UpdateGalleryInteractor(new EloquentGalleryRepository());
        });

        $this->app->bind('DuplicateGalleryInteractor', function() {
            return new DuplicateGalleryInteractor(
                new EloquentGalleryRepository(),
                $this->app->make('CreateGalleryInteractor'),
                $this->app->make('GetGalleryItemsInteractor'),
                $this->app->make('CreateGalleryItemInteractor')
            );
        });

        $this->app->bind('DeleteGalleryInteractor', function() {
            return new DeleteGalleryInteractor(
                new EloquentGalleryRepository(),
                $this->app->make('GetGalleryItemsInteractor'),
                $this->app->make('DeleteGalleryItemInteractor')
            );
        });


        //Gallery items
        $this->app->bind('GetGalleryItemInteractor', function() {
            return new GetGalleryItemInteractor(new EloquentGalleryItemRepository());
        });

        $this->app->bind('GetGalleryItemsInteractor', function() {
            return new GetGalleryItemsInteractor(new EloquentGalleryItemRepository());
        });

        $this->app->bind('CreateGalleryItemInteractor', function() {
            return new CreateGalleryItemInteractor(new EloquentGalleryItemRepository());
        });

        $this->app->bind('UpdateGalleryItemInteractor', function() {
            return new UpdateGalleryItemInteractor(new EloquentGalleryItemRepository());
        });

        $this->app->bind('DeleteGalleryItemInteractor', function() {
            return new DeleteGalleryItemInteractor(new EloquentGalleryItemRepository());
        });
    }
}
