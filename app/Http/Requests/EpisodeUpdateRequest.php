<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Episode;
class EpisodeUpdateRequest extends FormRequest
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
            'picture'=>'image',
            'pictures'=>'array',
            'pictures.*'=>'image',
            'videos'=>'array',
            'videos.*'=>'mimes:mp4,mov,ogg,qt | max:20000',
            'release_date'=>'required|date',
        ];
    }
    public function persist($id){
        $input = $this->all();
        $episode=Episode::find($id);
        if (empty($episode)) {

            return redirect(route('titles.index'))->with('error','Episode not found.');
        }
        if($input['title']!=$episode->title)
            $input['slug'] = getSlug($input['title'],Episode::class);
        if($this->hasFile('picture')){
            $input['picture'] = $this->file('picture')->store('/uploads/images/titles/pictures');
        }
        $episode->update($input);
    }
}
