@extends('w-cms-laravel::back.master')

@section('page_title')
{{ trans('w-cms-laravel-gallery-back::galleries.galleries') }}
@stop

@section('content')

<div class="container-fluid">
    <div class="row main">

        <ol class="breadcrumb">
            <li><a href="{{ route('back') }}">{{ trans('w-cms-laravel::header.dashboard') }}</a></li>
            <li><a href="{{ route('back_editorial') }}">{{ trans('w-cms-laravel::header.editorial') }}</a></li>
            <li class="active">{{ trans('w-cms-laravel-gallery-back::galleries.galleries') }}</li>
        </ol>

        <h1 class="gallery-header">{{ trans('w-cms-laravel-gallery-back::galleries.galleries') }}</h1>

        @if (isset($error))
        <div class="alert alert-danger">{{ $error }}</div>
        @endif

        @if ($galleries)
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>#</th>
                    <th>{{ trans('w-cms-laravel-gallery-back::galleries.name') }}</th>
                    <th>{{ trans('w-cms-laravel-gallery-back::galleries.identifier') }}</th>
                    <th>{{ trans('w-cms-laravel::generic.action') }}</th>
                </tr>
                </thead>
                <tbody>
                    @foreach ($galleries as $gallery)
                    <tr>
                        <td>{{{ $gallery->ID or '' }}}</td>
                        <td>{{ $gallery->name }}</td>
                        <td>{{ $gallery->identifier }}</td>
                        <td>
                            <a class="btn btn-default" href="{{ route('back_galleries_edit', array($gallery->ID)) }}" title="{{ $gallery->name }}">{{ trans('w-cms-laravel::generic.edit') }}</a>
                            <a class="btn btn-default" href="{{ route('back_galleries_duplicate', array($gallery->ID)) }}" title="{{ $gallery->name }}">{{ trans('w-cms-laravel::generic.duplicate') }}</a>
                            <a class="btn btn-danger" href="{{ route('back_galleries_delete', array($gallery->ID)) }}" title="{{ $gallery->name }}">{{ trans('w-cms-laravel::generic.delete') }}</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @else
        {{ trans('w-cms-laravel-gallery-back::galleries.no_gallery_created_yet') }}
        @endif

        <a class="btn btn-primary" href="{{ route('back_galleries_create') }}" title="{{ trans('w-cms-laravel::generic.create') }}">{{ trans('w-cms-laravel::generic.create') }}</a>
    </div>
</div>

@stop