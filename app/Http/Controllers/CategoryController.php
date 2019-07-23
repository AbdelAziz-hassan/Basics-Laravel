<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Flash;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $categories = Category::paginate(10);
        return view('categories.index',compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $this->validate($request,[
            'name'=>'required|string',
        ]);
        $input = $request->all();
        $input['slug'] = getSlug($input['name'],Category::class);
        $category = Category::create($input);
        return redirect(route('categories.index'))->with('success','Category Saved Successfully');
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
    public function edit($id)
    {
        //
        $category=Category::find($id);
        if (empty($category)) {

            return redirect(route('categories.index'))->with('error','Category not found.');
        }
        return view('categories.edit',compact('category'));
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $category=Category::find($id);
        if (empty($category)) {

            return redirect(route('categories.index'))->with('error','Category not found.');
        }
        $this->validate($request,[
            'name'=>'required|string',
        ]);
        $input = $request->all();
        if($input['name']!= $category->name)
            $input['slug'] = getSlug($input['name'],Category::class);
        $category = $category->update($input);
        return redirect(route('categories.index'))->with('success','Category Updated Successfully');
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
        $category=Category::find($id);
        if (empty($category)) {

            return redirect(route('categories.index'))->with('error','Category not found.');
        }
        $category->delete();
        return redirect(route('categories.index'))->with('success','Category deleted successfully.');
    }
}
