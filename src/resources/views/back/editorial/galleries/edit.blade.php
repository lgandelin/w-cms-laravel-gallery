@extends('w-cms-laravel::back.master')

@section('stylesheets')
@parent
{!! HTML::style('/vendor/modules/gallery/sass/galleries.css') !!}
@stop

@section('page_title')
{{ trans('w-cms-laravel-gallery-back::galleries.edit_gallery') }} > {{ $gallery->name }}
@stop

@section('javascripts')
<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.1/jquery-ui.min.js"></script>
{!! HTML::script('/vendor/modules/gallery/js/galleries.js') !!}
{!! HTML::script('vendor/w-cms-laravel/back/js/includes.js') !!}

<script>
    var route_gallery_items_create = "{{ route('back_gallery_items_create') }}";
    var route_gallery_items_delete = "{{ route('back_gallery_items_delete') }}";
    var route_gallery_items_get_infos = "{{ route('back_gallery_items_get_infos') }}";
    var route_gallery_items_update_infos = "{{ route('back_gallery_items_update_infos') }}";
    var route_gallery_items_update_order = "{{ route('back_gallery_items_update_order') }}";
    var route_gallery_items_display = "{{ route('back_gallery_items_display') }}";
</script>
@stop

@section('content')

<div class="container-fluid galleries-interface">
    <div class="row main">

        <ol class="breadcrumb">
            <li><a href="{{ route('back') }}">{{ trans('w-cms-laravel::header.dashboard') }}</a></li>
            <li><a href="{{ route('back_editorial') }}">{{ trans('w-cms-laravel::header.editorial') }}</a></li>
            <li><a href="{{ route('back_galleries_index') }}">{{ trans('w-cms-laravel-gallery-back::galleries.galleries') }}</a></li>
            <li class="active">{{ $gallery->name }}</li>
        </ol>

        <h1 class="gallery-header">{{ trans('w-cms-laravel-gallery-back::galleries.edit_gallery') }}</h1>

        @if (isset($error))
        <div class="alert alert-danger">{{ $error }}</div>
        @endif

        @if ($gallery)
        {!! Form::open(array('url' => route('back_galleries_update'), 'method' => 'post')) !!}

        <!-- Name -->
        <div class="form-group">
            <label for="name">{{ trans('w-cms-laravel-gallery-back::galleries.name') }}</label>
            <input type="text" class="form-control" id="name" name="name" placeholder="{{ trans('w-cms-laravel-gallery-back::galleries.name') }}" value="{{ $gallery->name }}" />
        </div>
        <!-- Name -->

        <!-- Identifier -->
        <div class="form-group">
            <label for="identifier">{{ trans('w-cms-laravel-gallery-back::galleries.identifier') }}</label>
            <input type="text" class="form-control" id="identifier" name="identifier" placeholder="{{ trans('w-cms-laravel-gallery-back::galleries.identifier') }}" value="{{ $gallery->identifier }}" />
        </div>
        <!-- Identifier -->

        <!-- Media format -->
        <div class="form-group">
            <label for="media_format_id">{{ trans('w-cms-laravel::pages.block_media_format') }}</label>
            <select name="media_format_id" class="media_format_id form-control" autocomplete="off">
                <option value="">{{ trans('w-cms-laravel::pages.choose_media_format') }}</option>
                @if (isset($media_formats))
                @foreach ($media_formats as $media_format)
                <option value="{{ $media_format->ID }}" @if (isset($gallery->media_format_id) && $gallery->media_format_id == $media_format->ID) selected="selected" @endif>{{ $media_format->name }} ({{ $media_format->width }} x {{ $media_format->height}})</option>
                @endforeach
                @endif
            </select>
        </div>
        <!-- Media format -->

        <!-- Save -->
        <div class="form-group">
            <input type="submit" class="btn btn-success" value="{{ trans('w-cms-laravel::generic.submit') }}" />
            <a class="btn btn-default" href="{{ route('back_galleries_index') }}" title="{{ trans('w-cms-laravel-gallery-back::header.galleries') }}">{{ trans('w-cms-laravel::generic.cancel') }}</a>

            <input class="gallery-id" type="hidden" name="ID" value="{{ $gallery->ID }}" />
        </div>
        <!-- Save -->

        {!! Form::close() !!}

        <div class="form-group">
            <label for="items">{{ trans('w-cms-laravel-gallery-back::galleries.items') }}</label>

            <div style="overflow: hidden">
                <div class="items-order">
                    <div class="gallery-items-wrapper">
                        @if ($gallery->items)
                        @foreach ($gallery->items as $item)
                        <div id="mi-{{ $item->ID }}" class="gallery_item" data-display="{{ $item->display }}" data-id="{{ $item->ID }}">
                                        <span class="title">
                                            <span class="gallery_item_title">{{ $item->title }}</span>
                                            <span data-id="{{ $item->ID }}" class="gallery-item-delete glyphicon glyphicon-remove"></span>
                                            <span data-id="{{ $item->ID }}" class="gallery-item-move glyphicon glyphicon-move"></span>
                                            <span data-id="{{ $item->ID }}" class="gallery-item-display @if ($item->display == 0) gallery-item-hidden @endif glyphicon glyphicon-eye-open"></span>
                                            <span data-id="{{ $item->ID }}" class="gallery-item-update glyphicon glyphicon-pencil"></span>
                                        </span>
                        </div>
                        @endforeach
                        @endif
                    </div>

                    <div class="form-group">
                        <button class="btn btn-success btn-create-gallery-item">{{ trans('w-cms-laravel-gallery-back::galleries.add_gallery_item') }}</button>
                    </div>

                </div>

                <!-- MENU ITEM FORM -->
                <div class="gallery-item-form" style="display:none">

                    <div class="col-xs-6">

                        <!-- Media -->
                        <div class="form-group">
                            @include ('w-cms-laravel::back.editorial.includes.media_field', ['divID' => 'gallery-item', 'media' => null])
                        </div>
                        <!-- Media -->

                        <!-- Title -->
                        <div class="form-group">
                            <label>{{ trans('w-cms-laravel-gallery-back::galleries.item_title') }}</label>
                            <input name="title" type="text" class="form-control title" placeholder="{{ trans('w-cms-laravel-gallery-back::galleries.item_label') }}" autocomplete="off" />
                        </div>
                        <!-- Title -->

                        <!-- Text -->
                        <div class="form-group">
                            <label>{{ trans('w-cms-laravel-gallery-back::galleries.item_text') }}</label>
                            <textarea name="text" class="form-control text" placeholder="{{ trans('w-cms-laravel-gallery-back::galleries.item_text') }}" autocomplete="off"></textarea>
                        </div>
                        <!-- Text -->

                        <!-- Class -->
                        <div class="form-group">
                            <label>{{ trans('w-cms-laravel-gallery-back::galleries.item_class') }}</label>
                            <input name="class" type="text" class="form-control class" placeholder="{{ trans('w-cms-laravel-gallery-back::galleries.item_class') }}" autocomplete="off" />
                        </div>
                        <!-- Class -->

                        <!-- Save -->
                        <div class="submit_wrapper" style="clear:both; margin-top: 20px">
                            <input type="button" class="btn-valid btn btn-success" value="{{ trans('w-cms-laravel::generic.submit') }}" />
                            <input type="button" class="btn-close btn btn-default" value="{{ trans('w-cms-laravel::generic.close') }}" />
                        </div>
                        <!-- Save -->

                    </div>

                    <div class="col-xs-6">

                        <!-- Link -->
                        <div class="form-group">
                            <label>{{ trans('w-cms-laravel-gallery-back::galleries.item_link') }}</label>
                            <input type="text" class="form-control link" placeholder="{{ trans('w-cms-laravel-gallery-back::galleries.item_link') }}" autocomplete="off" />
                        </div>
                        <!-- Link -->

                    </div>

                </div>
                <!-- MENU ITEM FORM -->

            </div>
        </div>

        @else
        {{ trans('w-cms-laravel-gallery-back::galleries.not_found') }}
        @endif

    </div>
    @include ('w-cms-laravel::back.editorial.includes.media_modal')
</div>
@stop