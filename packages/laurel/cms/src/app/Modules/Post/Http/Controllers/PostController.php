<?php


namespace Laurel\CMS\Modules\Post\Http\Controllers;


use App\Http\Controllers\Controller;
use Laurel\CMS\Modules\Post\Http\Requests\{
    BrowsePosts,
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
use Laurel\CMS\Modules\Post\Http\Resources\PostResource;
use Laurel\CMS\Modules\Post\Http\Resources\PostsCollection;
use Laurel\CMS\Modules\Post\Contracts\PostServiceContract;

class PostController extends Controller
{
    protected PostServiceContract $postService;

    public function __construct(PostServiceContract $postService)
    {
        $this->postService = $postService;
    }

    public function index(BrowsePosts $request)
    {
        try {
            $posts = $this->postService->fetch($request->input('limit'));
            return serviceResponse(
                200, true, 'modules.posts.index.success',
                new PostsCollection($posts)
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
            $post = $this->postService->store(
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
                200, true, 'modules.post.store.success',
                [
                    'post' => new PostResource($post)
                ],
                new SuccessNotification(__('modules/post.store.success', [
                    'title' => $post->title
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
            $post = $this->postService->update(
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
                200, true, 'modules.post.update.success',
                [
                    'post' => new PostResource($post)
                ],
                new SuccessNotification(__('modules/post.update.success', [
                    'title' => $post->title
                ]))
            )->respond();
        } catch (Exception $e) {
            return logAndSendServerError($e->getMessage());
        }
    }

    public function destroy(DestroyRubric $request, int $id)
    {
        try {
            $post = $this->postService->destroy($id);
            return serviceResponse(
                200, true, 'modules.post.destroy.success',
                [],
                new SuccessNotification(__('modules/post.destroy.success', [
                    'title' => $post->title
                ]))
            )->respond();
        } catch (ModelNotFoundException $e) {
            return serviceResponse(
                200, false, 'modules.post.destroy.fail', [],
                new WarningNotification(__('modules/post.show.not_found'))
            )->respond();
        } catch (Exception $e) {
            return logAndSendServerError($e->getMessage());
        }
    }

    public function restore(RestoreRubric $request, int $id)
    {
        try {
            $post = $this->postService->restore($id);
            return serviceResponse(
                200, true, 'modules.post.restore.success',
                [],
                new SuccessNotification(__('modules/post.restore.success', [
                    'title' => $post->title
                ]))
            )->respond();
        } catch (ModelNotFoundException $e) {
            return serviceResponse(
                200, false, 'modules.post.restore.fail', [],
                new WarningNotification(__('modules/post.show.not_found_in_cart'))
            )->respond();
        } catch (Exception $e) {
            return logAndSendServerError($e->getMessage());
        }
    }

    public function forceDestroy(ForceDestroyRubric $request, int $id)
    {
        try {
            $post = $this->postService->forceDestroy($id);
            return serviceResponse(
                200, true, 'modules.post.force_destroy.success',
                [],
                new SuccessNotification(__('modules/post.force_destroy.success', [
                    'title' => $post->title
                ]))
            )->respond();
        } catch (ModelNotFoundException $e) {
            return serviceResponse(
                200, false, 'modules.post.force_destroy.fail', [],
                new WarningNotification(__('modules/post.show.not_found_in_cart'))
            )->respond();
        } catch (Exception $e) {
            return logAndSendServerError($e->getMessage());
        }
    }
}
