<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\EpisodeStoreRequest;
use App\Http\Requests\EpisodeUpdateRequest;
use App\Models\Season;
use App\Models\Episode;
use App\Models\Title;
class EpisodeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->validate($request,[
            'season_id'=>'required',
        ]);
        //

        $season = Season::find($request['season_id']);
        if (empty($season)) {

            return redirect(route('titles.index'))->with('error','Season not found.');
        }
        return view('episodes.create',compact('season'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EpisodeStoreRequest $request)
    {
        //
        $request->persist();
        return redirect(route('seasons.show',$request['season_id']))->with('success','Episode Saved Successfully');
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
        $episode=Episode::find($id);
        if (empty($episode)) {

            return redirect(route('titles.show',$episode->season->series->id))->with('error','Season not found.');
        }
        return view('episodes.show',compact('episode'));
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
        $episode = Episode::find($id);
        $seasons = Season::pluck('title','id');
        return view('episodes.edit',compact('seasons','episode'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EpisodeUpdateRequest $request, $id)
    {
        //
        //
        $request->persist($id);
        return redirect(route('seasons.show',$request['season_id']))->with('success','Episode Saved Successfully');
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
        $episode=Episode::find($id);
        if (empty($episode)) {

            return redirect(route('titles.index'))->with('error','Episode not found.');
        }
        $season_id = $episode->season->id;
        $episode->delete();
        return redirect(route('seasons.show',$season_id))->with('success','Episode deleted successfully.');
    }
    public function editSlider($id,Request $request){
        $model = 'Episode';
        return getSlider($id, $model);
    }
    public function postSlider($id,Request $request){
        $model = 'Episode';
        if($photos=$request->file('files')){
            $photos=\App\Models\File::uploadMultiple([$photos],'/uploads/images/titles/galary/'.$id);
        }
        return saveSlider($id,$model,$photos);
    }
    public function review(Request $request){
        $episode = Episode::where('slug',$request['slug'])->first();
        $review = $episode->reviews()->where('created_by',\Auth::user()->id)->first();
        if($review){
            if(!$request['review'])
                $review->update(['rate'=>$request['rate']]);
            else
                $review->update(['rate'=>$request['rate'],'review'=>$request['review']]);
        }
        else
        {
            $episode->reviews()->create(['rate'=>$request['rate'],'review'=>$request['review'],'created_by'=>\Auth::user()->id]);
        }
        $this->updateReview($episode);
    }
    public function deleteReview(Request $request){
        $episode = Episode::where('slug',$request['slug'])->first();
        $review = $episode->reviews()->where('created_by',\Auth::user()->id)->first();
        $review->delete();
        $this->updateReview($episode);
        return "true";
    }
    public function updateReview($episode){
        $rate_count = count($episode->reviews()->pluck('rate'));
        $episode_rate_sum = array_sum($episode->reviews()->pluck('rate')->toArray());
        if($rate_count==0){
            $episode_rate=0;
        }
        else
        {
            $episode_rate = $episode_rate_sum/$rate_count;
        }
        $episode->rate=$episode_rate;
        $episode->save();
    }

    public function episode($title_slug,$slug){
        $title = Title::where('slug',$title_slug)->first();
        if(!$title){
            return redirect('/home')->with('error','Title not found');
        }
        $episode = Episode::where('slug',$slug)->first();
        if(!$episode){
            return redirect('/title/'.$title_slug)->with('error','Episode not found');
        }
        $stars = $title->stars;
        $recent_added = Title::orderBy('created_at','desc')->take(6)->get();
        $top_rated = Title::where('type','movie')->orderBy('rate','desc')->take(6)->get();
        $rate_count = count($episode->reviews()->pluck('rate'));
        if($rate_count>0){
            $rate = array_sum($episode->reviews()->pluck('rate')->toArray())/$rate_count;
        }
        else
            $rate=0;
        return view('users.episode',compact('title','episode','stars','recent_added','top_rated','rate'));
    }
    public function storeReview($slug,Request $request){
        $request['slug']=$slug;
        $this->review($request);
        return redirect()->back();
    }
}
