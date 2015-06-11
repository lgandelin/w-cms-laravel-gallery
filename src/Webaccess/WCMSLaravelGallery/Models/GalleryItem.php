<?php

namespace Webaccess\WCMSLaravelGallery\Models;

class GalleryItem extends \Eloquent {

    protected $table = 'gallery_items';
    protected $fillable = array('title', 'text', 'order', 'media_id', 'class');

    public function media()
    {
        return $this->hasOne('Webaccess\WCMSLaravelGallery\Models\Media');
    }
}
