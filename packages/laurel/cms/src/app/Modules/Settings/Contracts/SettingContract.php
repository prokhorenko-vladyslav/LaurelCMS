<?php


namespace Laurel\CMS\Modules\Settings\Contracts;


use Laurel\CMS\Contracts\MustHaveRoutes;
use Laurel\CMS\Modules\Settings\Models\SettingSection;

interface SettingContract extends MustHaveRoutes
{
    public function createSettingSectionIfNotExists(array $name, array $description, string $slug, string $iconUrl) : SettingSection;
}
