<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Title;
use App\Models\File;
use App\Models\KeyWord;
use App\Models\Category;
use App\Models\Review;
use App\Http\Requests\TitleStoreRequest;
use App\Http\Requests\TitleUpdateRequest;
use Illuminate\Support\Facades\Validator;
class TitleAPIController extends Controller
{
    //
    public function index(Request $request)
    {
        //
        $limit=$request['limit']??'5';
        $offset=$request['offset']??'0';
        $titles = Title::filter($request->all())->skip($offset)->limit($limit)->get();
        return $this->sendResponse($titles, 0,'Titles Retrieved Successfully');
    }

    public function store(Request $request){
        $input = $request->all();
        if(isset($input['category_ids']))
            $input['category_ids'] = json_decode($input['category_ids']);
        if(isset($input['keyword_ids']))
            $input['keyword_ids'] = json_decode($input['keyword_ids']);
        $validation = Validator::make($input,[ 
            'title' => 'required',
            'duration' => 'required|numeric',
            'type'=>'required',
            'picture'=>'required',
            'pictures'=>'array',
            'pictures.*'=>'string',
            'videos'=>'array',
            'release_date'=>'required|date',
            'category_ids'=>'required|array',
            'category_ids.*'=>'required|numeric',
            'keyword_ids'=>'required|array',
            'keyword_ids.*'=>'required|numeric',
        ]);
        if($validation->fails())
        {
            $errors = $validation->errors();
            return $this->sendError($errors->first(),-1);       
        }
        $input['slug'] = getSlug($input['title'],Title::class);
        if($request->picture){
            $input['picture']=File::uploadBase64($request['picture']);
        }
        $title = Title::create($input);
        return $this->sendResponse($title, 0,'Title Saved Successfully');
    }

    public function update($id,Request $request){
        $input = $request->all();
        if(isset($input['category_ids']))
            $input['category_ids'] = json_decode($input['category_ids']);
        if(isset($input['keyword_ids']))
            $input['keyword_ids'] = json_decode($input['keyword_ids']);
        $validation = Validator::make($input,[ 
            'title' => 'required',
            'duration' => 'required|numeric',
            'type'=>'required',
            'pictures'=>'array',
            'pictures.*'=>'string',
            'videos'=>'array',
            'release_date'=>'required|date',
            'category_ids'=>'required|array',
            'category_ids.*'=>'required|numeric',
            'keyword_ids'=>'required|array',
            'keyword_ids.*'=>'required|numeric',
        ]);
        if($validation->fails())
        {
            $errors = $validation->errors();
            return $this->sendError($errors->first(),-1);       
        }
        $title=Title::find($id);
        if (empty($title)) {
            return $this->sendError('Title not found',-1);
        }
        if($request->picture){
            $input['picture']=File::uploadBase64($request['picture']);
        }
        if($input['title']!=$title->title)
            $input['slug'] = getSlug($input['title'],Title::class);
        $title->update($input);
        return $this->sendResponse($title, 0,'Title updated Successfully');
        
    }

    public function destroy($id)
    {
        //
        $title=Title::find($id);
        if (empty($title)) {
            return $this->sendError('Title not found',-1);
        }
        $cast = $title->casts()->delete();
        $title->delete();
        return $this->sendResponse([], 0,'Title deleted Successfully');

    }

    public function postSlider($id, Request $request){
        $title = Title::find($id);
        if(!$title){
            return $this->sendError('Title not found',-1);
        }
        $model = 'Title';
        if($request['file']){
            
            $photos=\App\Models\File::uploadBase64Files([$request['file']],'/uploads/images/titles/galary/'.$id);
        }
        $attached = saveSlider($id,$model,$photos);
        return $this->sendResponse([], 0,'Title media saved successfully');         
    }

    public function getSlider($id){
        $title = Title::find($id);
        if(!$title){
            return $this->sendError('Title not found',-1);
        }
        $slider = $title->files;
        return $this->sendResponse($slider, 0,'Title media saved successfully');         
    }

    public function getCasts($id){
        $title = Title::find($id);
        if(!$title){
            return $this->sendError('Title not found',-1);
        }
        $writers = $title->writers;
        $directors = $title->directors;
        $stars = $title->stars;
        return $this->sendResponse(['writers'=>$writers,'direcotrs'=>$directors,'stars'=>$stars], 0,'Title media saved successfully');         
       

    }
}
