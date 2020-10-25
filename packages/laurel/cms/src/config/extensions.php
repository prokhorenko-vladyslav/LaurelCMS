<?php
    return [
        "blade" => [
            \Laurel\CMS\Extensions\Blade\ApiRoutesListDirective::class
        ],

        "fields" => [
            "simpleInput" => \Laurel\CMS\Modules\Field\Fields\SimpleInput::class,
            "numberInput" => \Laurel\CMS\Modules\Field\Fields\NumberInput::class,
            "textarea" => \Laurel\CMS\Modules\Field\Fields\TextareaField::class,
            "select" => \Laurel\CMS\Modules\Field\Fields\SelectField::class,
            "multipleSelect" => \Laurel\CMS\Modules\Field\Fields\MultipleSelect::class,
            "checkbox" => \Laurel\CMS\Modules\Field\Fields\CheckboxField::class,
            "radio" => \Laurel\CMS\Modules\Field\Fields\RadioButtonField::class,
            "file" => \Laurel\CMS\Modules\Field\Fields\FileField::class
        ]
    ];
