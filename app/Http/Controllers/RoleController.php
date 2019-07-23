<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;
class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $roles = Role::paginate(10);
        return view('roles.index',compact('roles'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('roles.create');
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
            'role'=>'unique:roles',
        ]);
        $role = Role::create($request->all());
        return redirect(route('roles.index'));
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
        $role=Role::find($id);
        if (empty($role)) {

            return redirect(route('roles.index'))->with('error','Keyword not found.');
        }
        return view('roles.edit',compact('role'));        
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
            'role'=>'unique:roles,role,' . $id,
        ]);
        $role=Role::find($id);
        if (empty($role)) {

            return redirect(route('roles.index'))->with('error','Role not found.');
        }
        $role->update($request->all());
        return redirect(route('roles.index'))->with('success','Role Updated Successfully');
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
        $role=role::find($id);
        if (empty($role)) {

            return redirect(route('roles.index'))->with('error','Role not found.');
        }
        $cast = $role->casts()->delete();
        $role->delete();
        return redirect(route('roles.index'))->with('success','Role deleted successfully.');
    }
}
