<ul {!! $options !!}>
    @foreach ($menu_nodes as $key => $row)
    <li class="menu-item @if ($row->hasChild()) menu-item-has-children dropdown @endif {{ $row->css_class }} @if ($row->getRelated()->url == Request::url()) active @endif">
        <a href="{{ $row->getRelated()->url }}" target="{{ $row->target }}">
            @if ($row->icon_font)<i class='{{ trim($row->icon_font) }}'></i> @endif{{ $row->getRelated()->name }}
        </a>
        @if ($row->hasChild())
            {!!
                Menu::generateMenu([
                    'slug' => $menu->slug,
                    'view' => 'main-menu',
                    'options' => ['class' => 'dropdown-menu'],
                    'parent_id' => $row->id,
                ])
            !!}
        @endif
    </li>
    @endforeach
</ul>
