<?php

//BACK > EDITORIAL > GALLERIES
Route::get('/admin/editorial/galleries', array('as' => 'back_galleries_index', 'uses' => 'Webaccess\WCMSLaravelGallery\Http\Controllers\Back\Editorial\GalleryController@index'));
Route::get('/admin/editorial/galleries/create', array('as' => 'back_galleries_create', 'uses' => 'Webaccess\WCMSLaravelGallery\Http\Controllers\Back\Editorial\GalleryController@create'));
Route::post('/admin/editorial/galleries/store', array('as' => 'back_galleries_store', 'uses' => 'Webaccess\WCMSLaravelGallery\Http\Controllers\Back\Editorial\GalleryController@store'));
Route::get('/admin/editorial/galleries/edit/{galleryID}', array('as' => 'back_galleries_edit', 'uses' => 'Webaccess\WCMSLaravelGallery\Http\Controllers\Back\Editorial\GalleryController@edit'));
Route::post('/admin/editorial/galleries/update', array('as' => 'back_galleries_update', 'uses' => 'Webaccess\WCMSLaravelGallery\Http\Controllers\Back\Editorial\GalleryController@update'));
Route::get('/admin/editorial/galleries/delete/{galleryID}', array('as' => 'back_galleries_delete', 'uses' => 'Webaccess\WCMSLaravelGallery\Http\Controllers\Back\Editorial\GalleryController@delete'));
Route::get('/admin/editorial/galleries/duplicate/{galleryID}', array('as' => 'back_galleries_duplicate', 'uses' => 'Webaccess\WCMSLaravelGallery\Http\Controllers\Back\Editorial\GalleryController@duplicate'));

Route::post('/admin/editorial/gallery_items/create', array('as' => 'back_gallery_items_create', 'uses' => 'Webaccess\WCMSLaravelGallery\Http\Controllers\Back\Editorial\GalleryItemController@create'));
Route::get('/admin/editorial/gallery_items/get_infos/{galleryItemID?}', array('as' => 'back_gallery_items_get_infos', 'uses' => 'Webaccess\WCMSLaravelGallery\Http\Controllers\Back\Editorial\GalleryItemController@get_infos'));
Route::post('/admin/editorial/gallery_items/update_infos', array('as' => 'back_gallery_items_update_infos', 'uses' => 'Webaccess\WCMSLaravelGallery\Http\Controllers\Back\Editorial\GalleryItemController@update_infos'));
Route::post('/admin/editorial/gallery_items/update_order', array('as' => 'back_gallery_items_update_order', 'uses' => 'Webaccess\WCMSLaravelGallery\Http\Controllers\Back\Editorial\GalleryItemController@update_order'));
Route::post('/admin/editorial/gallery_items/display', array('as' => 'back_gallery_items_display', 'uses' => 'Webaccess\WCMSLaravelGallery\Http\Controllers\Back\Editorial\GalleryItemController@display'));
Route::post('/admin/editorial/gallery_items/delete', array('as' => 'back_gallery_items_delete', 'uses' => 'Webaccess\WCMSLaravelGallery\Http\Controllers\Back\Editorial\GalleryItemController@delete'));