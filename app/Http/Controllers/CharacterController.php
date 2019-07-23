<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Character;
use App\Models\Title;
use App\Models\Category;
use App\Http\Requests\CharacterStoreRequest;
use App\Http\Requests\CharacterUpdateRequest;
use Illuminate\Support\Facades\Validator;

class CharacterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $characters = Character::filter($request->all())->paginateFilter(10);
        return view('characters.index',compact('characters'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('characters.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CharacterStoreRequest $request)
    {
        //
        $request->persist();
        return redirect(route('characters.index'))->with('success','Character Saved Successfully');
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
        $character = Character::find($id);
        if (empty($character)) {

            return redirect(route('characters.index'))->with('error','Character not found.');
        }
        return view('characters.edit',compact('character'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CharacterUpdateRequest $request, $id)
    {
        //
        $request->persist($id);
        return redirect(route('characters.index'))->with('success','Character Updated Successfully');
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
        $character=Character::find($id);
        if (empty($character)) {

            return redirect(route('characters.index'))->with('error','Character not found.');
        }
        $cast = $character->casts()->delete();
        $character->delete();
        return redirect(route('characters.index'))->with('success','Character deleted successfully.');
    }
    public function editSlider($id,Request $request){
        $model = 'Character';
        return getSlider($id, $model);
    }
    public function postSlider($id,Request $request){
        $model = 'Character';
        if($photos=$request->file('files')){
            $photos=\App\Models\File::uploadMultiple([$photos],'/uploads/images/titles/galary/'.$id);
        }
        return saveSlider($id,$model,$photos);
    }

    public function characterBySlug($slug){
        $character = Character::where('slug',$slug)->first();
        if (empty($character)) {

            return redirect('/')->with('error','Character not found.');
        }
        $rate_count = count($character->reviews()->pluck('rate'));
        if($rate_count>0){
            $rate = array_sum($character->reviews()->pluck('rate')->toArray())/$rate_count;
        }
        else
            $rate=0;
        $casts = $character->casts()->whereHas('role',function($q){
            $q->where([['role','!=', 'Writer'],['role','!=','Director']]);
        })->take(20)->get();
        $recent_added = Title::orderBy('created_at','desc')->take(6)->get();
        $categories = Category::all();
        return view('users.character',compact('character','rate','casts','recent_added','categories'));
    }
    public function personBySlug($slug){
        $person = Person::where('slug',$slug)->first();
        if (empty($person)) {

            return redirect('/')->with('error','Person not found.');
        }
        $rate_count = count($person->reviews()->pluck('rate'));
        if($rate_count>0){
            $rate = array_sum($person->reviews()->pluck('rate')->toArray())/$rate_count;
        }
        else
            $rate=0;
        $casts = $person->casts()->whereHas('role',function($q){
            $q->where([['role','!=', 'Writer'],['role','!=','Director']]);
        })->take(20)->get();
        return view('users.person',compact('person','rate','casts'));
    }

    public function review(Request $request){
        $validation = Validator::make($request->all(),[
            'rate'=>'required',
            'slug'=>'required',
            'review'=>'string'
        ]);
        if($validation->fails())
        {
            $errors = $validation->errors();
            $view = view('partials.errors',compact('errors'))->render();
            return response()->json($view,-2);
        }
        $character = Character::where('slug',$request['slug'])->first();
        $review = $character->reviews()->where('created_by',\Auth::user()->id)->first();
        if($review){
            if(!$request['review'])
                $review->update(['rate'=>$request['rate']]);
            else
                $review->update(['rate'=>$request['rate'],'review'=>$request['review']]);
        }
        else
        {
            $character->reviews()->create(['rate'=>$request['rate'],'review'=>$request['review'],'created_by'=>\Auth::user()->id]);
        }
    }
    public function deleteReview(Request $request){
        $character = Character::where('slug',$request['slug'])->first();
        $review = $character->reviews()->where('created_by',\Auth::user()->id)->first();
        $review->delete();
        return "true";
    }

    
    public function storeReview($slug,Request $request){
        $request['slug']=$slug;
        $this->review($request);
        return redirect()->back();
    }

    public function characterReviews($slug){
        $title = Character::where('slug',$slug)->first();
        if (empty($title)) {

            return redirect('/home')->with('error','Title not found.');
        }
        $reviews = $title->reviews()->where('review','!=','')->paginate(20);
        $recent_added = Title::orderBy('created_at','desc')->take(6)->get();
        $top_rated = Title::where('type','movie')->orderBy('rate','desc')->take(6)->get();
        $ref = 'character';
        return view('users.title_reviews',compact('reviews','title','recent_added','top_rated','ref'));
    }

}
