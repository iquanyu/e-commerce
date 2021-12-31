<?php

namespace App\Http\Controllers\Admin\Catalog;

use App\Http\Controllers\Controller;
use App\Models\AttributeFamily;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class AttributeFamiliesController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index(Request $request)
  {
    $families = AttributeFamily::filter([
      'status' => $request->input('status'),
      'search' => $request->input('search')
    ])->paginate()->withQueryString();

    $filters = [
      'status' => $request->input('status'),
      'search' => $request->input('search')
    ];

    return Inertia::render('Admin/Catalog/Families/Index', [
      'families' => $families,
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
    $attribute_familiy = AttributeFamily::with(['attribute_groups', 'attribute_groups.custom_attributes'])->find(1);
    $attribute_familiy->load(['attribute_groups', 'attribute_groups.custom_attributes']);
    return Inertia::render('Admin/Catalog/Families/Create', [
      'family' => $attribute_familiy
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
      'name' => 'required|max:255',
      'code' => 'required|unique:attribute_families',
    ]);
    $data = $request->all();
    //dd($data);
    $attribute_familiy = AttributeFamily::create([
      'code' => $data['code'],
      'name' => $data['name'],
    ]);
    $attribute_familiy->save();

    foreach ($data['groups'] as $group) {
      $arrtibute_family_group = $attribute_familiy->attribute_groups()->create([
        'name' => $group['name'],
        'position' => $group['position'],
        'is_user_defined' => 1
      ]);
      //$family_group = $attribute_familiy->attribute_groups()->where('id', $group['id'])->first();
      foreach ($group['custom_attributes'] as $attribute) {
        $attribute_ids[] = $attribute['id'];
      }
      $arrtibute_family_group->custom_attributes()->attach($attribute_ids);
      unset($attribute_ids);
    }


    return Redirect()->route('admin.catalog.families.index')->with('success', 'AttributeFamily saved.');
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
  public function edit(AttributeFamily $attribute_familiy)
  {
    $attribute_familiy->load(['attribute_groups', 'attribute_groups.custom_attributes']);
    return Inertia::render('Admin/Catalog/Families/Edit', [
      'family' => $attribute_familiy
    ]);
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, AttributeFamily $attribute_familiy)
  {
    $validated = $request->validate([
      'name' => 'required|max:255',
      'code' => 'required',
    ]);
    $data = $request->all();

    foreach ($data['groups'] as $group) {
      if (isset($group['id'])) {
        $arrtibute_family_group = $attribute_familiy->attribute_groups()->where('id', $group['id'])->first();
      } else {
        $arrtibute_family_group = $attribute_familiy->attribute_groups()->create([
          'name' => $group['name'],
          'position' => $group['position'],
          'is_user_defined' => 1
        ]);
      }
      foreach ($group['custom_attributes'] as $attribute) {
        if (isset($attribute['is_del']) && $attribute['is_del']) {
          $arrtibute_family_group->custom_attributes()->detach($attribute['id']);
        }

        if (isset($attribute['is_new']) && $attribute['is_new']) {
          $arrtibute_family_group->custom_attributes()->attach($attribute['id']);
        }
      }
    }
    $attribute_familiy->name = $data['name'];
    $attribute_familiy->save();

    return Redirect()->back();
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
