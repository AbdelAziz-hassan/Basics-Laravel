<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Season;
use App\Models\Title;
use App\Http\Requests\SeasonStoreRequest;
use App\Http\Requests\SeasonUpdateRequest;
class SeasonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $seasons = Season::paginate(10);
        return view('seasons.index',compact('seasons'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->validate($request,[
            'title_id'=>'required',
        ]);
        //

        $title = Title::find($request['title_id']);
        if (empty($title)) {

            return redirect(route('titles.index'))->with('error','Title not found.');
        }
        return view('seasons.create',compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SeasonStoreRequest $request)
    {
        //
        $request->persist();
        return redirect(route('titles.show',$request['title_id']))->with('success','Season Saved Successfully');
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
        $season=Season::find($id);
        if (empty($season)) {

            return redirect(route('titles.index'))->with('error','Season not found.');
        }
        return view('seasons.show',compact('season'));
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
        $season = Season::find($id);
        if (empty($season)) {

            return redirect(route('titles.index'))->with('error','Season not found.');
        }
        $titles = Title::pluck('title','id');
        return view('seasons.edit',compact('season','titles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SeasonUpdateRequest $request, $id)
    {
        //
        $request->persist($id);
        return redirect(route('titles.show',$request['title_id']))->with('success','Season Saved Successfully');
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
        $season=Season::find($id);
        if (empty($season)) {

            return redirect(route('seasons.index'))->with('error','Season not found.');
        }
        $title_id = $season->series->id;
        $season->delete();
        return redirect(route('titles.show',$title_id))->with('success','Season deleted successfully.');
    }
    public function editSlider($id,Request $request){
        $model = 'Season';
        return getSlider($id, $model);
    }
    public function postSlider($id,Request $request){
        $model = 'Season';
        if($photos=$request->file('files')){
            $photos=\App\Models\File::uploadMultiple([$photos],'/uploads/images/titles/galary/'.$id);
        }
        return saveSlider($id,$model,$photos);
    }
}
