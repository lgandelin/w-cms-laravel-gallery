@extends('w-cms-laravel::back.master')

@section('page_title')
    {{ trans('w-cms-laravel-gallery-back::galleries.create_gallery') }}
@stop

@section('content')

    <div class="container-fluid">
        <div class="row main">
            
            <ol class="breadcrumb">
                <li><a href="{{ route('back') }}">{{ trans('w-cms-laravel::header.dashboard') }}</a></li>
                <li><a href="{{ route('back_editorial') }}">{{ trans('w-cms-laravel::header.editorial') }}</a></li>
                <li><a href="{{ route('back_galleries_index') }}">{{ trans('w-cms-laravel-gallery-back::galleries.galleries') }}</a></li>
                <li class="active">{{ trans('w-cms-laravel-gallery-back::galleries.create_gallery') }}</li>
            </ol>

            <h1 class="gallery-header">{{ trans('w-cms-laravel-gallery-back::galleries.create_gallery') }}</h1>
            
            @if (isset($error))
                <div class="alert alert-danger">{{ $error }}</div>
            @endif

            {!! Form::open(array('url' => route('back_galleries_store'), 'method' => 'post')) !!}

                <div class="form-group">
                    <label for="name">{{ trans('w-cms-laravel-gallery-back::galleries.name') }}</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="{{ trans('w-cms-laravel-gallery-back::galleries.name') }}" value="{{{ $gallery->name or '' }}}" />
                </div>

                <div class="form-group">
                    <label for="identifier">{{ trans('w-cms-laravel-gallery-back::galleries.identifier') }}</label>
                    <input type="text" class="form-control" id="identifier" name="identifier" placeholder="{{ trans('w-cms-laravel-gallery-back::galleries.identifier') }}" value="{{{ $gallery->identifier or ''}}}" />
                </div>

                <input type="submit" class="btn btn-success" value="{{ trans('w-cms-laravel::generic.submit') }}" />
                <a class="btn btn-default" href="{{ route('back_galleries_index') }}" title="{{ trans('w-cms-laravel::header.galleries') }}">{{ trans('w-cms-laravel::generic.cancel') }}</a>

            {!! Form::close() !!}
            
        </div>
    </div>

@stop