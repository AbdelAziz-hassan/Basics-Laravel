<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Models\Group;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $users = User::paginate(10);
        return view('users.index',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        if(\Auth::user()->hasGroup('supers')){
            $groups = Group::pluck('name','id');
        }
        else{
            $groups = Group::where('name','!=','supers')->pluck('name','id');
        }
        $user_groups=[];
        return view('users.create',compact('groups','user_groups'));
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
            'name'=>'required',
            'email'=>'unique:users',
            'group_ids'=>'required|array'
        ]);
        $input=$request->all();
        $input['slug'] = getSlug($input['name'],User::class);
        $input['password']=Hash::make('123456');
        $user = User::create($input);
        $user->groups()->sync($request['group_ids']);
        return redirect(route('users.index'))->with('success','User\'s been added successfully.');
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
        $user = User::find($id);
        if(\Auth::user()->hasGroup('supers')){
            $groups = Group::pluck('name','id');
        }
        else{
            $groups = Group::where('name','!=','supers')->pluck('name','id');
        }
        $user_groups=$user->groups->pluck('id');
        return view('users.edit',compact('groups','user','user_groups'));
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
        $user = User::find($id);
        if($request['name']!= $user->name)
            $request['slug'] = getSlug($request['name'],User::class);
        $user->update($request->all());
        $user->groups()->sync($request['group_ids']);
        return redirect(route('users.index'))->with('success','User\'s been updated successfully.');

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
        $user = User::find($id);
        if(!$user){
            return redirect()->back()->with('error','User not found');
        }
        $user->delete();
        return redirect(route('users.index'))->with('success','User\'s been deleted successfully.');
    }

    public function changePassword(Request $request){
        $this->validate($request,[
            'current_password'=>'required',
            'password'=>'required',
        ]);
        $user = \Auth::user();
        if (\Hash::check($request['current_password'], $user->password)) {
            $user->update(['password'=>\Hash::make($request['password'])]);
            return redirect()->back()->with(['success'=>'Your password is changed','password_success'=>'']);

        }
        else{
            return redirect()->back()->with('error','Your current password is invalid');
        }
    }
    public function user($slug){
        $user = User::where('slug',$slug)->first();
        $recent_added = \App\Models\Title::orderBy('created_at','desc')->take(6)->get();
        $categories = \App\Models\Category::all();
        $reviews = \App\Models\Title::whereHas('reviews',function ($q) use ($user)
        {
            return $q->where('created_by', $user->id);
        })->with(['reviews'=>function ($q) use ($user) {
            return $q->where('created_by',$user->id);
        }])->get();
        return view('users.user',compact('user','recent_added','categories','reviews'));
    }
    public function editUser($slug){
        $user = User::where('slug',$slug)->first();
        $recent_added = \App\Models\Title::orderBy('created_at','desc')->take(6)->get();
        $categories = \App\Models\Category::all();
        $reviews = \App\Models\Title::whereHas('reviews',function ($q) use ($user)
        {
            return $q->where('created_by', $user->id);
        })->with(['reviews'=>function ($q) use ($user) {
            return $q->where('created_by',$user->id);
        }])->get();
        return view('users.account_settings',compact('user','recent_added','categories','reviews'));
    }

    public function updateUser($slug,Request $request){
        
        $this->validate($request,[
            'email' => 'required|email|unique:users,email,'.\Auth::user()->id,
            'name'=>'required',
        ]);
        $user = \Auth::user();
        if($request['name']!= $user->name)
            $request['slug'] = getSlug($request['name'],User::class);
        $user->update($request->all());
        return redirect('/user/'.$user->slug.'/settings')->withInput()->with(['success'=>'Your data is updated','data_success'=>'asd']);

    }
    public function updatePhoto($slug, Request $request){
        $this->validate($request,[
            'file'=>'required|image'
        ]);
        if($picture=$request->hasfile('file')){
            $request['picture']= $request->file('file')->store('/uploads/images/users/pictures');
        }
        $user->update($input);
        return redirect()->back()->with(['success'=>'Your profile photo is updated','photo_success'=>'']);

    }

}
