<?php


namespace Laurel\CMS\Modules\Field\Builder;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Laurel\CMS\Modules\Field\Exceptions\PositionNameForFieldHasNotBeenFound;
use Laurel\CMS\Modules\Field\Models\Field;

class FieldBuilder
{
    /**
     * Creating instance of the field.
     *
     * @var Field|null
     */
    protected ?Field $instance;

    /**
     * Clears current and creates new instance for build.
     *
     * @param Field|null $field
     * @return $this
     */
    public function make(?Field $field = null) : self
    {
        $this->instance = $field ?? new Field;
        return $this;
    }

    public function instance() : Field
    {
        return $this->instance;
    }

    public function setType(string $type) : self
    {
        $this->instance->type = $type;
        return $this;
    }

    public function setPositions(array $positions) : self
    {
        $positions = collect($positions);
        $positions->each(function($item, $index) {
            $this->checkPosition($item);
        });
        $this->instance->positions = $positions;
        return $this;
    }

    public function checkPosition(array $position)
    {
        if (empty($position['name'])) {
            throw new PositionNameForFieldHasNotBeenFound;
        }
    }

    public function addPosition(array $position)
    {
        $this->checkPosition($position);
        $this->instance->positions->push($position);
        return $this;
    }

    public function removePosition(string $position)
    {
        return $this->instance->positions->reject(function ($value, $key) use ($position) {
            return $value === $position['name'];
        });
    }

    public function setAttributes(array $attributes) : self
    {
        $this->instance->attributes = $attributes;
        return $this;
    }

    public function setValue(?string $value) : self
    {
        $this->instance->value = $value;
        return $this;
    }

    public function associate(Model $model) : self
    {
        $this->instance->fieldable()->associate($model);
        return $this;
    }
}
