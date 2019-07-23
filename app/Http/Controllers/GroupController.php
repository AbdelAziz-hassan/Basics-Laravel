<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Group;
class GroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $groups = Group::paginate(10);
        return view('groups.index',compact('groups'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('groups.create');
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
            'name'=>'unique:groups',
        ]);
        $group = Group::create($request->all());
        return redirect(route('groups.index'));
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
         //
         $group=Group::find($id);
         if (empty($group)) {
 
             return redirect(route('groups.index'))->with('error','Group not found.');
         }
         return view('groups.show',compact('group'));
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
        $group=Group::find($id);
        if (empty($group)) {

            return redirect(route('groups.index'))->with('error','Group not found.');
        }
        return view('groups.edit',compact('group'));
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
        $this->validate($request,[
            'name'=>'unique:groups,name,' . $id,
        ]);
        $group=Group::find($id);
        if (empty($group)) {

            return redirect(route('groups.index'))->with('error','Group not found.');
        }
        $group->update($request->all());
        return redirect(route('groups.index'))->with('success','Group Updated Successfully');
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
        $group=group::find($id);
        if (empty($group)) {

            return redirect(route('groups.index'))->with('error','Group not found.');
        }
        $group->delete();
        return redirect(route('groups.index'))->with('success','Group deleted successfully.');
    }
}
