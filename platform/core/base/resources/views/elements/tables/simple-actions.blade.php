<div class="table-actions">
    @foreach($actions as $action)
        <a {!! Html::attributes(Arr::get($action, 'attributes', [])) !!}>{{ $action['name'] }}</a>
    @endforeach
</div>