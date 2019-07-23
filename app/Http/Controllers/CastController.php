<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cast;
use App\Models\Title;
use App\Models\Character;
use App\Models\Person;
use App\Models\Role;
use App\Http\Requests\CastStoreRequest;
use App\Http\Requests\CastUpdateRequest;
class CastController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $casts = Cast::paginate(10);
        return view('casts.index',compact('casts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $titles = Title::pluck('title','id');
        $persons = Person::pluck('name','id');
        $characters = Character::pluck('name','id');
        $roles = Role::pluck('role','id');
        return view('casts.create',compact('titles','persons','characters','roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CastStoreRequest $request)
    {
        //
        $request->persist();
        return redirect(route('titles.show',$request['title_id']))->with('success','Cast Saved Successfully');
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
        $cast = Cast::find($id);
        if (empty($cast)) {

            return redirect(route('casts.index'))->with('error','Cast not found.');
        }
        $titles = Title::pluck('title','id');
        $persons = Person::pluck('name','id');
        $characters = Character::pluck('name','id');
        $roles = Role::pluck('role','id');
        return view('casts.edit',compact('titles','persons','characters','roles','cast'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CastUpdateRequest $request, $id)
    {
        //
        $request->persist($id);
        return redirect(route('titles.show',$request['title_id']))->with('success','Cast Updated Successfully');
        return redirect(route('casts.index'))->with('success','Character Updated Successfully');
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
        $cast=Cast::find($id);
        if (empty($cast)) {

            return redirect(route('casts.index'))->with('error','Cast not found.');
        }
        $title= $cast->title;
        $cast->delete();
        return redirect(route('titles.show',$title->id))->with('success','Cast deleted Successfully');
    }
}
