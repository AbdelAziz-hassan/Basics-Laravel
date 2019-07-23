<?php
use Illuminate\Support\Str;

function getSlug($name,$model){
    $slug = Str::slug($name);
    $slugCount = count($model::whereRaw("slug REGEXP '^{$slug}(-[0-9]*)?$'")->get());
    if($model::where('slug',($slug.'-'.$slugCount))->first()){
        $slugCount =$slugCount +1;
    }
    return ($slugCount > 0) ? "{$slug}-{$slugCount}" : $slug;
}
function getSlider($id,$model){
    $model_class = '\App\Models\\'.$model;
    $title = $model_class::find($id);
    if(!$title){
        return redirect()->back()->with('error','Data not found.');
    }
    return view('titles.edit_slider',compact('title','id','model'));
}
function saveSlider($id, $model,$photos){
    $model_class = '\App\Models\\'.$model;
    $title = $model_class::find($id);
    if(!$title){
        return redirect()->back()->with('error','Data not found.');
    }
    $title->files()->attach($photos);
    $result = collect([
        "success" => true,
        "id" => $photos[0]
    ]);
    return $result;
}
?>