<?php


namespace Laurel\CMS\Modules\Field\Abstracts;


use Laurel\CMS\Exceptions\FieldHasNotBeenFound;

/**
 * Abstract class for fields.
 *
 * Class Field
 * @package Laurel\CMS\Abstracts
 */
abstract class FieldType
{
    /**
     * Creates array with field data.
     *
     * @return array
     */
    public abstract function toArray() : array;
}
