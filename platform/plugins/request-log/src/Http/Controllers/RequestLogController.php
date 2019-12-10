<?php

namespace Botble\RequestLog\Http\Controllers;

use Botble\Base\Events\DeletedContentEvent;
use Botble\Base\Http\Controllers\BaseController;
use Botble\Base\Http\Responses\BaseHttpResponse;
use Botble\RequestLog\Repositories\Interfaces\RequestLogInterface;
use Botble\RequestLog\Tables\RequestLogTable;
use Exception;
use Illuminate\Http\Request;

class RequestLogController extends BaseController
{

    /**
     * @var RequestLogInterface
     */
    protected $requestLogRepository;

    /**
     * RequestLogController constructor.
     * @param RequestLogInterface $requestLogRepository
     */
    public function __construct(RequestLogInterface $requestLogRepository)
    {
        $this->requestLogRepository = $requestLogRepository;
    }

    /**
     * @param BaseHttpResponse $response
     * @return BaseHttpResponse
     *
     * @throws \Throwable
     */
    public function getWidgetRequestErrors(Request $request, BaseHttpResponse $response)
    {
        $limit = $request->input('paginate', 10);
        $requests = $this->requestLogRepository->getModel()->paginate($limit);

        return $response
            ->setData(view('plugins/request-log::widgets.request-errors', compact('requests', 'limit'))->render());
    }

    /**
     * @param RequestLogTable $dataTable
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     *
     * @throws \Throwable
     */
    public function getList(RequestLogTable $dataTable)
    {
        page_title()->setTitle(trans('plugins/request-log::request-log.name'));

        return $dataTable->renderTable();
    }

    /**
     * @param Request $request
     * @param $id
     * @param BaseHttpResponse $response
     * @return BaseHttpResponse
     *
     */
    public function getDelete(Request $request, $id, BaseHttpResponse $response)
    {
        try {
            $log = $this->requestLogRepository->findById($id);
            $this->requestLogRepository->delete($log);

            event(new DeletedContentEvent(REQUEST_LOG_MODULE_SCREEN_NAME, $request, $log));

            return $response->setMessage(trans('core/base::notices.delete_success_message'));
        } catch (Exception $ex) {
            return $response
                ->setError()
                ->setMessage($ex->getMessage());
        }
    }

    /**
     * @param Request $request
     * @param BaseHttpResponse $response
     * @return BaseHttpResponse
     *
     */
    public function postDeleteMany(Request $request, BaseHttpResponse $response)
    {
        $ids = $request->input('ids');
        if (empty($ids)) {
            return $response
                ->setError()
                ->setMessage(trans('core/base::notices.no_select'));
        }

        foreach ($ids as $id) {
            $log = $this->requestLogRepository->findOrFail($id);
            $this->requestLogRepository->delete($log);
            event(new DeletedContentEvent(REQUEST_LOG_MODULE_SCREEN_NAME, $request, $log));
        }

        return $response->setMessage(trans('core/base::notices.delete_success_message'));
    }
}
