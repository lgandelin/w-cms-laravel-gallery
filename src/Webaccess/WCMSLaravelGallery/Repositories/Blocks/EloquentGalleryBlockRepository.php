<?php

namespace Webaccess\WCMSLaravelGallery\Repositories\Blocks;

use \CMS\Entities\Block;
use Webaccess\CMS\Entities\Blocks\GalleryBlock as GalleryBlockEntity;
use Webaccess\WCMSLaravel\Models\Block as BlockModel;
use Webaccess\WCMSLaravelGallery\Models\Blocks\GalleryBlock;

class EloquentGalleryBlockRepository
{
    public function getBlock(BlockModel $blockModel) {
        $block = new GalleryBlockEntity();
        if ($blockModel->blockable) {
            $block->setGalleryID($blockModel->blockable->gallery_id);
        }

        return $block;
    }

    public function saveBlock(Block $block, BlockModel $blockModel) {
        $blockable = ($blockModel->blockable) ? $blockModel->blockable : new GalleryBlock();
        $blockable->gallery_id = $block->getGalleryID();
        $blockable->save();
        $blockable->block()->save($blockModel);
    }
}
