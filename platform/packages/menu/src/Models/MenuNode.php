<?php

namespace Botble\Menu\Models;

use DB;
use Eloquent;
use Illuminate\Support\Arr;
use Route;
use stdClass;

class MenuNode extends Eloquent
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'menu_nodes';

    /**
     * @var array
     */
    protected $fillable = [
        'menu_id',
        'parent_id',
        'related_id',
        'type',
        'url',
        'icon_font',
        'title',
        'css_class',
        'target',
        'has_child',
    ];

    /**
     * @return mixed
     *
     */
    public function parent()
    {
        return $this->belongsTo(MenuNode::class, 'parent_id');
    }

    /**
     * @return mixed
     *
     */
    public function child()
    {
        return $this->hasMany(MenuNode::class, 'parent_id');
    }

    /**
     * @return mixed
     *
     */
    public function getRelated()
    {
        $item = new stdClass;
        $item->name = $this->title;
        $item->url = $this->url ? url($this->url) : url('/');

        if ($this->type != 'custom-link') {
            if ($this->key != null) {
                $item->url = route('public.single', $this->key);
            } elseif (Arr::has(\Menu::getRelatedRouteNames(), $this->type)) {
                $related = Arr::get(\Menu::getRelatedRouteNames(), $this->type);
                if (Route::has($related['route'])) {
                    $related_item = DB::table($related['table'])->find($this->related_id);
                    if ($related_item && property_exists($related_item, 'slug')) {
                        $item->url = route($related['route'], $related_item->slug);
                    }
                }
            }
        }

        return $item;
    }

    /**
     * @return bool
     *
     */
    public function hasChild()
    {
        return $this->has_child == 1;
    }
}
