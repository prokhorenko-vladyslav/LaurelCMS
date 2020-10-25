<?php


namespace Laurel\CMS\Modules\Field\Contracts;


use Laurel\CMS\Modules\Field\Builder\FieldBuilder;
use Laurel\CMS\Modules\Field\Models\Field;

interface FieldModuleContract
{
    public static function getClassByType(string $type) : string;

    public function create(FieldBuilder $fieldBuilder) : Field;

    public function update(FieldBuilder $fieldBuilder) : Field;
}
