<?php

namespace Webaccess\WCMSLaravelGallery\Models;

class Gallery extends \Eloquent {

    protected $table = 'galleries';
    protected $fillable = array('name', 'identifier', 'lang_id');

    public function items()
    {
        return $this->hasMany('Webaccess\WCMSLaravelGallery\Models\GalleryItem');
    }

}