<?php


namespace Laurel\CMS\Modules\Post;

use Illuminate\Support\Facades\Route;
use Laurel\CMS\Modules\Post\Contracts\PostServiceContract;
use Laurel\CMS\Modules\Post\Http\Controllers\PostController;
use Laurel\CMS\Modules\Post\Services\PostService;
use Laurel\CMS\Modules\Tag\Contracts\TagModuleContract;

class PostModule implements TagModuleContract
{
    public function __construct()
    {
        app()->singleton(PostServiceContract::class, PostService::class);
    }

    public function routes(string $group) {
        if ($group === 'api') {
            $this->addApiRoutes();
        }
    }

    protected function addApiRoutes()
    {
        Route::name('api.modules.')
            ->prefix('modules')
            ->group(function() {
                Route::middleware('auth:api')->group(function() {
                    Route::delete('post/{post}/force', [ PostController::class, 'forceDestroy' ]);
                    Route::patch('post/{post}/restore', [ PostController::class, 'restore' ]);
                    Route::resource('post', PostController::class);
                });
            });
    }
}
