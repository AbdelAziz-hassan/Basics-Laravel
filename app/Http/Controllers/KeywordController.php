<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KeyWord;
class KeywordController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $keywords = KeyWord::paginate(10);
        return view('keywords.index',compact('keywords'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('keywords.create');
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
            'keyword'=>'unique:keywords',
        ]);
        $keyword = KeyWord::create($request->all());
        return redirect(route('keywords.index'));
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
        $keyword=KeyWord::find($id);
        if (empty($keyword)) {

            return redirect(route('keywords.index'))->with('error','Keyword not found.');
        }
        return view('keywords.edit',compact('keyword'));
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
            'keyword'=>'unique:keywords,keyword,' . $id,
        ]);
        $keyword=KeyWord::find($id);
        if (empty($keyword)) {

            return redirect(route('keywords.index'))->with('error','Keyword not found.');
        }
        $keyword->update($request->all());
        return redirect(route('keywords.index'))->with('success','Keyword Updated Successfully');
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
        $keyword=keyword::find($id);
        if (empty($keyword)) {

            return redirect(route('keywords.index'))->with('error','Keyword not found.');
        }
        $keyword->delete();
        return redirect(route('keywords.index'))->with('success','Keyword deleted successfully.');
    }
}
