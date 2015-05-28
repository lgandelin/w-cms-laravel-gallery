<?php

namespace Webaccess\WCMSLaravelGallery\Models;

use Webaccess\CMS\Entities\Blocks\GalleryBlock as GalleryBlockEntity;

class GalleryBlock extends \Eloquent {

    protected $table = 'gallery_blocks';
    protected $fillable = array('gallery_id');

    public function block() {
        return $this->morphOne('\Webaccess\WCMSLaravel\Models\Block', 'blockable');
    }

    public function getEntity() {
        $block = new GalleryBlockEntity();
        $block->setGalleryID($this->gallery_id);

        return $block;
    }
}
