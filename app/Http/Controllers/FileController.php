<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FileController extends Controller
{
    //
    public function editSlider($id,Request $request){
        $this->validate($request,[
            'model'=>'required'
        ]);
        $model = $request['model'];
        $model_class = '\App\Models\\'.$model;
        $title = $model_class::find($id);
        if(!$title){
            return redirect()->back()->with('error','Data not found.');
        }
        return view('titles.edit_slider',compact('title','id','model'));
    }
    public function getTitleFiles($id,Request $request){
        $model_class = '\App\Models\\'.$request['model'];
        $title = $model_class::find($id);
        if(!$title){
            return redirect()->back()->with('error','Data not found.');
        }
        return view('titles.files',compact('title','id'));
    }

    public function deleteFile($id,Request $request){
        $file = \App\Models\File::find($id);
        if($file){
            $model_class = '\App\Models\\'.$request['model'];
            $title = $model_class::find($request['id']);
            if($title){
                $title->files()->detach($file->id);
                unlink(public_path().'/'.$file->path);
                return "true";
            }
            return "false";
        }
        return "false";
    }

    public function postSlider($id,Request $request){
        $model_class = '\App\Models\\'.$request['model'];
        $title = $model_class::find($id);
        if(!$title){
            return redirect()->back()->with('error','Data not found.');
        }
        if($photos=$request->file('files')){
            $photos=\App\Models\File::uploadMultiple([$photos],'/uploads/images/titles/galary/'.$title->id);
        }

        $title->files()->attach($photos);
        $result = collect([
            "success" => true,
            "id" => $photos[0]
        ]);
        return $result;
    }
}
