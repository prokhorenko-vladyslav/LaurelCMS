<?php


namespace Laurel\CMS\Modules\Rubric\Http\Controllers;


use App\Http\Controllers\Controller;
use Laurel\CMS\Modules\Rubric\Http\Requests\{
    BrowseRubrics,
    CreateRubric,
    DestroyRubric,
    EditRubric,
    ForceDestroyRubric,
    ReadRubric,
    RestoreRubric,
    StoreRubric,
    UpdateRubric
};
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Laurel\CMS\Modules\Notification\Types\SuccessNotification;
use Laurel\CMS\Modules\Notification\Types\WarningNotification;
use Laurel\CMS\Modules\Rubric\Http\Resources\RubricResource;
use Laurel\CMS\Modules\Rubric\Http\Resources\RubricsCollection;
use Laurel\CMS\Modules\Rubric\Contracts\RubricServiceContract;

class RubricController extends Controller
{
    protected RubricServiceContract $rubricService;

    public function __construct(RubricServiceContract $rubricService)
    {
        $this->rubricService = $rubricService;
    }

    public function index(BrowseRubrics $request)
    {
        try {
            $rubrics = $this->rubricService->fetch($request->input('limit'));
            return serviceResponse(
                200, true, 'modules.rubrics.index.success',
                new RubricsCollection($rubrics)
            )->respond();
        } catch (Exception $e) {
            return logAndSendServerError($e->getMessage());
        }
    }

    public function show(ReadRubric $request)
    {

    }

    public function create(CreateRubric $request)
    {

    }

    public function store(StoreRubric $request)
    {
        try {
            $rubric = $this->rubricService->store(
                $request->input('title'),
                $request->input('text'),
                $request->input('attributes', []),
                $request->input('views', 0),
                $request->input('seoTitle'),
                $request->input('seoDescription'),
                $request->input('seoKeywords'),
                $request->input('seoRobotsTxt')
            );
            return serviceResponse(
                200, true, 'modules.rubric.store.success',
                [
                    'rubric' => new RubricResource($rubric)
                ],
                new SuccessNotification(__('modules/rubric.store.success', [
                    'title' => $rubric->title
                ]))
            )->respond();
        } catch (Exception $e) {
            return logAndSendServerError($e->getMessage());
        }
    }

    public function edit(EditRubric $request)
    {

    }

    public function update(UpdateRubric $request, int $id)
    {
        try {
            $rubric = $this->rubricService->update(
                $id,
                $request->input('title'),
                $request->input('text'),
                $request->input('attributes', []),
                $request->input('views', 0),
                $request->input('seoTitle'),
                $request->input('seoDescription'),
                $request->input('seoKeywords'),
                $request->input('seoRobotsTxt')
            );
            return serviceResponse(
                200, true, 'modules.page.update.success',
                [
                    'rubric' => new RubricResource($rubric)
                ],
                new SuccessNotification(__('modules/page.update.success', [
                    'title' => $rubric->title
                ]))
            )->respond();
        } catch (Exception $e) {
            return logAndSendServerError($e->getMessage());
        }
    }

    public function destroy(DestroyRubric $request, int $id)
    {
        try {
            $rubric = $this->rubricService->destroy($id);
            return serviceResponse(
                200, true, 'modules.rubric.destroy.success',
                [],
                new SuccessNotification(__('modules/rubric.destroy.success', [
                    'title' => $rubric->title
                ]))
            )->respond();
        } catch (ModelNotFoundException $e) {
            return serviceResponse(
                200, false, 'modules.rubric.destroy.fail', [],
                new WarningNotification(__('modules/rubric.show.not_found'))
            )->respond();
        } catch (Exception $e) {
            return logAndSendServerError($e->getMessage());
        }
    }

    public function restore(RestoreRubric $request, int $id)
    {
        try {
            $rubric = $this->rubricService->restore($id);
            return serviceResponse(
                200, true, 'modules.rubric.restore.success',
                [],
                new SuccessNotification(__('modules/rubric.restore.success', [
                    'title' => $rubric->title
                ]))
            )->respond();
        } catch (ModelNotFoundException $e) {
            return serviceResponse(
                200, false, 'modules.rubric.restore.fail', [],
                new WarningNotification(__('modules/rubric.show.not_found_in_cart'))
            )->respond();
        } catch (Exception $e) {
            return logAndSendServerError($e->getMessage());
        }
    }

    public function forceDestroy(ForceDestroyRubric $request, int $id)
    {
        try {
            $rubric = $this->rubricService->forceDestroy($id);
            return serviceResponse(
                200, true, 'modules.rubric.force_destroy.success',
                [],
                new SuccessNotification(__('modules/rubric.force_destroy.success', [
                    'title' => $rubric->title
                ]))
            )->respond();
        } catch (ModelNotFoundException $e) {
            return serviceResponse(
                200, false, 'modules.rubric.force_destroy.fail', [],
                new WarningNotification(__('modules/rubric.show.not_found_in_cart'))
            )->respond();
        } catch (Exception $e) {
            return logAndSendServerError($e->getMessage());
        }
    }
}
