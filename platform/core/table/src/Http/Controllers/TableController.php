<?php

namespace Botble\Table\Http\Controllers;

use App\Http\Controllers\Controller;
use Botble\Base\Http\Responses\BaseHttpResponse;
use Botble\Table\Http\Requests\BulkChangeRequest;
use Botble\Table\Http\Requests\FilterRequest;
use Botble\Table\TableBuilder;
use Exception;
use Form;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Validator;

class TableController extends Controller
{

    /**
     * @var TableBuilder
     */
    protected $tableBuilder;

    /**
     * TableController constructor.
     * @param TableBuilder $tableBuilder
     */
    public function __construct(TableBuilder $tableBuilder)
    {
        $this->tableBuilder = $tableBuilder;
    }

    /**
     * @param BulkChangeRequest $request
     * @param TableBuilder $tableBuilder
     * @return array|mixed
     * @throws \Throwable
     *
     */
    public function getDataForBulkChanges(BulkChangeRequest $request, TableBuilder $tableBuilder)
    {
        $object = $tableBuilder->create($request->input('class'));

        $data = $object->getValueInput(null, null, 'text');
        if (!$request->input('key')) {
            return $data;
        }

        $column = Arr::get($object->getBulkChanges(), $request->input('key'), null);
        if (empty($column)) {
            return $data;
        }

        $label_class = 'control-label';
        if (!empty($column) && Str::contains(Arr::get($column, 'validate'), 'required')) {
            $label_class .= ' required';
        }

        $label = '';
        if (!empty($column['title'])) {
            $label = Form::label($column['title'], null, ['class' => $label_class])->toHtml();
        }

        if (isset($column['callback']) && method_exists($object, $column['callback'])) {
            $data = $object->getValueInput(
                $column['title'],
                null,
                $column['type'],
                call_user_func([$object, $column['callback']])
            );
        } else {
            $data = $object->getValueInput($column['title'], null, $column['type'], Arr::get($column, 'choices', []));
        }

        $data['html'] = $label . $data['html'];

        return $data;
    }

    /**
     * @param Request $request
     * @param BaseHttpResponse $response
     * @return BaseHttpResponse
     */
    public function postSaveBulkChange(Request $request, BaseHttpResponse $response)
    {
        $ids = $request->input('ids');
        if (empty($ids)) {
            return $response
                ->setError()
                ->setMessage(trans('core/table::general.please_select_record'));
        }

        $input_key = $request->input('key');
        $input_value = $request->input('value');

        $object = $this->tableBuilder->create($request->input('class'));
        $columns = $object->getBulkChanges();

        if (!empty($columns[$input_key]['validate'])) {
            $validator = Validator::make($request->input(), [
                'value' => $columns[$input_key]['validate'],
            ]);

            if ($validator->fails()) {
                return $response
                    ->setError()
                    ->setMessage($validator->messages()->first());
            }
        }

        try {
            $object->saveBulkChanges($ids, $input_key, $input_value);
        } catch (Exception $exception) {
            return $response
                ->setError()
                ->setMessage($exception->getMessage());
        }

        return $response->setMessage(trans('core/table::general.save_bulk_change_success'));
    }

    /**
     * @param FilterRequest $request
     * @return array|mixed
     * @throws \Throwable
     */
    public function getFilterInput(FilterRequest $request, TableBuilder $tableBuilder)
    {
        $object = $tableBuilder->create($request->input('class'));

        $data = $object->getValueInput(null, null, 'text');
        if (!$request->input('key')) {
            return $data;
        }

        $column = Arr::get($object->getBulkChanges(), $request->input('key'), null);
        if (empty($column)) {
            return $data;
        }

        if (isset($column['callback']) && method_exists($object, $column['callback'])) {
            return $object->getValueInput(
                null,
                $request->input('value'),
                $column['type'],
                call_user_func([$object, $column['callback']])
            );
        }

        return $object->getValueInput(
            null,
            $request->input('value'),
            $column['type'],
            Arr::get($column, 'choices', [])
        );
    }
}