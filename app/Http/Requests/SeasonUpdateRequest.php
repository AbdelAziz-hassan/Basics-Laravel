<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Season;
use App\Models\File;
class SeasonUpdateRequest extends FormRequest
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
            'title_id'=>'required',
            'picture'=>'image',
            'pictures'=>'array',
            'pictures.*'=>'image',
            'videos'=>'array',
            'videos.*'=>'mimes:mp4,mov,ogg,qt | max:20000',
            'release_date'=>'required|date',
            'episodes_numbers'=>'required',
        ];
    }
    public function persist($id){
        $input = $this->all();
        $season=Season::find($id);
        if (empty($season)) {

            return redirect(route('seasons.index'))->with('error','Season not found.');
        }
        if($input['title']!=$season->title)
            $input['slug'] = getSlug($input['title'],Season::class);
        if($this->hasFile('picture')){
            $input['picture'] = $this->file('picture')->store('/uploads/images/titles/pictures');
        }
        $season->update($input);
    }
}
