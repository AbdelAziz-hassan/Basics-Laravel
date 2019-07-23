<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Title;
use App\Models\KeyWord;
use App\Models\Category;
use App\Models\Review;
use App\Http\Requests\TitleStoreRequest;
use App\Http\Requests\TitleUpdateRequest;
use Illuminate\Support\Facades\Validator;
class TitleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $categories=Category::pluck('name','id');
        $titles = Title::filter($request->all())->paginateFilter(10);
        return view('titles.index',compact('titles','categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $categories = Category::pluck('name','id');
        $keywords = KeyWord::pluck('keyword','id');
        return view('titles.create',compact('categories','keywords'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TitleStoreRequest $request)
    {
        //
        $request->persist();
        return redirect(route('titles.index'))->with('success','Title Saved Successfully');
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
        $title=Title::find($id);
        $seasons = $title->seasons()->paginate(10);
        $casts = $title->casts()->paginate(10);
        if (empty($title)) {

            return redirect(route('titles.index'))->with('error','Title not found.');
        }
        return view('titles.show',compact('title','seasons','casts'));
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
        $title = Title::find($id);
        $categories = Category::pluck('name','id');
        $keywords = KeyWord::pluck('keyword','id');
        return view('titles.edit',compact('title','categories','keywords'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TitleUpdateRequest $request, $id)
    {
        //
        $request->persist($id);
        return redirect(route('titles.index'))->with('success','Title Updated Successfully');
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
        $title=Title::find($id);
        if (empty($title)) {

            return redirect(route('titles.index'))->with('error','Title not found.');
        }
        $cast = $title->casts()->delete();
        $title->delete();
        return redirect(route('titles.index'))->with('success','Title deleted successfully.');
    }
    public function editSlider($id,Request $request){
        $model = 'Title';
        return getSlider($id, $model);
    }
    public function postSlider($id,Request $request){
        $model = 'Title';
        if($photos=$request->file('files')){
            $photos=\App\Models\File::uploadMultiple([$photos],'/uploads/images/titles/galary/'.$id);
        }
        return saveSlider($id,$model,$photos);
    }
    public function titleBySlug($slug){
        $title = Title::where('slug',$slug)->first();
        if (empty($title)) {

            return redirect('/home')->with('error','Title not found.');
        }
        $director = $title->directors;
        $writer = $title->writers;
        $stars = $title->stars->take(20);
        $recent_added = Title::orderBy('created_at','desc')->take(6)->get();
        $top_rated = Title::where('type',$title->type)->orderBy('rate','desc')->take(6)->get();
        return view('users.title',compact('title','director','writer','stars','recent_added','top_rated'));
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
            return redirect()->back()->with('error','No review provided');
        }
        $title = Title::where('slug',$request['slug'])->first();
        $review = $title->reviews()->where('created_by',\Auth::user()->id)->first();
        if($review){
            if(!$request['review'])
                $review->update(['rate'=>$request['rate']]);
            else
                $review->update(['rate'=>$request['rate'],'review'=>$request['review']]);
        }
        else
        {
            $review = $title->reviews()->create(['rate'=>$request['rate'],'review'=>$request['review'],'created_by'=>\Auth::user()->id]);
        }
        if($files=$request->file('files')){
            $files=\App\Models\File::uploadMultiple($files,'/uploads/images/reviews/files/'.$review->id,'files');
        }
        $review->files()->attach($files);
        $this->updateReview($title);
    }
    public function deleteReview(Request $request){
        $title = Title::where('slug',$request['slug'])->first();
        $review = $title->reviews()->where('created_by',\Auth::user()->id)->first();
        $review->delete();
        $this->updateReview($title);
        return "true";
    }

    public function updateReview($title){
        $rate_count = count($title->reviews()->pluck('rate'));
        $title_rate_sum = array_sum($title->reviews()->pluck('rate')->toArray());
        if($rate_count==0){
            $title_rate=0;
        }
        else
        {
            $title_rate = $title_rate_sum/$rate_count;
        }
        $title->rate=$title_rate;
        $title->save();
    }

    public function storeReview($slug,Request $request){
        $request['slug']=$slug;
        $this->review($request);
        return redirect()->back();
    }

    public function fullcast($slug){
        $title = Title::where('slug',$slug)->first();
        if (empty($title)) {

            return redirect('/home')->with('error','Title not found.');
        }
        $director = $title->directors;
        $writer = $title->writers;
        $stars = $title->stars;
        $recent_added = Title::orderBy('created_at','desc')->take(6)->get();
        $top_rated = Title::where('type','movie')->orderBy('rate','desc')->take(6)->get();
        return view('users.fullcast',compact('title','director','writer','stars','recent_added','top_rated'));
    }
    public function titleReviews($slug){
        $title = Title::where('slug',$slug)->first();
        if (empty($title)) {

            return redirect('/home')->with('error','Title not found.');
        }
        $reviews = $title->reviews()->where('review','!=','')->paginate(20);
        $recent_added = Title::orderBy('created_at','desc')->take(6)->get();
        $top_rated = Title::where('type','movie')->orderBy('rate','desc')->take(6)->get();
        $ref = 'title';
        return view('users.title_reviews',compact('reviews','title','recent_added','top_rated','ref'));
    }
    public function episodes($slug,Request $request){
        $title = Title::where('slug',$slug)->first();
        if (empty($title)) {

            return redirect('/home')->with('error','Title not found.');
        }
        $this->validate($request,[
            'season'=>'required',
        ]);
        $season = $title->seasons()->where('slug',$request['season'])->first();
        if(!$season){
            return redirect()->back()->with('error','Season not found');
        }
        $recent_added = Title::orderBy('created_at','desc')->take(6)->get();
        $top_rated = Title::where('type','movie')->orderBy('rate','desc')->take(6)->get();
        $season_numbers = [];
        foreach($title->seasons as $key=>$title_season){
                array_push($season_numbers,['number'=>$key+1,'slug'=>$title_season->slug]);
        }
        return view('users.episodes',compact('title','season','recent_added','top_rated','season_numbers'));
    }

    public function top(){
        $titles = Title::where('type','movie')->orderBy('rate','desc')->take(50)->get();
        $recent_added = Title::orderBy('created_at','desc')->take(6)->get();
        $categories = Category::all();
        $type='movie';
        return view('users.toprated',compact('titles','recent_added','categories','type'));
    }
    public function search(Request $request){
        $category = Category::where('slug',$request['categories'])->first();
        if(!$category){
            return redirect('/');
        }
        $request['category']=$category->id;
        $titles = Title::filter($request->all())->simplePaginateFilter(50);
        $recent_added = Title::orderBy('created_at','desc')->take(6)->get();
        $categories = Category::all();
        return view('users.top_gener',compact('titles','recent_added','categories'));
    }
    public function toptv(){
        $titles = Title::where('type','series')->orderBy('rate','desc')->take(50)->get();
        $recent_added = Title::orderBy('created_at','desc')->take(6)->get();
        $categories = Category::all();
        $type='series';
        return view('users.toprated',compact('titles','recent_added','categories','type'));
    }

    public function find(Request $request){
        $this->validate($request,[
            'type'=>'required',
        ]);
        $type= $request['type'];
        $search= $request['search'];
        $titles=collect();
        $names=collect();
        $keywords=collect();
        if($type=='all'){
            $titles = Title::where('title','LIKE','%'.$search.'%')->take(2)->get();
            $names = \App\Models\Person::where('name','LIKE','%'.$search.'%')->take(2)->get();
            $keywords = KeyWord::Where('keyword','LIKE','%'.$search.'%')->take(2)->get();
        }
        elseif($type=='titles'){
            $titles = Title::where('title','LIKE','%'.$search.'%')->paginate(50);
        }
        elseif($type=='names'){
            $names = \App\Models\Person::where('name','LIKE','%'.$search.'%')->paginate(50); 
        }
        elseif($type=='keywords'){
            $keywords = Keyword::where('keyword','LIKE','%'.$search.'%')->pluck('id');
            $titles = Title::whereHas('keywords',function ($q) use ($keywords)
            {
                return $q->whereIn('keyword_id', $keywords);
            })->paginate(10);
            $type="titles";
        }
        elseif($type=='keywords_all'){
            $keywords = Keyword::where('keyword','LIKE','%'.$search.'%')->paginate(10);
        }
        $recent_added = Title::orderBy('created_at','desc')->take(6)->get();
        $categories = Category::all();
        return view('users.find',compact('titles','names','type','search','recent_added','categories','keywords'));
    }
}
