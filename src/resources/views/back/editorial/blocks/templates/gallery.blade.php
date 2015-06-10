<div id="block-template-gallery">
    <div class="form-group">
        <label>{{ trans('w-cms-laravel::pages.block_gallery') }}</label>
        <select name="gallery_id" class="gallery_id form-control" autocomplete="off">
            <option value="">{{ trans('w-cms-laravel::pages.choose_gallery') }}</option>
            @if (isset($galleries))
                @foreach ($galleries as $gallery)
                    <option value="{{ $gallery->ID }}">{{ $gallery->name }}</option>
                @endforeach
            @endif
        </select>
    </div>
</div>