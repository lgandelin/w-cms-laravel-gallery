@if ($content)
    <ul>
        @foreach ($content->items as $item)
            <li @if ($item->class)class="{{ $item->class }}"@endif>
            @if ($item->display)
                @if ($item->link)<a href="{{ $item->link }}">@endif
                    <b>{{ $item->title }}</b>
                    <p>{{ $item->text }}</p>

                    @if (isset($item->media))
                        <img src="{{ asset(Shortcut::get_uploads_folder() . $item->media->ID . '/' . $item->media->file_name) }}" alt="{{ $item->media->alt }}" style="display: block; max-width: 100%; height: auto" />
                    @endif
                    @if ($item->link)</a>@endif
                @endif
            </li>
        @endforeach
    </ul>
@endif