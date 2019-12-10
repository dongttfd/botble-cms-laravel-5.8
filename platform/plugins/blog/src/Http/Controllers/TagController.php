<?php

namespace Botble\Blog\Http\Controllers;

use Botble\Base\Events\BeforeEditContentEvent;
use Botble\Base\Forms\FormBuilder;
use Botble\Base\Http\Controllers\BaseController;
use Botble\Base\Http\Responses\BaseHttpResponse;
use Botble\Blog\Forms\TagForm;
use Botble\Blog\Tables\TagTable;
use Botble\Blog\Http\Requests\TagRequest;
use Botble\Blog\Repositories\Interfaces\TagInterface;
use Exception;
use Illuminate\Http\Request;
use Auth;
use Botble\Base\Events\CreatedContentEvent;
use Botble\Base\Events\DeletedContentEvent;
use Botble\Base\Events\UpdatedContentEvent;

class TagController extends BaseController
{

    /**
     * @var TagInterface
     */
    protected $tagRepository;

    /**
     * @param TagInterface $tagRepository
     */
    public function __construct(TagInterface $tagRepository)
    {
        $this->tagRepository = $tagRepository;
    }

    /**
     * @param TagTable $dataTable
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     *
     * @throws \Throwable
     */
    public function getList(TagTable $dataTable)
    {
        page_title()->setTitle(trans('plugins/blog::tags.menu'));

        return $dataTable->renderTable();
    }

    /**
     * @return string
     *
     */
    public function getCreate(FormBuilder $formBuilder)
    {
        page_title()->setTitle(trans('plugins/blog::tags.create'));

        return $formBuilder->create(TagForm::class)->renderForm();
    }

    /**
     * @param TagRequest $request
     * @param BaseHttpResponse $response
     * @return BaseHttpResponse
     *
     */
    public function postCreate(TagRequest $request, BaseHttpResponse $response)
    {
        $tag = $this->tagRepository->createOrUpdate(array_merge($request->input(),
            ['author_id' => Auth::user()->getKey()]));
        event(new CreatedContentEvent(TAG_MODULE_SCREEN_NAME, $request, $tag));

        return $response
            ->setPreviousUrl(route('tags.list'))
            ->setNextUrl(route('tags.edit', $tag->id))
            ->setMessage(trans('core/base::notices.create_success_message'));
    }

    /**
     * @param int $id
     * @param Request $request
     * @param FormBuilder $formBuilder
     * @return string
     *
     */
    public function getEdit($id, Request $request, FormBuilder $formBuilder)
    {
        $tag = $this->tagRepository->findOrFail($id);

        event(new BeforeEditContentEvent(TAG_MODULE_SCREEN_NAME, $request, $tag));

        page_title()->setTitle(trans('plugins/blog::tags.edit') . ' "' . $tag->name . '"');

        return $formBuilder->create(TagForm::class, ['model' => $tag])->renderForm();
    }

    /**
     * @param int $id
     * @param TagRequest $request
     * @param BaseHttpResponse $response
     * @return BaseHttpResponse
     *
     */
    public function postEdit($id, TagRequest $request, BaseHttpResponse $response)
    {
        $tag = $this->tagRepository->findOrFail($id);
        $tag->fill($request->input());

        $this->tagRepository->createOrUpdate($tag);
        event(new UpdatedContentEvent(TAG_MODULE_SCREEN_NAME, $request, $tag));

        return $response
            ->setPreviousUrl(route('tags.list'))
            ->setMessage(trans('core/base::notices.update_success_message'));
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
            $tag = $this->tagRepository->findOrFail($id);
            $this->tagRepository->delete($tag);

            event(new DeletedContentEvent(TAG_MODULE_SCREEN_NAME, $request, $tag));

            return $response->setMessage(trans('plugins/blog::tags.deleted'));
        } catch (Exception $exception) {
            return $response
                ->setError()
                ->setMessage(trans('plugins/blog::tags.cannot_delete'));
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
                ->setMessage(trans('plugins/blog::tags.notices.no_select'));
        }

        foreach ($ids as $id) {
            $tag = $this->tagRepository->findOrFail($id);
            $this->tagRepository->delete($tag);

            event(new DeletedContentEvent(TAG_MODULE_SCREEN_NAME, $request, $tag));
        }

        return $response
            ->setMessage(trans('plugins/blog::tags.deleted'));
    }

    /**
     * Get list tags in db
     *
     * @return mixed
     *
     */
    public function getAllTags()
    {
        return $this->tagRepository->pluck('name');
    }
}
