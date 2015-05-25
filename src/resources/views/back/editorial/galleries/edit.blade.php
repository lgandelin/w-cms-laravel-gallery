@extends('w-cms-laravel::back.master')

@section('page_title')
    {{ trans('w-cms-laravel-gallery-back::galleries.edit_gallery') }} > {{ $gallery->name }}
@stop

@section('javascripts')
    <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.1/jquery-ui.min.js"></script>
    {!! HTML::script('vendor/w-cms-laravel/back/js/galleries.js') !!}
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
                                    <div id="mi-{{ $item->ID }}" class="gallery_item" data-display="{{ $item->display }}">
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
                                    <label for="page_id">{{ trans('w-cms-laravel-gallery-back::galleries.item_media') }}</label>
                                    Browse
                                </div>
                                <!-- Media -->

                                <!-- Label -->
                                <div class="form-group">
                                    <label>{{ trans('w-cms-laravel-gallery-back::galleries.item_title') }}</label>
                                    <input type="text" class="form-control gallery-item-label" placeholder="{{ trans('w-cms-laravel-gallery-back::galleries.item_label') }}" autocomplete="off" />
                                </div>
                                <!-- Label -->

                                <!-- Label -->
                                <div class="form-group">
                                    <label>{{ trans('w-cms-laravel-gallery-back::galleries.item_text') }}</label>
                                    <input type="text" class="form-control gallery-item-text" placeholder="{{ trans('w-cms-laravel-gallery-back::galleries.item_text') }}" autocomplete="off" />
                                </div>
                                <!-- Label -->

                                <!-- Class -->
                                <div class="form-group">
                                    <label>{{ trans('w-cms-laravel-gallery-back::galleries.item_class') }}</label>
                                    <input type="text" class="form-control gallery-item-class" placeholder="{{ trans('w-cms-laravel-gallery-back::galleries.item_class') }}" autocomplete="off" />
                                </div>
                                <!-- Class -->

                                <!-- Save -->
                                <div class="submit_wrapper" style="clear:both; margin-top: 20px">
                                    <input type="button" class="btn-valid btn btn-success" value="{{ trans('w-cms-laravel-gallery-back::generic.submit') }}" />
                                    <input type="button" class="btn-close btn btn-default" value="{{ trans('w-cms-laravel-gallery-back::generic.close') }}" />
                                </div>
                                <!-- Save -->

                            </div>

                            <div class="col-xs-6">

                                <!-- Link -->
                                <div class="form-group">
                                    <label>{{ trans('w-cms-laravel-gallery-back::galleries.item_link') }}</label>
                                    <input type="text" class="form-control gallery-item-link" placeholder="{{ trans('w-cms-laravel-gallery-back::galleries.item_link') }}" autocomplete="off" />
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
    </div>

@stop