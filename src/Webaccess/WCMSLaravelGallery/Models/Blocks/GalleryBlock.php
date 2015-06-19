<?php

namespace Webaccess\WCMSLaravelGallery\Models\Blocks;

use CMS\Entities\Block;
use Webaccess\CMS\Entities\Blocks\GalleryBlock as GalleryBlockEntity;
use Webaccess\WCMSLaravel\Models\Block as BlockModel;

class GalleryBlock extends \Eloquent {

    protected $table = 'blocks_gallery';
    protected $fillable = array('gallery_id');

    public function block() {
        return $this->morphOne('\Webaccess\WCMSLaravel\Models\Block', 'blockable');
    }

    public function getEntity(BlockModel $blockModel) {
        $block = new GalleryBlockEntity();
        if ($blockModel->blockable) {
            $block->setGalleryID($blockModel->blockable->gallery_id);
        }

        return $block;
    }

    public function updateContent(BlockModel $blockModel, Block $block) {
        $blockable = ($blockModel->blockable) ? $blockModel->blockable : new self();
        $blockable->gallery_id = $block->getGalleryID();
        $blockable->save();
        $blockable->block()->save($blockModel);
    }
}
