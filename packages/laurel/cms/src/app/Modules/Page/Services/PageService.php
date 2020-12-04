<?php


namespace Laurel\CMS\Modules\Page\Services;


use Exception;
use Laurel\CMS\Modules\Page\Contracts\PageServiceContract;
use Laurel\CMS\Modules\Page\Models\Page;

class PageService implements PageServiceContract
{
    public function fetch(?int $limit = null, bool $onlyTrashed = false)
    {
        $query = $onlyTrashed ? Page::onlyTrashed() : Page::withoutTrashed();
        return $query->orderByDesc('id')->paginate($limit ?? 10);
    }

    public function find(int $id, ?bool $throwIfNotFound = false, bool $onlyTrashed = false) : ?Page
    {
        $query = $onlyTrashed ? Page::onlyTrashed() : Page::withoutTrashed();
        if ($throwIfNotFound) {
            return $query->findOrFail($id);
        } else {
            return $query->find($id);
        }
    }

    public function findBy(string $field, $value, ?bool $throwIfNotFound = false, bool $onlyTrashed = false) : ?Page
    {
        $query = $onlyTrashed ? Page::onlyTrashed() : Page::withoutTrashed();
        $query = $query->where($field,$value);
        if ($throwIfNotFound) {
            return $query->firstOrFail();
        } else {
            return $query->first();
        }
    }

    public function store(
        string $title, string $text, ?array $attributes = [], ?int $views = 0,
        ?string $seoTitle = null, ?string $seoDescription = null, ?string $seoKeywords = null,
        ?string $seoRobotsTxt = null
    )
    {
        return $this->buildAndSave(
            new Page, $title, $text, $attributes, $views,
            $seoTitle, $seoDescription, $seoKeywords, $seoRobotsTxt
        );
    }

    public function update(
        int $id, string $title, string $text, ?array $attributes = [], ?int $views = 0,
        ?string $seoTitle = null, ?string $seoDescription = null, ?string $seoKeywords = null,
        ?string $seoRobotsTxt = null
    )
    {
        $page = $this->find($id, true);
        return $this->buildAndSave(
            $page, $title, $text, $attributes, $views,
            $seoTitle, $seoDescription, $seoKeywords, $seoRobotsTxt
        );
    }

    public function destroy(int $id) : Page
    {
        $page = $this->find($id, true);
        if (!$page->delete()) {
            throw new Exception(__('modules/page.destroy.fail'));
        }

        return $page;
    }

    public function restore(int $id) : Page
    {
        $page = $this->find($id, true, true);
        if (!$page->restore()) {
            throw new Exception(__('modules/page.restore.fail'));
        }

        return $page;
    }

    public function forceDestroy(int $id)
    {
        $page = $this->find($id, true, true);
        if (!$page->forceDelete()) {
            throw new Exception(__('modules/page.force_destroy.fail'));
        }

        return $page;
    }

    protected function buildAndSave(
        Page $page, string $title, string $text, ?array $attributes = [], ?int $views = 0,
        ?string $seoTitle = null, ?string $seoDescription = null, ?string $seoKeywords = null,
        ?string $seoRobotsTxt = null
    )
    {
        $page->fill([
            'title' => $title,
            'text' => $text,
            'attributes' => $attributes ?? [],
            'views' => $views ?? 0,
            'seo_title' => $seoTitle,
            'seo_description' => $seoDescription,
            'seo_keywords' => $seoKeywords,
            'seo_robots_txt' => $seoRobotsTxt,
        ]);
        $page->saveOrFail();

        return $page;
    }
}
