<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Episode;
class EpisodeStoreRequest extends FormRequest
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
        return [
            'title' => 'required',
            'duration' => 'required|numeric',
            'season_id'=>'required',
            'picture'=>'required|image',
            'pictures'=>'array',
            'pictures.*'=>'image',
            'videos'=>'array',
            'videos.*'=>'mimes:mp4,mov,ogg,qt | max:20000',
            'release_date'=>'required|date',
        ];
    }

    public function persist(){
        $input = $this->all();
        $input['slug'] = getSlug($input['title'],Episode::class);
        if($this->hasFile('picture')){
            $input['picture'] = $this->file('picture')->store('/uploads/images/titles/pictures');
        }
        $title = Episode::create($input);
        if($pictures=$this->file('pictures')){
            $pictures=File::uploadMultiple($pictures,'/uploads/images/titles/galary/'.$title->id.'/seasons','image');
        }
        if($videos=$this->file('videos')){
            $videos=File::uploadMultiple($videos,'/uploads/images/titles/galary/'.$title->id.'/seasons','video');
        }

        $title->files()->attach($pictures);
        $title->files()->attach($videos);
    }
}