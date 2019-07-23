<?php

namespace App\Http\Requests\API;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Title;

class TitleStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        /*for other video extentions 
        *'videos.*'=>'mimetypes:video/x-ms-asf,video/x-flv,video/mp4,application/x-mpegURL,video/MP2T,video/3gpp,video/quicktime,video/x-msvideo,video/x-ms-wmv,video/avi',
        */
        return [
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
        ];
    }

    public function persist(){
        $input = $this->all();
        $input['slug'] = getSlug($input['title'],Title::class);
        if($this->hasFile('picture')){
            $input['picture'] = $this->file('picture')->store('/uploads/images/titles/pictures');
        }
        $title = Title::create($input);
        $title->categories()->sync($input['category_ids']);
        $title->keywords()->sync($input['keyword_ids']);
        if($pictures=$this->file('pictures')){
            $pictures=\App\Models\File::uploadMultiple($pictures,'/uploads/images/titles/galary/'.$title->id,'image');
        }
        if($videos=$this->file('videos')){
            $videos=\App\Models\File::uploadMultiple($videos,'/uploads/images/titles/galary/'.$title->id,'video');
        }

        $title->files()->attach($pictures);
        $title->files()->attach($videos);
    }
}
