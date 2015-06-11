<?php

namespace Webaccess\WCMSLaravelGallery\BlockTypes;

use Webaccess\CMS\Interactors\Galleries\GetGalleriesInteractor;
use Webaccess\WCMSLaravel\Models\Block as BlockModel;
use Webaccess\WCMSLaravelGallery\Models\GalleryBlock as GalleryBlockModel;
use CMS\Entities\Block;
use Webaccess\CMS\Entities\Blocks\GalleryBlock;
use Webaccess\CMS\Structures\Blocks\GalleryBlockStructure;

class GalleryBlockType
{
    public function __construct() {
        $this->code = 'gallery';
        $this->name = trans('w-cms-laravel-gallery-back::galleries.gallery_block');
        $this->content_view = 'w-cms-laravel-gallery-back::editorial.blocks.content.gallery';
        $this->template_view = 'w-cms-laravel-gallery-back::editorial.blocks.templates.gallery';
        $this->front_view = 'modules.gallery.blocks.gallery';
        $this->order = 7;
        $this->getEntityFromModelMethod = function(BlockModel $blockModel) {
            $block = new GalleryBlock();
            if ($blockModel->blockable) {
                $block->setGalleryID($blockModel->blockable->gallery_id);
            }

            return $block;
        };
        $this->getUpdateContentMethod = function(BlockModel $blockModel, Block $block) {
            $blockable = ($blockModel->blockable) ? $blockModel->blockable : new GalleryBlockModel();
            $blockable->gallery_id = $block->getGalleryID();
            $blockable->save();
            $blockable->block()->save($blockModel);
        };
        $this->getBlockStructureMethod = function() {
            return new GalleryBlockStructure();
        };
        $this->getBlockStructureForUpdateMethod = function($arguments) {
            return new GalleryBlockStructure([
                'gallery_id' => isset($arguments['gallery_id']) ? $arguments['gallery_id'] : null,
            ]);
        };

        \App::make('AdminMenu')->addItem([
            'route_name' => 'back_galleries_index',
            'class_name' => 'glyphicon-picture',
            'label' => trans('w-cms-laravel-gallery-back::galleries.galleries')
        ]);

        \App::make('BlockTypesVariable')->addVariable('galleries', (new GetGalleriesInteractor())->getAll(null, true));
    }
} 