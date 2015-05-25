<?php

namespace Webaccess\WCMSLaravelGallery;

use Webaccess\WCMSLaravel\Helpers\WCMSLaravelModuleServiceProvider;

class WCMSLaravelGalleryServiceProvider extends WCMSLaravelModuleServiceProvider {

    public function boot()
    {
        include(__DIR__ . '/Http/routes.php');
        parent::initModule('gallery', __DIR__ . '/../../');
    }
}
