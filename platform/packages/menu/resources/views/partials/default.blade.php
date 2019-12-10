<ul {!! $options !!}>
    @foreach ($menu_nodes as $key => $row)
        <li class="{{ $row->css_class }} @if ($row->getRelated(true)->url == Request::url()) current @endif">
            <a href="{{ $row->getRelated(true)->url }}" target="{{ $row->target }}">
                <i class='{{ trim($row->icon_font) }}'></i> <span>{{ $row->getRelated(true)->name }}</span>
            </a>
            @if ($row->hasChild())
                {!! Menu::generateMenu([
                    'slug' => $menu->slug,
                    'parent_id' => $row->id
                ]) !!}
            @endif
        </li>
    @endforeach
</ul>
