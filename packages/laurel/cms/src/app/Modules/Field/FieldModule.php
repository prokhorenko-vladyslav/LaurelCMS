<?php


namespace Laurel\CMS\Modules\Field;


use Laurel\CMS\Exceptions\FieldHasNotBeenFound;
use Laurel\CMS\Modules\Field\Abstracts\FieldType;
use Laurel\CMS\Modules\Field\Builder\FieldBuilder;
use Laurel\CMS\Modules\Field\Contracts\FieldModuleContract;
use Laurel\CMS\Modules\Field\Models\Field;

class FieldModule implements FieldModuleContract
{
    public static function getClassByType(string $type) : string
    {
        $fieldClass = config("laurel.cms.extensions.fields.{$type}", null);
        throw_if(
            !$fieldClass ||
            !class_exists($fieldClass) ||
            get_parent_class($fieldClass) !== FieldType::class,
            FieldHasNotBeenFound::class,
            ...[$type]
        );
        return $fieldClass;
    }

    public function create(FieldBuilder $fieldBuilder) : Field
    {
        $fieldBuilder->instance()->saveOrFail();
        return $fieldBuilder->instance();
    }

    public function update(FieldBuilder $fieldBuilder) : Field
    {
        $fieldBuilder->instance()->saveOrFail();
        return $fieldBuilder->instance();
    }
}
