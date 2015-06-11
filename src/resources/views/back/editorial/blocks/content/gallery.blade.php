<div class="form-group">
    <label>{{ trans('w-cms-laravel-gallery-back::galleries.gallery_block') }}</label>
    <select name="gallery_id" class="gallery_id form-control" autocomplete="off" name="gallery_id">
        <option value="">{{ trans('w-cms-laravel-gallery-back::galleries.choose_gallery') }}</option>
        @if (isset($galleries))
            @foreach ($galleries as $gallery)
                <option value="{{ $gallery->ID }}" @if ($block->gallery_id == $gallery->ID) selected="selected" @endif>{{ $gallery->name }}</option>
            @endforeach
        @endif
    </select>
</div>