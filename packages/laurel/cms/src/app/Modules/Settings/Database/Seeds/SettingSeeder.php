<?php

namespace Laurel\CMS\Modules\Settings\Database\Seeds;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\Seeder;
use Laurel\CMS\Abstracts\Field;
use Laurel\CMS\Modules\Settings\Builders\SettingBuilder;
use Laurel\CMS\Modules\Settings\Builders\SettingSectionBuilder;
use Laurel\CMS\Modules\Settings\Contracts\SettingModuleContract;
use Laurel\CMS\Traits\HasSeedData;

class SettingSeeder extends Seeder
{
    use HasSeedData;

    /**
     * Run the database seeds.
     *
     * @param SettingModuleContract $settingModule
     * @return void
     */
    public function run(SettingModuleContract $settingModule)
    {
        $settingSectionsData = $settingModule->getSeedData('settingSections');
        foreach ($settingSectionsData as $sectionData) {
            $sectionBuilder = new SettingSectionBuilder;
            $sectionBuilder
                ->make(
                    $settingModule->findSection($sectionData['slug'], 'slug', false)
                )
                ->setName($sectionData['name'])
                ->setDescription($sectionData['description'])
                ->setSlug($sectionData['slug'])
                ->setIconUrl($sectionData['iconUrl']);
            $settingModule->createSection($sectionBuilder);

            foreach ($sectionData['settings'] as $settingData) {
                try {
                    $setting = $sectionBuilder->instance()->settings()->findBy('slug', $settingData['slug']);
                } catch (ModelNotFoundException $e) {
                    $setting = null;
                }
                $settingBuilder = new SettingBuilder;
                $settingBuilder
                    ->make(
                        $setting
                    )
                    ->setName($settingData['name'])
                    ->setDescription($settingData['description'])
                    ->setSlug($settingData['slug'])
                    ->setValue($settingData['value'])
                    ->setType($settingData['type'])
                    ->setAttributes($settingData['attributes']);
                $sectionBuilder->addSetting($settingBuilder);
            }
            dd($sectionBuilder);
        }
        dd('Done!');
    }
}
