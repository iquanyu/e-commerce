<?php

namespace App\Http\Controllers\Admin\Catalog;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Attribute;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CategoriesController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index(Request $request)
  {
    $categories = Category::oldest('position')->filter([
      'status' => $request->input('status'),
      'search' => $request->input('search')
    ])->paginate()->withQueryString();

    $filters = [
      'status' => $request->input('status'),
      'search' => $request->input('search')
    ];


    return Inertia::render('Admin/Catalog/Categories/Index', [
      'categories' => $categories,
      'filters' => $filters
    ]);
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    $tree = Category::get()->toFlatTree();


    return Inertia::render('Admin/Catalog/Categories/Create', [
      'tree'     => $tree,
      //'attributes' => $attributes
    ]);
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {

    $validated = $request->validate([
      'name' => 'required',
      'status' => 'required',
      'slug' => 'required',
    ]);

    $data = $request->all();


    if ($request->file('image')) {

      $path = $request->file('image')->store('public/categories_images');

      $data['image'] = $path;
    }

    $node = Category::create($data);

    dd($node);



    return Redirect()->route('admin.catalog.categories.index')->with('success', 'Category saved.');
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show($id)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function edit(Category $category)
  {
    $tree = Category::get()->toFlatTree();

    //$attributes = Attribute::where(['is_filterable' =>  1])->get();



    return Inertia::render('Admin/Catalog/Categories/Edit', [
      'category' => $category,
      'tree'     => $tree,
      //'attributes' => $attributes
    ]);
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, Category $category)
  {
    //$category->append('image_url');
    $validated = $request->validate([
      'name' => 'required',
      'status' => 'required',
      'slug' => 'required',
    ]);
    // $data = [
    //   'id' => $request->input('id'),
    //   'name' => $request->input('name'),
    //   'status' => $request->input('status'),
    //   'slug' => $request->input('slug'),
    //   'position' => $request->input('position'),
    //   'display_mode' => $request->input('display_mode'),
    //   'description' => $request->input('description'),
    //   'parent_id' => $request->input('parent_id'),
    //   'meta_title' => $request->input('meta_title'),
    //   'meta_keywords' => $request->input('meta_keywords'),
    //   'meta_description' => $request->input('meta_description'),
    // ];
    $data = $request->all();

    if ($request->file('image')) {

      $path = $request->file('image')->store('public/categories_images');

      $data['image'] = $path;

      //$data['image'] =  '/' . Str::of($path)->replace('public', 'storage');

      //$path = $request->file('cover')->store('/public/cover');
      //$data['cover'] = '/' . Str::of($path)->replace('public', 'storage');
    }

    $category->update($data);

    return Redirect()->route('admin.catalog.categories.index')->with('success', 'Category saved.');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
    //
  }
}
