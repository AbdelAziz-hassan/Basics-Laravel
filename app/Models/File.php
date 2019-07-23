<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class File extends Model
{
    use SoftDeletes;

    public $table = 'files';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'name',
        'extension',
        'type',
        'path',
        'size',
        'created_by',
    ];

    public static $rules = [
        
    ];

    public static function store($path,$old=false)
    {
            $file=new File;
            $file->name=basename($path);
            if($old){
                $file->path=parse_url($path, PHP_URL_PATH);
            }
            else{
                $file->size=filesize($path);           
                $file->path=explode("public",str_replace('\\', '/', $path))[1];
                $file->type=mime_content_type($path);
            }
            $file->extension=pathinfo($path, PATHINFO_EXTENSION);
            $file->save();
            return $file->id;
    }
    public static function getFileByPath($path='')
    {
        if(is_array($path)){
            foreach ($path as $key=>$pth) {
                $path[$key]=parse_url($pth,PHP_URL_PATH);;
            }
             return File::whereIn('path',$path)->get();
        }
        $file= File::where('path',parse_url($path,PHP_URL_PATH))->first();
        if($file)
            return $file;
       return $file=File::store($path,true);
    }

    public static function upload($filesData,$destinationPath)
    {
            $id=array();
            foreach($filesData as $fileData ){
                $file=new File;
                $file->name=rand(11111,99999).$fileData->getClientOriginalName();
                $file->extension=$fileData->getClientOriginalExtension();
                $file->size=$fileData->getClientSize();
                $file->path=$destinationPath.'/'.$file->name;
                $fileData->move($destinationPath,$file->name);
                $file->save();
                array_push($id,$file->id);
                
            }
            return $id;
    }
    public static function uploadMultiple($filesData,$path,$type='file')
    {
        $id=array();
        foreach ($filesData as $fileData) {
            $file=new File;
            $file->name=rand(11111,99999).$fileData->getClientOriginalName();
            $file->extension=$fileData->getClientOriginalExtension();
            $file->size=$fileData->getClientSize();
            $file->path=$fileData->store($path);
            $file->type=explode('/',$fileData->getMimeType())[0];
            $file->created_by=\Auth::user()->id;
            $file->save();
            array_push($id,$file->id);
        }
        return $id;
    }

    public static function uploadBase64($file){
        $new_data=explode(";",$file);
        $type=$new_data[0];
        $imgex = explode("/",$type);
        $extension = $imgex[1];
        $data=explode(",",$new_data[1]);
        $image = base64_decode($data[1]);
        $imageName = 'image'.time().'.'.$extension;
        $destPath = public_path().'/uploads/images/titles/pictures/'.$imageName;
        $success =file_put_contents($destPath,$image);
        $destPath = str_replace(public_path().'/', "", $destPath);
        return $destPath;
    }

    public static function uploadBase64Files($files){
        $id=array();
        foreach ($files as $fileData) {
            $new_data=explode(";",$fileData);
            $type=$new_data[0];
            $imgex = explode("/",$type);
            $extension = $imgex[1];
            $data=explode(",",$new_data[1]);
            $image = base64_decode($data[1]);
            $imageName = 'image'.time().'.'.$extension;
            $destPath = public_path().'/uploads/images/titles/pictures/'.$imageName;
            $success =file_put_contents($destPath,$image);
            $destPath = str_replace(public_path().'/', "", $destPath);

            $file=new File;
            $file->name=$imageName;
            $file->extension=$extension;
            $file->path=$destPath;
            $file->type=$imgex[0];
            $file->created_by=\Auth::user()->id;
            $file->save();
            array_push($id,$file->id);
        }
        return $id;
    }


}
