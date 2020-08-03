<?php


namespace Laurel\CMS\Modules\Localization\Traits;


use Illuminate\Support\Facades\App;

trait HasTranslations
{
    public function __get($name)
    {
        if (!empty($this->translatable) && in_array($name, $this->translatable) && key_exists($name, $this->attributes)) {
            if (valueIsJson($this->attributes[$name])) {
                $attributeTranslations = json_decode($this->attributes[$name], true);
                return $attributeTranslations[App::getLocale()] ?? null;
            }
        }

        return parent::__get($name);
    }

    public function __set($name, $value)
    {
        if (!empty($this->translatable) && in_array($name, $this->translatable) && key_exists($name, $this->attributes)) {
            if (valueIsJson($this->attributes[$name])) {
                $this->attributes[$name] = json_decode($this->attributes[$name], true);
                $this->attributes[$name][App::getLocale()] = $value;
            } else {
                $this->attributes[$name] = [
                    App::getLocale() => $value
                ];
            }
        } else {
            parent::__set($name, $value);
        }
    }

    public function save(array $options = [])
    {
        $this->encodeTranslatableAttributes();
        return parent::save($options);
    }

    public function saveOrFail(array $options = [])
    {
        $this->encodeTranslatableAttributes();
        return parent::saveOrFail($options);
    }

    protected function encodeTranslatableAttributes()
    {
        if (empty($this->translatable)) {
            return;
        }

        foreach ($this->attributes as $attributeName => $attributeValue) {
            if (in_array($attributeName, $this->translatable) && is_array($attributeValue)) {
                $this->attributes[$attributeName] = json_encode($attributeValue, JSON_PRETTY_PRINT);
            }
        }
    }
}
