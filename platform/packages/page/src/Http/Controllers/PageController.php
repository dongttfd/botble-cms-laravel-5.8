<?php

namespace Botble\Page\Http\Controllers;

use Auth;
use Botble\Base\Events\BeforeEditContentEvent;
use Botble\Base\Events\CreatedContentEvent;
use Botble\Base\Events\DeletedContentEvent;
use Botble\Base\Events\UpdatedContentEvent;
use Botble\Base\Http\Controllers\BaseController;
use Botble\Base\Http\Responses\BaseHttpResponse;
use Botble\Page\Forms\PageForm;
use Botble\Page\Tables\PageTable;
use Botble\Page\Http\Requests\PageRequest;
use Botble\Page\Repositories\Interfaces\PageInterface;
use Exception;
use Illuminate\Http\Request;
use Botble\Base\Forms\FormBuilder;

class PageController extends BaseController
{

    /**
     * @var PageInterface
     */
    protected $pageRepository;

    /**
     * PageController constructor.
     * @param PageInterface $pageRepository
     *
     */
    public function __construct(PageInterface $pageRepository)
    {
        $this->pageRepository = $pageRepository;
    }

    /**
     * @param PageTable $dataTable
     * @return \Illuminate\Http\JsonResponse|\Illuminate\View\View
     *
     * @throws \Throwable
     */
    public function getList(PageTable $dataTable)
    {
        page_title()->setTitle(trans('packages/page::pages.menu_name'));

        return $dataTable->renderTable();
    }

    /**
     * @return string
     *
     */
    public function getCreate(FormBuilder $formBuilder)
    {
        page_title()->setTitle(trans('packages/page::pages.create'));

        return $formBuilder->create(PageForm::class)->renderForm();
    }

    /**
     * @param PageRequest $request
     * @param BaseHttpResponse $response
     * @return BaseHttpResponse
     *
     */
    public function postCreate(PageRequest $request, BaseHttpResponse $response)
    {
        $page = $this->pageRepository->createOrUpdate(array_merge($request->input(), [
            'user_id'  => Auth::user()->getKey(),
            'is_featured' => $request->input('is_featured', false),
        ]));

        event(new CreatedContentEvent(PAGE_MODULE_SCREEN_NAME, $request, $page));

        return $response->setPreviousUrl(route('pages.list'))
            ->setNextUrl(route('pages.edit', $page->id))
            ->setMessage(trans('core/base::notices.create_success_message'));
    }

    /**
     * @param $id
     * @return string
     *
     */
    public function getEdit($id, FormBuilder $formBuilder)
    {
        $page = $this->pageRepository->findOrFail($id);

        page_title()->setTitle(trans('packages/page::pages.edit') . ' "' . $page->name . '"');

        event(new BeforeEditContentEvent(PAGE_MODULE_SCREEN_NAME, request(), $page));

        return $formBuilder->create(PageForm::class, ['model' => $page])->renderForm();
    }

    /**
     * @param $id
     * @param PageRequest $request
     * @param BaseHttpResponse $response
     * @return BaseHttpResponse
     *
     */
    public function postEdit($id, PageRequest $request, BaseHttpResponse $response)
    {
        $page = $this->pageRepository->findOrFail($id);
        $page->fill($request->input());
        $page->is_featured = $request->input('is_featured', false);

        $page = $this->pageRepository->createOrUpdate($page);

        event(new UpdatedContentEvent(PAGE_MODULE_SCREEN_NAME, $request, $page));

        return $response->setPreviousUrl(route('pages.list'))
            ->setMessage(trans('core/base::notices.update_success_message'));
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
            $page = $this->pageRepository->findOrFail($id);
            $this->pageRepository->delete($page);

            event(new DeletedContentEvent(PAGE_MODULE_SCREEN_NAME, $request, $page));

            return $response->setMessage(trans('packages/page::pages.deleted'));
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
            $page = $this->pageRepository->findOrFail($id);
            $this->pageRepository->delete($page);

            event(new DeletedContentEvent(PAGE_MODULE_SCREEN_NAME, $request, $page));
        }

        return $response->setMessage(trans('packages/page::pages.deleted'));
    }
}
