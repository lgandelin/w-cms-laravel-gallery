<?php

namespace Webaccess\WCMSLaravelGallery\BlockTypes;

use Webaccess\CMS\Interactors\Galleries\GetGalleriesInteractor;

class GalleryBlockType
{
    public function __construct() {
        $this->code = 'gallery';
        $this->name = trans('w-cms-laravel-gallery-back::galleries.gallery_block');
        $this->content_view = 'w-cms-laravel-gallery-back::editorial.blocks.content.gallery';
        $this->front_view = 'modules.gallery.blocks.gallery';
        $this->model_class = '\Webaccess\WCMSLaravelGallery\Models\Blocks\GalleryBlock';
        $this->order = 7;

        \App::make('BlockTypesVariable')->addVariable('galleries', (new GetGalleriesInteractor())->getAll(null, true));
    }
} 