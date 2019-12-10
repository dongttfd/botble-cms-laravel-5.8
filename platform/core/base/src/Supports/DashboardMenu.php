<?php

namespace Botble\Base\Supports;

use Auth;
use Botble\ACL\Models\User;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use RuntimeException;
use stdClass;
use URL;

class DashboardMenu
{
    /**
     * Get all registered links from package
     * @var array
     */
    public $links = [];

    /**
     * @var User
     */
    public $user;

    /**
     * @var string
     */
    public $url;

    /**
     * @var string
     */
    public $prefix;

    /**
     * @param User $user
     *
     * @return $this
     */
    public function init(User $user): self
    {
        $this->user = $user;
        $this->url = URL::full();
        $this->prefix = '/' . request()->route()->getPrefix();

        return $this;
    }

    /**
     * Add link
     * @param array $options
     * @return $this
     */
    public function registerItem(array $options): self
    {
        if (isset($options['children'])) {
            unset($options['children']);
        }

        $defaultOptions = [
            'id'          => null,
            'priority'    => 99,
            'parent_id'   => null,
            'name'        => null,
            'icon'        => null,
            'url'         => null,
            'children'    => [],
            'permissions' => [],
        ];
        $options = array_merge($defaultOptions, $options);
        $id = $options['id'];

        if (!$id) {
            $calledClass = isset(debug_backtrace()[1]) ?
                debug_backtrace()[1]['class'] . '@' . debug_backtrace()[1]['function']
                :
                null;
            throw new RuntimeException('Menu id not specified: ' . $calledClass);
        }

        if (isset($this->links[$id]) && !app()->runningInConsole()) {
            $calledClass = isset(debug_backtrace()[1]) ?
                debug_backtrace()[1]['class'] . '@' . debug_backtrace()[1]['function']
                :
                null;
            throw new RuntimeException('Menu id already exists: ' . $id . ' on class ' . $calledClass);
        }

        if (isset($this->links[$options['parent_id']])) {
            $permissions = array_merge($this->links[$options['parent_id']]['permissions'], $options['permissions']);
            $this->links[$options['parent_id']]['permissions'] = $permissions;
        }

        $this->links[$id] = $options;

        return $this;
    }

    /**
     * @param array|string $id
     * @return $this
     */
    public function removeItem($id): self
    {
        $id = is_array($id) ? $id : func_get_args();
        foreach ($id as $item) {
            Arr::forget($this->links, $item);
        }

        return $this;
    }

    /**
     * Get children items
     * @param null $id
     * @return Collection
     */
    public function getChildren($id = null): Collection
    {
        $children = collect([]);
        foreach ($this->links as $row) {
            if (Arr::get($row, 'permissions') && !$this->user->hasAnyPermission(Arr::get($row, 'permissions'))) {
                continue;
            }

            $child = new stdClass;
            $child->id = $row['id'];
            $child->priority = $row['priority'];
            $child->parent_id = $row['parent_id'];
            $child->name = $row['name'];
            $child->icon = $row['icon'];
            $child->url = $row['url'];
            $child->children = $row['children'];
            $child->permissions = $row['permissions'];
            $child->active = false;

            if ($child->parent_id == $id) {
                $child->children = $this->getChildren($child->id);

                $children->push($child);
            }
        }

        return $children->sortBy('priority');
    }

    /**
     * Rearrange links
     * @return Collection
     * @throws \Exception
     */
    public function getAll(): Collection
    {
        if (setting('cache_admin_menu_enable', true) && Auth::check()) {
            $cache_key = md5('cache-dashboard-menu-' . Auth::user()->getKey());
            if (!cache()->has($cache_key)) {
                $links = collect($this->getChildren())->sortBy('priority');
                cache()->forever($cache_key, $links);
            } else {
                $links = cache($cache_key);
            }
        } else {
            $links = collect($this->getChildren())->sortBy('priority');
        }

        foreach ($links as $link) {
            $link->active = $this->url == $link->url || (Str::contains($link->url, $this->prefix) && $this->prefix != '//');
            if ($link->children->isEmpty()) {
                continue;
            }

            foreach ($link->children as $sub_menu) {
                if ($this->url == $sub_menu->url || (Str::contains($sub_menu->url, $this->prefix) && $this->prefix != '//')) {
                    $sub_menu->active = true;
                    $link->active = true;
                    break;
                }
            }
        }

        return $links;
    }
}
