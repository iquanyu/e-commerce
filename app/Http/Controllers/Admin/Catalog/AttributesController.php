<?php

namespace App\Http\Controllers\Admin\Catalog;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Attribute;
use App\Models\AttributeOption;
use Illuminate\Support\Facades\Redirect;

class AttributesController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index(Request $request)
  {

    //dd(Attribute::with('options')->find(31));
    $attributes = \App\Models\Attribute::oldest('position')->filter([
      'type' => $request->input('type'),
      'search' => $request->input('search')
    ])->paginate()->withQueryString();
    $filters = [
      'type' => $request->input('type'),
      'search' => $request->input('search')
    ];
    return Inertia::render('Admin/Catalog/Attributes/Index', [
      'attributes' => $attributes,
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
    return Inertia::render('Admin/Catalog/Attributes/Create');
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
      'code' => 'required|unique:attributes',
      'type' => 'required',
    ]);
    $data = $request->all();
    //dd($data);

    $options = isset($data['options']) ? $data['options'] : [];

    unset($data['options']);

    $data['is_user_defined'] = 1;

    $attribute = Attribute::create($data);

    if (in_array($attribute->type, ['select', 'multiselect', 'checkbox']) && count($options)) {
      $attribute->options()->createMany($options);
    }

    //session()->flash('success', trans('admin::app.response.create-success', ['name' => 'Attribute']));

    return Redirect()->route('admin.catalog.attributes.index')->with('success', 'Attribute saved.');
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
  public function edit(Attribute $attribute)
  {
    $attribute->load(['options']);
    return Inertia::render('Admin/Catalog/Attributes/Edit', [
      'attribute' => $attribute,
    ]);
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, Attribute $attribute)
  {
    $validated = $request->validate([
      'name' => 'required|max:255',
      'code' => 'required',
      'type' => 'required',
    ]);
    $data = $request->all();


    $attribute->update($data);

    if (in_array($attribute->type, ['select', 'multiselect', 'checkbox'])) {
      if (isset($data['options'])) {

        $options = $attribute->options()->get();

        foreach ($data['options'] as $optionId => $optionInputs) {

          if (isset($optionInputs['id'])) {
            $attribute_option = AttributeOption::find($optionInputs['id']);
            unset($optionInputs['attribute_id']);
            $attribute_option->update($optionInputs);
            //unset($optionInputs);
            $ids[] = $optionInputs['id'];
          } else {
            $attribute->options()->create($optionInputs);
            //$attribute->options()->save(new AttributeOption($optionInputs));
          }
        }

        $collection = collect(isset($ids) ? $ids : []);

        foreach ($options as $value) {



          if (!$collection->contains($value->id)) {
            $value->delete();
          }
        }
      }
    }


    return Redirect::back()->with('success', 'Organization updated.');
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
