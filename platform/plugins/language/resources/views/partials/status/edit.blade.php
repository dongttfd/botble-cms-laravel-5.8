@if (Auth::user()->hasPermission($route . '.edit'))
    <a href="{{ Route::has($route . '.edit') ? route($route . '.edit', $related_language) : '#' }}" class="tip" title="{{ trans('plugins/language::language.edit_related') }}"><i class="fa fa-edit"></i></a>
@else
    <i class="fa fa-check text-success"></i>
@endif
