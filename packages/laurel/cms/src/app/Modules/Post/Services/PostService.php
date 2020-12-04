<?php


namespace Laurel\CMS\Modules\Post\Services;


use Exception;
use Laurel\CMS\Modules\Post\Models\Post;
use Laurel\CMS\Modules\Post\Contracts\PostServiceContract;

class PostService implements PostServiceContract
{
    public function fetch(?int $limit = null, bool $onlyTrashed = false)
    {
        $query = $onlyTrashed ? Post::onlyTrashed() : Post::withoutTrashed();
        return $query->paginate($limit ?? 10);
    }

    public function find(int $id, ?bool $throwIfNotFound = false, bool $onlyTrashed = false) : ?Post
    {
        $query = $onlyTrashed ? Post::onlyTrashed() : Post::withoutTrashed();
        if ($throwIfNotFound) {
            return $query->findOrFail($id);
        } else {
            return $query->find($id);
        }
    }

    public function findBy(string $field, $value, ?bool $throwIfNotFound = false, bool $onlyTrashed = false) : ?Post
    {
        $query = $onlyTrashed ? Post::onlyTrashed() : Post::withoutTrashed();
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
            new Post, $title, $text, $attributes, $views,
            $seoTitle, $seoDescription, $seoKeywords, $seoRobotsTxt
        );
    }

    public function update(
        int $id, string $title, string $text, array $attributes = [], int $views = 0,
        ?string $seoTitle = null, ?string $seoDescription = null, ?string $seoKeywords = null,
        ?string $seoRobotsTxt = null
    )
    {
        $post = $this->find($id, true);
        return $this->buildAndSave(
            $post, $title, $text, $attributes, $views,
            $seoTitle, $seoDescription, $seoKeywords, $seoRobotsTxt
        );
    }

    public function destroy(int $id) : Post
    {
        $post = $this->find($id, true);
        if (!$post->delete()) {
            throw new Exception(__('modules/post.destroy.fail'));
        }

        return $post;
    }

    public function restore(int $id) : Post
    {
        $post = $this->find($id, true, true);
        if (!$post->restore()) {
            throw new Exception(__('modules/post.restore.fail'));
        }

        return $post;
    }

    public function forceDestroy(int $id)
    {
        $post = $this->find($id, true, true);
        if (!$post->forceDelete()) {
            throw new Exception(__('modules/post.force_destroy.fail'));
        }

        return $post;
    }

    protected function buildAndSave(
        Post $post, string $title, string $text, array $attributes = [], int $views = 0,
        ?string $seoTitle = null, ?string $seoDescription = null, ?string $seoKeywords = null,
        ?string $seoRobotsTxt = null
    ) : Post
    {
        $post->fill([
            'title' => $title,
            'text' => $text,
            'attributes' => $attributes,
            'views' => $views,
            'seo_title' => $seoTitle,
            'seo_description' => $seoDescription,
            'seo_keywords' => $seoKeywords,
            'seo_robots_txt' => $seoRobotsTxt,
        ]);
        $post->saveOrFail();

        return $post;
    }
}
