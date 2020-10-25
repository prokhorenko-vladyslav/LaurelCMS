<?php

namespace Laurel\CMS\Modules\Settings\Database\Seeders;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Laurel\CMS\Abstracts\Field;
use Laurel\CMS\Modules\Field\Builder\FieldBuilder;
use Laurel\CMS\Modules\Field\Contracts\FieldModuleContract;
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
     * @param FieldModuleContract $fieldModule
     * @return void
     */
    public function run(SettingModuleContract $settingModule, FieldModuleContract $fieldModule)
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

            if (!empty($sectionData['settings'])) {
                foreach ($sectionData['settings'] as $order => $settingData) {
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
                        ->setSlug($settingData['slug']);
                    $sectionBuilder->addSetting($settingBuilder);

                    $fieldBuilder = new FieldBuilder;
                    $fieldBuilder
                        ->make(
                            $setting ? $setting->field : null
                        )
                        ->setType($settingData['type'])
                        ->setAttributes($settingData['attributes'] ?? [])
                        ->setPositions($settingData['positions'] ?? [])
                        ->setValue($settingData['value'])
                        ->associate($settingBuilder->instance());
                    $fieldModule->create($fieldBuilder);
                }
            }
        }
        dd('Done!');
    }
}
