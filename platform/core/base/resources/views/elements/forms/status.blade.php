<div class="widget meta-boxes">
    <div class="widget-title">
        <h4><span class="required">{{ trans('core/base::tables.status') }}</span></h4>
    </div>
    <div class="widget-body">
        <div class="ui-select-wrapper">
            {!! Form::select(isset($name) ? $name : 'status', isset($values) ? $values : [1 => trans('core/base::system.activated'), 0 => trans('core/base::system.deactivated')], isset($selected) ? $selected : old(isset($name) ? $name : 'status', 1), ['class' => 'ui-select']) !!}
            <svg class="svg-next-icon svg-next-icon-size-16">
                <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#select-chevron"></use>
            </svg>
        </div>
    </div>
</div>