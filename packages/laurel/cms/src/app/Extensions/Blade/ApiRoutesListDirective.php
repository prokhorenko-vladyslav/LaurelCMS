<?php


namespace Laurel\CMS\Extensions\Blade;


use Illuminate\Support\Facades\App;
use Laurel\CMS\Contracts\BladeExtensionContract;
use Laurel\CMS\LaurelCMS;

class ApiRoutesListDirective implements BladeExtensionContract
{
    public function getDirectiveName(): string
    {
        return 'apiRoutesList';
    }

    public function getDirectiveExpression(): string
    {
        $routes = json_encode(cms()->getApiRoutes(), App::environment('production') ? JSON_UNESCAPED_SLASHES : JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
        return "
<script>
    window.apiRoutes = window.apiRoutes ||\n<?php echo '{$routes}'; ?>\n
</script>
";
    }

    public function isCondition(): bool
    {
        return false;
    }
}
