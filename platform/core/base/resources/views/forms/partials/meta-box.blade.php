@if (Arr::get($meta_box, 'before_wrapper'))
    {!! Arr::get($meta_box, 'before_wrapper') !!}
@endif

@if (Arr::get($meta_box, 'wrap', true))
    <div class="widget meta-boxes" {{ Html::attributes(Arr::get($meta_box, 'attributes', [])) }}>
        <div class="widget-title">
            <h4>
                <span> {{ Arr::get($meta_box, 'title') }}</span>
            </h4>
        </div>
        <div class="widget-body">
            {!! Arr::get($meta_box, 'content') !!}
        </div>
    </div>
@else
    {!! Arr::get($meta_box, 'content') !!}
@endif

@if (Arr::get($meta_box, 'after_wrapper'))
    {!! Arr::get($meta_box, 'after_wrapper') !!}
@endif