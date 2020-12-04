<?php


namespace Laurel\CMS\Modules\Rubric\Services;


use Exception;
use Laurel\CMS\Modules\Rubric\Contracts\RubricServiceContract;
use Laurel\CMS\Modules\Rubric\Models\Rubric;

class RubricService implements RubricServiceContract
{
    public function fetch(?int $limit = null, bool $onlyTrashed = false)
    {
        $query = $onlyTrashed ? Rubric::onlyTrashed() : Rubric::withoutTrashed();
        return $query->paginate($limit ?? 10);
    }

    public function find(int $id, ?bool $throwIfNotFound = false, bool $onlyTrashed = false) : ?Rubric
    {
        $query = $onlyTrashed ? Rubric::onlyTrashed() : Rubric::withoutTrashed();
        if ($throwIfNotFound) {
            return $query->findOrFail($id);
        } else {
            return $query->find($id);
        }
    }

    public function findBy(string $field, $value, ?bool $throwIfNotFound = false, bool $onlyTrashed = false) : ?Rubric
    {
        $query = $onlyTrashed ? Rubric::onlyTrashed() : Rubric::withoutTrashed();
        $query = $query->where($field,$value);
        if ($throwIfNotFound) {
            return $query->firstOrFail();
        } else {
            return $query->first();
        }
    }

    public function store(
        string $title, string $text, array $attributes = [], int $views = 0,
        ?string $seoTitle = null, ?string $seoDescription = null, ?string $seoKeywords = null,
        ?string $seoRobotsTxt = null
    )
    {
        return $this->buildAndSave(
            new Rubric, $title, $text, $attributes, $views,
            $seoTitle, $seoDescription, $seoKeywords, $seoRobotsTxt
        );
    }

    public function update(
        int $id, string $title, string $text, array $attributes = [], int $views = 0,
        ?string $seoTitle = null, ?string $seoDescription = null, ?string $seoKeywords = null,
        ?string $seoRobotsTxt = null
    )
    {
        $rubric = $this->find($id, true);
        return $this->buildAndSave(
            $rubric, $title, $text, $attributes, $views,
            $seoTitle, $seoDescription, $seoKeywords, $seoRobotsTxt
        );
    }

    public function destroy(int $id) : Rubric
    {
        $rubric = $this->find($id, true);
        if (!$rubric->delete()) {
            throw new Exception(__('modules/rubric.destroy.fail'));
        }

        return $rubric;
    }

    public function restore(int $id) : Rubric
    {
        $rubric = $this->find($id, true, true);
        if (!$rubric->restore()) {
            throw new Exception(__('modules/rubric.restore.fail'));
        }

        return $rubric;
    }

    public function forceDestroy(int $id)
    {
        $rubric = $this->find($id, true, true);
        if (!$rubric->forceDelete()) {
            throw new Exception(__('modules/rubric.force_destroy.fail'));
        }

        return $rubric;
    }

    protected function buildAndSave(
        Rubric $rubric, string $title, string $text, array $attributes = [], int $views = 0,
        ?string $seoTitle = null, ?string $seoDescription = null, ?string $seoKeywords = null,
        ?string $seoRobotsTxt = null
    )
    {
        $rubric->fill([
            'title' => $title,
            'text' => $text,
            'attributes' => $attributes,
            'views' => $views,
            'seo_title' => $seoTitle,
            'seo_description' => $seoDescription,
            'seo_keywords' => $seoKeywords,
            'seo_robots_txt' => $seoRobotsTxt,
        ]);
        $rubric->saveOrFail();

        return $rubric;
    }
}
