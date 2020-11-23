<?php


namespace Laurel\CMS\Modules\Rubric;

use Illuminate\Support\Facades\Route;
use Laurel\CMS\Modules\Rubric\Contracts\RubricModuleContract;
use Laurel\CMS\Modules\Rubric\Contracts\RubricServiceContract;
use Laurel\CMS\Modules\Rubric\Http\Controllers\RubricController;
use Laurel\CMS\Modules\Rubric\Services\RubricService;

class RubricModule implements RubricModuleContract
{
    public function __construct()
    {
        app()->singleton(RubricServiceContract::class, RubricService::class);
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
                    Route::delete('rubric/{rubric}/force', [ RubricController::class, 'forceDestroy' ]);
                    Route::patch('rubric/{rubric}/restore', [ RubricController::class, 'restore' ]);
                    Route::resource('rubric', RubricController::class);
                });
            });
    }
}
