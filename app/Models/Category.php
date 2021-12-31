<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kalnoy\Nestedset\NodeTrait;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class Category extends Model
{
  use HasFactory;
  use NodeTrait;

  protected $fillable = [
    'name',
    'description',
    'slug',
    'meta_title',
    'meta_description',
    'meta_keywords',
    'position',
    'status',
    'display_mode',
    'image',
    'parent_id',
    'additional',
  ];

  /**
   * 追加到模型数组表单的访问器
   *
   * @var array
   */
  protected $appends = ['image_url'];

  /**
   * Get image url for the category image.
   */
  public function image_url()
  {
    if (!$this->image)
      return;

    return Storage::url($this->image);
  }

  /**
   * Get image url for the category image.
   */
  public function getImageUrlAttribute()
  {
    return $this->image_url();
  }

  /**
   * The filterable attributes that belong to the category.
   */
  public function filterableAttributes()
  {
    return $this->belongsToMany(Attribute::class, 'category_filterable_attributes')->with(['options' => function ($query) {
      $query->orderBy('order');
    }]);
  }

  /**
   * Getting the root category of a category
   *
   * @return Category
   */
  public function getRootCategory(): Category
  {
    return Category::where([
      ['parent_id', '=', null],
      ['_lft', '<=', $this->_lft],
      ['_rgt', '>=', $this->_rgt],
    ])->first();
  }

  /**
   * Returns all categories within the category's path
   *
   * @return Category[]
   */
  public function getPathCategories(): array
  {
    $category = $this->findInTree();

    $categories = [$category];

    while (isset($category->parent)) {
      $category = $category->parent;
      $categories[] = $category;
    }

    return array_reverse($categories);
  }

  /**
   * Finds and returns the category within a nested category tree
   * will search in root category by default
   * is used to minimize the numbers of sql queries for it only uses the already cached tree
   *
   * @param Category[] $categoryTree
   * @return Category
   */
  public function findInTree($categoryTree = null): Category
  {
    if (!$categoryTree) {
      $categoryTree = app(CategoryRepository::class)->getVisibleCategoryTree($this->getRootCategory()->id);
    }

    $category = $categoryTree->first();

    if (!$category) {
      throw new NotFoundHttpException('category not found in tree');
    }

    if ($category->id === $this->id) {
      return $category;
    }

    return $this->findInTree($category->children);
  }

  public function scopeFilter($query, array $filters)
  {
    $query->when($filters['search'] ?? null, function ($query, $search) {
      $query->where('name', 'like', '%' . $search . '%')->orWhere('slug', 'like', '%' . $search . '%');
    })->when($filters['status'] ?? null, function ($query, $status) {
      if (!is_null($status)) {
        $query->where('status', $status);
      }
    });
  }
}
