<?php
    return [
        "blade" => [
            \Laurel\CMS\Extensions\Blade\ApiRoutesListDirective::class
        ],

        "fields" => [
            "input" => \Laurel\CMS\Fields\InputField::class,
            "numberInput" => \Laurel\CMS\Fields\NumberInput::class,
            "textarea" => \Laurel\CMS\Fields\TextareaField::class,
            "select" => \Laurel\CMS\Fields\SelectField::class,
            "multipleSelect" => \Laurel\CMS\Fields\MultipleSelect::class,
            "checkbox" => \Laurel\CMS\Fields\CheckboxField::class,
            "radio" => \Laurel\CMS\Fields\RadioButtonField::class,
            "file" => \Laurel\CMS\Fields\FileField::class
        ]
    ];
