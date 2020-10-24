<?php


namespace Laurel\CMS\Abstracts;


use Laurel\CMS\Exceptions\FieldHasNotBeenFound;

/**
 * Abstract class for fields.
 *
 * Class Field
 * @package Laurel\CMS\Abstracts
 */
abstract class Field
{
    public static function getClassByType(string $type)
    {
        $fieldClass = config("laurel.cms.extensions.fields.{$type}", null);
        throw_if(
            !$fieldClass ||
            !class_exists($fieldClass) ||
            get_parent_class($fieldClass) !== self::class,
            FieldHasNotBeenFound::class,
            ...[$type]
        );
        return $fieldClass;
    }

    /**
     * Creates array with field data.
     *
     * @return array
     */
    public abstract function toArray() : array;
}
