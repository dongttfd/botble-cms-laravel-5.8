<?php

namespace Botble\CustomField\Providers;

use Assets;
use Auth;
use Botble\ACL\Repositories\Interfaces\RoleInterface;
use Botble\Blog\Repositories\Interfaces\PostInterface;
use Botble\CustomField\Facades\CustomFieldSupportFacade;
use Illuminate\Support\ServiceProvider;

class HookServiceProvider extends ServiceProvider
{
    /**
     * @var \Illuminate\Foundation\Application
     */
    protected $app;

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        add_action(BASE_ACTION_META_BOXES, [$this, 'handle'], 125, 3);
    }

    /**
     * @param string $location
     * @param string $screenName
     * @param \Eloquent $object
     * @throws \Throwable
     */
    public function handle($screenName, $priority, $object = null)
    {
        if ($screenName !== CUSTOM_FIELD_MODULE_SCREEN_NAME && $priority == 'advanced') {
            Assets::addStylesDirectly([
                'vendor/core/plugins/custom-field/css/custom-field.css',
            ])
                ->addScriptsDirectly(config('core.base.general.editor.ckeditor.js'))
                ->addScriptsDirectly([
                    'vendor/core/plugins/custom-field/js/use-custom-fields.js',
                ])
                ->addScripts(['jquery-ui']);

            /**
             * Every models will have these rules by default
             */
            if (Auth::check()) {
                add_custom_fields_rules_to_check([
                    'logged_in_user'          => Auth::user()->getKey(),
                    'logged_in_user_has_role' => $this->app->make(RoleInterface::class)->pluck('id'),
                ]);
            }

            if (defined('PAGE_MODULE_SCREEN_NAME')) {
                switch ($screenName) {
                    case PAGE_MODULE_SCREEN_NAME:
                        add_custom_fields_rules_to_check([
                            'page_template' => isset($object->template) ? $object->template : '',
                            'page'          => isset($object->id) ? $object->id : '',
                            'model_name'    => PAGE_MODULE_SCREEN_NAME,
                        ]);
                        break;
                }
            }

            if (defined('POST_MODULE_SCREEN_NAME')) {
                switch ($screenName) {
                    case CATEGORY_MODULE_SCREEN_NAME:
                        add_custom_fields_rules_to_check([
                            CATEGORY_MODULE_SCREEN_NAME => isset($object->id) ? $object->id : null,
                            'model_name'                => CATEGORY_MODULE_SCREEN_NAME,
                        ]);
                        break;
                    case POST_MODULE_SCREEN_NAME:
                        add_custom_fields_rules_to_check([
                            'model_name' => POST_MODULE_SCREEN_NAME,
                        ]);
                        if ($object) {
                            $relatedCategoryIds = $this->app->make(PostInterface::class)->getRelatedCategoryIds($object);
                            add_custom_fields_rules_to_check([
                                POST_MODULE_SCREEN_NAME . '.post_with_related_category' => $relatedCategoryIds,
                                POST_MODULE_SCREEN_NAME . '.post_format'                => $object->format_type,
                            ]);
                        }
                        break;
                }
            }

            echo $this->render($screenName, isset($object->id) ? $object->id : null);
        }
    }

    /**
     * @param $screenName
     * @param $id
     * @throws \Throwable
     */
    protected function render($screenName, $id)
    {
        $customFieldBoxes = get_custom_field_boxes($screenName, $id);

        if (!$customFieldBoxes) {
            return null;
        }

        CustomFieldSupportFacade::renderAssets();

        return CustomFieldSupportFacade::renderCustomFieldBoxes($customFieldBoxes);
    }
}
