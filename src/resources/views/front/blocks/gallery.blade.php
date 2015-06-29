@if ($content)
    <ul>
        @foreach ($content->items as $item)
            @if ($item->display)
                <li @if ($item->class)class="{{ $item->class }}"@endif>
                    @if ($item->link)<a href="{{ $item->link }}">@endif
                        <b>{{ $item->title }}</b>
                        <p>{{ $item->text }}</p>

                        @if (isset($item->media))
                            <img src="{{ asset(Shortcut::get_uploads_folder() . $item->media->ID . '/' . $item->media->fileName) }}" alt="{{ $item->media->alt }}" />
                        @endif
                        @if ($item->link)</a>@endif
                </li>
            @endif
        @endforeach
    </ul>
@endif