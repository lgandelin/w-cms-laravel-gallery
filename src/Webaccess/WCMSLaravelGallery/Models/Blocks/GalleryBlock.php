<?php

namespace Webaccess\WCMSLaravelGallery\Models\Blocks;

class GalleryBlock extends \Eloquent {

    protected $table = 'blocks_gallery';
    protected $fillable = array('gallery_id');

    public function block() {
        return $this->morphOne('\Webaccess\WCMSLaravel\Models\Block', 'blockable');
    }
}
