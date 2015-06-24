@include ('w-cms-laravel::back.editorial.includes.fields.select_field', [
    'label' => trans('w-cms-laravel-gallery-back::galleries.gallery_block'),
    'name' => 'gallery_id',
    'class' => 'gallery_id',
    'default_option_name' => trans('w-cms-laravel::pages.choose_gallery'),
    'items' => $galleries,
    'value' => (isset($block->galleryID)) ? $block->galleryID : null,
    'item_property_name' => 'name',
])