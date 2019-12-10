<?php

namespace Botble\Base\Supports;

use Assets;
use Illuminate\Support\Arr;

class Editor
{
    /**
     * Editor constructor.
     */
    public function __construct()
    {
        add_action(BASE_ACTION_ENQUEUE_SCRIPTS, [$this, 'registerAssets'], 12, 1);
    }

    /**
     * Register Editor's assets
     *
     */
    public function registerAssets()
    {
        Assets::addScriptsDirectly(
            config('core.base.general.editor.' .
                setting('rich_editor', config('core.base.general.editor.primary')) . '.js')
        )
            ->addScriptsDirectly('vendor/core/js/editor.js');
    }

    /**
     * @param $name
     * @param null $value
     * @param bool $with_short_code
     * @param array $attributes
     * @return string
     *
     * @throws \Throwable
     */
    public function render($name, $value = null, $with_short_code = false, array $attributes = [])
    {
        $attributes['class'] = Arr::get($attributes, 'class', '') .
            ' editor-' .
            setting('rich_editor', config('core.base.general.editor.primary'));

        $attributes['id'] = Arr::has($attributes, 'id') ? $attributes['id'] : $name;
        $attributes['with-short-code'] = $with_short_code;
        $attributes['rows'] = Arr::get($attributes, 'rows', 10);

        return view('core/base::elements.forms.editor', compact('name', 'value', 'attributes'))
            ->render();
    }
}
