<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Person;
use App\Models\Title;
use App\Models\Category;
use App\Http\Requests\PersonStoreRequest;
use App\Http\Requests\PersonUpdateRequest;
use Illuminate\Support\Facades\Validator;

class PersonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $persons = Person::filter($request->all())->paginateFilter(10);
        return view('persons.index',compact('persons'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('persons.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PersonStoreRequest $request)
    {
        //
        $request->persist();
        return redirect(route('persons.index'))->with('success','Person Saved Successfully');
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
        $person = Person::find($id);
        
        $cast = $person->casts->groupBy('title.year');
        if (empty($person)) {

            return redirect(route('persons.index'))->with('error','Person not found.');
        }
        return view('persons.show',compact('person','cast'));
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
        $person = Person::find($id);
        if (empty($person)) {

            return redirect(route('persons.index'))->with('error','Person not found.');
        }
        return view('persons.edit',compact('person'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PersonUpdateRequest $request, $id)
    {
        //
        $request->persist($id);
        return redirect(route('persons.index'))->with('success','Person Saved Successfully');
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
        $person=Person::find($id);
        if (empty($person)) {

            return redirect(route('persons.index'))->with('error','Person not found.');
        }
        $cast = $person->casts()->delete();
        $person->delete();
        return redirect(route('persons.index'))->with('success','Person deleted successfully.');
    }

    public function editSlider($id,Request $request){
        $model = 'Person';
        return getSlider($id, $model);
    }
    public function postSlider($id,Request $request){
        $model = 'Person';
        if($photos=$request->file('files')){
            $photos=\App\Models\File::uploadMultiple([$photos],'/uploads/images/titles/galary/'.$id);
        }
        return saveSlider($id,$model,$photos);
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
        $recent_added = Title::orderBy('created_at','desc')->take(6)->get();
        $categories = Category::all();
        return view('users.person',compact('person','rate','casts','recent_added','categories'));
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
        $person = Person::where('slug',$request['slug'])->first();
        $review = $person->reviews()->where('created_by',\Auth::user()->id)->first();
        if($review){
            if(!$request['review'])
                $review->update(['rate'=>$request['rate']]);
            else
                $review->update(['rate'=>$request['rate'],'review'=>$request['review']]);
        }
        else
        {
            $person->reviews()->create(['rate'=>$request['rate'],'review'=>$request['review'],'created_by'=>\Auth::user()->id]);
        }
    }
    public function deleteReview(Request $request){
        $person = Person::where('slug',$request['slug'])->first();
        $review = $person->reviews()->where('created_by',\Auth::user()->id)->first();
        $review->delete();
        return "true";
    }

    
    public function storeReview($slug,Request $request){
        $request['slug']=$slug;
        $this->review($request);
        return redirect()->back();
    }

    public function personReviews($slug){
        $title = Person::where('slug',$slug)->first();
        if (empty($title)) {

            return redirect('/home')->with('error','Title not found.');
        }
        $reviews = $title->reviews()->where('review','!=','')->paginate(20);
        $recent_added = Title::orderBy('created_at','desc')->take(6)->get();
        $top_rated = Title::where('type','movie')->orderBy('rate','desc')->take(6)->get();
        $ref = 'person';
        return view('users.title_reviews',compact('reviews','title','recent_added','top_rated','ref'));
    }
}
