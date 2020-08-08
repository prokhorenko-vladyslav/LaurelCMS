<?php


namespace Laurel\CMS\Modules\Localization\Http\Controllers;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Laurel\CMS\Modules\Localization\LocalizationModule;

class TranslationController extends Controller
{
    public function index(Request $request, string $group = null)
    {
        return LocalizationModule::instance()->loadTranslations($group)->getTranslations();
    }
}
