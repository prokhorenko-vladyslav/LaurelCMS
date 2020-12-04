<?php


namespace Laurel\CMS\Modules\Page\Http\Controllers;


use App\Http\Controllers\Controller;
use Laurel\CMS\Modules\Page\Http\Requests\{BrowsePages,
    CreatePage,
    DestroyPage,
    EditPage,
    ForceDestroyPage,
    ReadPage,
    RestorePage,
    StorePage,
    UpdatePage};
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Laurel\CMS\Modules\Page\Contracts\PageServiceContract;
use Laurel\CMS\Modules\Notification\Types\SuccessNotification;
use Laurel\CMS\Modules\Notification\Types\WarningNotification;
use Laurel\CMS\Modules\Page\Http\Resources\PageResource;
use Laurel\CMS\Modules\Page\Http\Resources\PagesCollection;

class PageController extends Controller
{
    protected PageServiceContract $pageService;

    public function __construct(PageServiceContract $pageService)
    {
        $this->pageService = $pageService;
    }

    public function index(BrowsePages $request)
    {
        try {
            $pages = $this->pageService->fetch($request->input('limit'));
            return serviceResponse(
                200, true, 'modules.pages.index.success',
                new PagesCollection($pages)
            )->respond();
        } catch (Exception $e) {
            return logAndSendServerError($e->getMessage());
        }
    }

    public function show(ReadPage $request)
    {

    }

    public function create(CreatePage $request)
    {

    }

    public function store(StorePage $request)
    {
        try {
            $page = $this->pageService->store(
                $request->input('title'),
                $request->input('text'),
                $request->input('attributes', []),
                $request->input('views', 0),
                $request->input('seo_title'),
                $request->input('seo_description'),
                $request->input('seo_keywords'),
                $request->input('seo_robots_txt')
            );
            return serviceResponse(
                200, true, 'modules.page.store.success',
                new PageResource($page),
                new SuccessNotification(__('modules/page.store.success', [
                    'title' => $page->title
                ]))
            )->respond();
        } catch (Exception $e) {
            return logAndSendServerError($e->getMessage());
        }
    }

    public function edit(EditPage $request, int $id)
    {
        try {
            $page = $this->pageService->find($id);
            return serviceResponse(
                200, true, 'modules.pages.edit.success',
                new PageResource($page)
            )->respond();
        } catch (Exception $e) {
            return logAndSendServerError($e->getMessage());
        }
    }

    public function update(UpdatePage $request, int $id)
    {
        try {
            $page = $this->pageService->update(
                $id,
                $request->input('title'),
                $request->input('text'),
                $request->input('attributes', []),
                $request->input('views', 0),
                $request->input('seo_title'),
                $request->input('seo_description'),
                $request->input('seo_keywords'),
                $request->input('seo_robots_txt')
            );
            return serviceResponse(
                200, true, 'modules.page.update.success',
                new PageResource($page),
                new SuccessNotification(__('modules/page.update.success', [
                    'title' => $page->title
                ]))
            )->respond();
        } catch (Exception $e) {
            return logAndSendServerError($e->getMessage());
        }
    }

    public function destroy(DestroyPage $request, int $id)
    {
        try {
            $page = $this->pageService->destroy($id);
            return serviceResponse(
                200, true, 'modules.page.destroy.success',
                [],
                new SuccessNotification(__('modules/page.destroy.success', [
                    'title' => $page->title
                ]))
            )->respond();
        } catch (ModelNotFoundException $e) {
            return serviceResponse(
                200, false, 'modules.page.destroy.fail', [],
                new WarningNotification(__('modules/page.show.not_found'))
            )->respond();
        } catch (Exception $e) {
            return logAndSendServerError($e->getMessage());
        }
    }

    public function restore(RestorePage $request, int $id)
    {
        try {
            $page = $this->pageService->restore($id);
            return serviceResponse(
                200, true, 'modules.page.restore.success',
                [],
                new SuccessNotification(__('modules/page.restore.success', [
                    'title' => $page->title
                ]))
            )->respond();
        } catch (ModelNotFoundException $e) {
            return serviceResponse(
                200, false, 'modules.page.restore.fail', [],
                new WarningNotification(__('modules/page.show.not_found_in_cart'))
            )->respond();
        } catch (Exception $e) {
            return logAndSendServerError($e->getMessage());
        }
    }

    public function forceDestroy(ForceDestroyPage $request, int $id)
    {
        try {
            $page = $this->pageService->forceDestroy($id);
            return serviceResponse(
                200, true, 'modules.page.force_destroy.success',
                [],
                new SuccessNotification(__('modules/page.force_destroy.success', [
                    'title' => $page->title
                ]))
            )->respond();
        } catch (ModelNotFoundException $e) {
            return serviceResponse(
                200, false, 'modules.page.force_destroy.fail', [],
                new WarningNotification(__('modules/page.show.not_found_in_cart'))
            )->respond();
        } catch (Exception $e) {
            return logAndSendServerError($e->getMessage());
        }
    }
}
