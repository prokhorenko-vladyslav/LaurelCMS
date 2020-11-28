<?php


namespace Laurel\CMS\Modules\Page;

use Illuminate\Support\Facades\Route;
use Laurel\CMS\Modules\Page\Contracts\PageServiceContract;
use Laurel\CMS\Modules\Page\Contracts\PageModuleContract;
use Laurel\CMS\Modules\Page\Http\Controllers\PageController;
use Laurel\CMS\Modules\Page\Services\PageService;

/**
 * Module for manipulating pages
 *
 */
class PageModule implements PageModuleContract
{
    public function __construct()
    {
        app()->singleton(PageServiceContract::class, PageService::class);
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
                Route::resource('page', PageController::class);
                Route::middleware('auth:api')->group(function() {
                    Route::delete('page/{page}/force', [ PageController::class, 'forceDestroy' ]);
                    Route::patch('page/{page}/restore', [ PageController::class, 'restore' ]);
                    //Route::resource('page', PageController::class);
                });
            });
    }
}
