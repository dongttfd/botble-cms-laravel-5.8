<?php

namespace Botble\AuditLog\Http\Controllers;

use Botble\AuditLog\Repositories\Interfaces\AuditLogInterface;
use Botble\AuditLog\Tables\AuditLogTable;
use Botble\Base\Events\DeletedContentEvent;
use Botble\Base\Http\Controllers\BaseController;
use Botble\Base\Http\Responses\BaseHttpResponse;
use Exception;
use Illuminate\Http\Request;

class AuditLogController extends BaseController
{

    /**
     * @var AuditLogInterface
     */
    protected $auditLogRepository;

    /**
     * AuditLogController constructor.
     * @param AuditLogInterface $auditLogRepository
     */
    public function __construct(AuditLogInterface $auditLogRepository)
    {
        $this->auditLogRepository = $auditLogRepository;
    }

    /**
     * @param BaseHttpResponse $response
     * @return BaseHttpResponse
     *
     * @throws \Throwable
     */
    public function getWidgetActivities(BaseHttpResponse $response)
    {
        $limit = request()->input('paginate', 10);
        $histories = $this->auditLogRepository
            ->getModel()
            ->with('user')
            ->orderBy('created_at', 'desc')
            ->paginate($limit);

        return $response
            ->setData(view('plugins/audit-log::widgets.activities', compact('histories', 'limit'))->render());
    }

    /**
     * @param AuditLogTable $dataTable
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     *
     * @throws \Throwable
     */
    public function getList(AuditLogTable $dataTable)
    {
        page_title()->setTitle(trans('plugins/audit-log::history.name'));

        return $dataTable->renderTable();
    }

    /**
     * @param Request $request
     * @param int $id
     * @param BaseHttpResponse $response
     * @return BaseHttpResponse
     *
     */
    public function getDelete(Request $request, $id, BaseHttpResponse $response)
    {
        try {
            $log = $this->auditLogRepository->findById($id);
            $this->auditLogRepository->delete($log);

            event(new DeletedContentEvent(AUDIT_LOG_MODULE_SCREEN_NAME, $request, $log));

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
     * @throws Exception
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
            $log = $this->auditLogRepository->findOrFail($id);
            $this->auditLogRepository->delete($log);
            event(new DeletedContentEvent(AUDIT_LOG_MODULE_SCREEN_NAME, $request, $log));
        }

        return $response->setMessage(trans('core/base::notices.delete_success_message'));
    }
}
