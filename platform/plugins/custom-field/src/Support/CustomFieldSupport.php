<?php

namespace Botble\CustomField\Support;

use Botble\Base\Enums\BaseStatusEnum;
use Botble\CustomField\Repositories\Interfaces\CustomFieldInterface;
use Botble\CustomField\Repositories\Interfaces\FieldGroupInterface;
use Botble\CustomField\Repositories\Interfaces\FieldItemInterface;
use Closure;
use Exception;
use Illuminate\Http\Request;

class CustomFieldSupport
{
    /**
     * @var array
     */
    protected $ruleGroups = [
        'basic' => [
            'items' => [

            ],
        ],
        'other' => [
            'items' => [

            ],
        ],
    ];

    /**
     * @var array|string
     */
    protected $rules = [];

    /**
     * @var \Illuminate\Foundation\Application|mixed
     */
    protected $app;

    /**
     * @var FieldGroupInterface
     */
    protected $fieldGroupRepository;

    /**
     * @var CustomFieldInterface
     */
    protected $customFieldRepository;

    /**
     * @var FieldItemInterface
     */
    protected $fieldItemRepository;

    /**
     * @var bool
     */
    protected $isRenderedAssets = false;

    /**
     * CustomFieldSupport constructor.
     */
    public function __construct()
    {
        $this->app = app();
        $this->fieldGroupRepository = $this->app->make(FieldGroupInterface::class);
        $this->customFieldRepository = $this->app->make(CustomFieldInterface::class);
        $this->fieldItemRepository = $this->app->make(FieldItemInterface::class);
    }

    /**
     * @param $groupName
     * @return $this
     */
    public function registerRuleGroup($groupName)
    {
        $this->ruleGroups[$groupName] = [
            'items' => [],
        ];
        return $this;
    }

    /**
     * @param $groupName
     * @return $this
     */
    public function expandRuleGroup($groupName)
    {
        if (!isset($this->ruleGroups[$groupName])) {
            return $this->registerRuleGroup($groupName);
        }

        return $this;
    }

    /**
     * @param string $group
     * @param string $title
     * @param string $slug
     * @param Closure|array $data
     * @return $this
     */
    public function registerRule($group, $title, $slug, $data)
    {
        if (!isset($this->ruleGroups[$group])) {
            $this->registerRuleGroup($group);
        }

        $this->ruleGroups[$group]['items'][$slug] = [
            'title' => $title,
            'slug'  => $slug,
            'data'  => [],
        ];

        if (!is_array($data)) {
            $data = [$data];
        }

        $this->ruleGroups[$group]['items'][$slug]['data'] = $data;

        return $this;
    }

    /**
     * @param string $group
     * @param string $title
     * @param string $slug
     * @param Closure|array $data
     * @return $this
     */
    public function expandRule($group, $title, $slug, $data)
    {
        if (!isset($this->ruleGroups[$group]['items'][$slug]['data']) || !$this->ruleGroups[$group]['items'][$slug]['data']) {
            return $this->registerRule($group, $title, $slug, $data);
        }

        if (!is_array($data)) {
            $data = [$data];
        }

        $this->ruleGroups[$group]['items'][$slug]['data'] = array_merge($this->ruleGroups[$group]['items'][$slug]['data'], $data);

        return $this;
    }

    /**
     * Resolve all rule data from closure into array
     * @return array
     */
    protected function resolveGroups()
    {
        foreach ($this->ruleGroups as &$group) {
            foreach ($group['items'] as &$item) {
                $data = [];

                foreach ($item['data'] as $datum) {
                    if ($datum instanceof Closure) {
                        $resolvedClosure = call_user_func($datum);
                        if (is_array($resolvedClosure)) {
                            foreach ($resolvedClosure as $key => $value) {
                                $data[$key] = $value;
                            }
                        }
                    } elseif (is_array($datum)) {
                        foreach ($datum as $key => $value) {
                            $data[$key] = $value;
                        }
                    }
                }

                $item['data'] = $data;
            }
        }

        return $this->ruleGroups;
    }

    /**
     * @param array|string $rules
     * @return $this
     */
    public function setRules($rules)
    {
        if (!is_array($rules)) {
            $this->rules = json_decode($rules, true);
        } else {
            $this->rules = $rules;
        }
        return $this;
    }

    /**
     * @param string|array $ruleName
     * @param $value
     * @return $this
     */
    public function addRule($ruleName, $value = null)
    {
        if (is_array($ruleName)) {
            $rules = $ruleName;
        } else {
            $rules = [$ruleName => $value];
        }
        $this->rules = array_merge($this->rules, $rules);

        return $this;
    }

    /**
     * @param array $ruleGroups
     * @return bool
     */
    protected function checkRules(array $ruleGroups)
    {
        if (!$ruleGroups) {
            return false;
        }
        foreach ($ruleGroups as $group) {
            if ($this->checkEachRule($group)) {
                return true;
            }
        }
        return false;
    }

    /**
     * @param array $ruleGroup
     * @return bool
     */
    protected function checkEachRule(array $ruleGroup)
    {
        foreach ($ruleGroup as $ruleGroupItem) {
            if (!isset($this->rules[$ruleGroupItem['name']])) {
                return false;
            }
            if ($ruleGroupItem['type'] == '==') {
                if (is_array($this->rules[$ruleGroupItem['name']])) {
                    $result = in_array($ruleGroupItem['value'], $this->rules[$ruleGroupItem['name']]);
                } else {
                    $result = $ruleGroupItem['value'] == $this->rules[$ruleGroupItem['name']];
                }
            } else {
                if (is_array($this->rules[$ruleGroupItem['name']])) {
                    $result = !in_array($ruleGroupItem['value'], $this->rules[$ruleGroupItem['name']]);
                } else {
                    $result = $ruleGroupItem['value'] != $this->rules[$ruleGroupItem['name']];
                }
            }
            if (!$result) {
                return false;
            }
        }
        return true;
    }

    /**
     * @param $morphClass
     * @param $morphId
     * @return array
     */
    public function exportCustomFieldsData($morphClass, $morphId)
    {
        $fieldGroups = $this->fieldGroupRepository->getFieldGroups([
            'status' => BaseStatusEnum::PUBLISHED,
        ]);

        $result = [];

        foreach ($fieldGroups as $row) {
            if ($this->checkRules(json_decode($row->rules, true))) {
                $result[] = [
                    'id'    => $row->id,
                    'title' => $row->title,
                    'items' => $this->fieldGroupRepository->getFieldGroupItems($row->id, null, true, $morphClass, $morphId),
                ];
            }
        }

        return $result;
    }

    /**
     * Render data
     * @return string
     * @throws \Throwable
     */
    public function renderRules()
    {
        return view('plugins/custom-field::_script-templates.rules', [
            'ruleGroups' => $this->resolveGroups(),
        ])->render();
    }

    /**
     * @param array $boxes
     * @return string
     * @throws \Throwable
     */
    public function renderCustomFieldBoxes(array $boxes)
    {
        return view('plugins/custom-field::custom-fields-boxes-renderer', [
            'customFieldBoxes' => json_encode($boxes),
        ])->render();
    }

    /**
     * Echo the custom fields assets
     * @throws \Throwable
     */
    public function renderAssets()
    {
        if (!$this->isRenderedAssets) {
            echo view('plugins/custom-field::_script-templates.render-custom-fields')->render();
            $this->isRenderedAssets = true;
        }
    }

    /**
     * @param $screenName
     * @param \Illuminate\Http\Request $request
     * @param $data
     */
    public function saveCustomFields($screenName, Request $request, $data)
    {
        $rows = $this->parseRawData($request->input('custom_fields', []));
        foreach ($rows as $row) {
            $this->saveCustomField($screenName, $data->id, $row);
        }
    }

    /**
     * @param $screen
     * @param $id
     * @param array $data
     */
    protected function saveCustomField($screen, $id, array $data)
    {
        $currentMeta = $this->customFieldRepository->getFirstBy([
            'field_item_id' => $data['id'],
            'slug'          => $data['slug'],
            'use_for'       => $screen,
            'use_for_id'    => $id,
        ]);

        $value = $this->parseFieldValue($data);

        if (!is_string($value)) {
            $value = json_encode($value);
        }

        $data['value'] = $value;

        if ($currentMeta) {
            $this->customFieldRepository->createOrUpdate($data, ['id' => $currentMeta->id]);
        } else {
            $data['use_for'] = $screen;
            $data['use_for_id'] = $id;
            $data['field_item_id'] = $data['id'];

            $this->customFieldRepository->create($data);
        }
    }

    /**
     * Get field value
     * @param $field
     * @return array|string
     */
    protected function parseFieldValue($field)
    {
        $value = [];
        switch ($field['type']) {
            case 'repeater':
                if (!isset($field['value'])) {
                    break;
                }

                foreach ($field['value'] as $row) {
                    $groups = [];
                    foreach ($row as $item) {
                        $groups[] = [
                            'field_item_id' => $item['id'],
                            'type'          => $item['type'],
                            'slug'          => $item['slug'],
                            'value'         => $this->parseFieldValue($item),
                        ];
                    }
                    $value[] = $groups;
                }
                break;
            case 'checkbox':
                $value = isset($field['value']) ? (array)$field['value'] : [];
                break;
            default:
                $value = isset($field['value']) ? $field['value'] : '';
                break;
        }
        return $value;
    }

    /**
     * @param $jsonString
     * @return array
     */
    protected function parseRawData($jsonString)
    {
        try {
            $fieldGroups = json_decode($jsonString, true) ?: [];
        } catch (Exception $exception) {
            return [];
        }

        $result = [];
        foreach ($fieldGroups as $fieldGroup) {
            foreach ($fieldGroup['items'] as $item) {
                $result[] = $item;
            }
        }
        return $result;
    }

    /**
     * @param string $screen
     * @param \Eloquent|false $data
     */
    public function deleteCustomFields($screen, $data)
    {
        if ($data != false) {
            $this->customFieldRepository->deleteBy([
                'use_for'    => $screen,
                'use_for_id' => $data->id,
            ]);
        }
        return false;
    }
}
