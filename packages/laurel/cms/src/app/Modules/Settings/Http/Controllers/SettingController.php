<?php


namespace Laurel\CMS\Modules\Settings\Http\Controllers;


use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Builder;
use Laurel\CMS\Modules\Settings\Http\Resources\SettingResource;
use Laurel\CMS\Modules\Settings\Models\Setting;

class SettingController extends Controller
{
    public function index(string $sectionSlug)
    {
        return serviceResponse(200, true, 'settings.settings_fetched', [
            'settings' => SettingResource::collection(Setting::query()->whereHas('section', function (Builder $sectionQuery) use ($sectionSlug) {
                $sectionQuery->where('slug', $sectionSlug);
            })->get())
        ], 'Sections fetched')->respond();
    }
}
