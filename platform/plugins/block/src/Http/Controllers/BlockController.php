<?php

namespace Botble\Block\Http\Controllers;

use Botble\Base\Events\BeforeEditContentEvent;
use Botble\Base\Forms\FormBuilder;
use Botble\Base\Http\Controllers\BaseController;
use Botble\Base\Http\Responses\BaseHttpResponse;
use Botble\Block\Forms\BlockForm;
use Botble\Block\Http\Requests\BlockRequest;
use Botble\Block\Repositories\Interfaces\BlockInterface;
use Illuminate\Http\Request;
use Exception;
use Botble\Block\Tables\BlockTable;
use Auth;
use Botble\Base\Events\CreatedContentEvent;
use Botble\Base\Events\DeletedContentEvent;
use Botble\Base\Events\UpdatedContentEvent;

class BlockController extends BaseController
{
    /**
     * @var BlockInterface
     */
    protected $blockRepository;

    /**
     * BlockController constructor.
     * @param BlockInterface $blockRepository
     *
     */
    public function __construct(BlockInterface $blockRepository)
    {
        $this->blockRepository = $blockRepository;
    }

    /**
     * Display all block
     * @param BlockTable $dataTable
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     *
     * @throws \Throwable
     */
    public function getList(BlockTable $dataTable)
    {
        page_title()->setTitle(trans('plugins/block::block.menu'));

        return $dataTable->renderTable();
    }

    /**
     * Show create form
     * @param FormBuilder $formBuilder
     * @return string
     *
     */
    public function getCreate(FormBuilder $formBuilder)
    {
        page_title()->setTitle(trans('plugins/block::block.create'));

        return $formBuilder->create(BlockForm::class)->renderForm();
    }

    /**
     * Insert new Block into database
     *
     * @param BlockRequest $request
     * @return BaseHttpResponse
     *
     */
    public function postCreate(BlockRequest $request, BaseHttpResponse $response)
    {
        $block = $this->blockRepository->getModel();
        $block->fill($request->input());
        $block->user_id = Auth::user()->getKey();
        $block->alias = $this->blockRepository->createSlug($request->input('alias'), null);

        $this->blockRepository->createOrUpdate($block);

        event(new CreatedContentEvent(BLOCK_MODULE_SCREEN_NAME, $request, $block));

        return $response
            ->setPreviousUrl(route('block.list'))
            ->setNextUrl(route('block.edit', $block->id))
            ->setMessage(trans('core/base::notices.create_success_message'));
    }

    /**
     * Show edit form
     *
     * @param int $id
     * @param FormBuilder $formBuilder
     * @param Request $request
     * @return string
     *
     */
    public function getEdit($id, FormBuilder $formBuilder, Request $request)
    {
        $block = $this->blockRepository->findOrFail($id);

        event(new BeforeEditContentEvent(BLOCK_MODULE_SCREEN_NAME, $request, $block));

        page_title()->setTitle(trans('plugins/block::block.edit') . ' # ' . $id);

        return $formBuilder->create(BlockForm::class, ['model' => $block])->renderForm();
    }

    /**
     * @param int $id
     * @param BlockRequest $request
     * @return BaseHttpResponse
     *
     */
    public function postEdit($id, BlockRequest $request, BaseHttpResponse $response)
    {
        $block = $this->blockRepository->findOrFail($id);
        $block->fill($request->input());
        $block->alias = $this->blockRepository->createSlug($request->input('alias'), $id);

        $this->blockRepository->createOrUpdate($block);

        event(new UpdatedContentEvent(BLOCK_MODULE_SCREEN_NAME, $request, $block));

        return $response
            ->setPreviousUrl(route('block.list'))
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
            $block = $this->blockRepository->findOrFail($id);
            $this->blockRepository->delete($block);
            event(new DeletedContentEvent(BLOCK_MODULE_SCREEN_NAME, $request, $block));

            return $response->setMessage(trans('core/base::notices.delete_success_message'));
        } catch (Exception $exception) {
            return $response
                ->setError()
                ->setMessage(trans('core/base::notices.cannot_delete'));
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
            $block = $this->blockRepository->findOrFail($id);
            $this->blockRepository->delete($block);
            event(new DeletedContentEvent(BLOCK_MODULE_SCREEN_NAME, $request, $block));
        }

        return $response->setMessage(trans('core/base::notices.delete_success_message'));
    }
}
