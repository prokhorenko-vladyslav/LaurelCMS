<?php


namespace Laurel\CMS\Modules\Page\Contracts;


interface PageServiceContract
{
    public function fetch(?int $limit = null);

    public function find(int $id);

    public function findBy(string $field, $value);

    public function store(
        string $title, string $text, array $attributes = [], int $views = 0,
        ?string $seoTitle = null, ?string $seoDescription = null, ?string $seoKeywords = null,
        ?string $seoRobotsTxt = null
    );

    public function update(
        int $id, string $title, string $text, array $attributes = [], int $views = 0,
        ?string $seoTitle = null, ?string $seoDescription = null, ?string $seoKeywords = null,
        ?string $seoRobotsTxt = null
    );

    public function destroy(int $id);

    public function forceDestroy(int $id);
}
