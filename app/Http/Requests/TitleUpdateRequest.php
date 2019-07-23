<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Title;

class TitleUpdateRequest extends FormRequest
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
            'type'=>'required',
            'picture'=>'image',
            'release_date'=>'required|date',
            'category_ids'=>'required|array',
            'category_ids.*'=>'required|numeric',
            'keyword_ids'=>'required|array',
            'keyword_ids.*'=>'required|numeric',
        ];
    }

    public function persist($id){
        $input = $this->all();
        $title=Title::find($id);
        if (empty($title)) {

            return redirect(route('titles.index'))->with('error','Title not found.');
        }
        if($input['title']!=$title->title)
            $input['slug'] = getSlug($input['title'],Title::class);
        if($this->hasFile('picture')){
            $input['picture'] = $this->file('picture')->store('/uploads/images/titles/pictures');
        }
        $title->update($input);
        $title->categories()->sync($input['category_ids']);
        $title->keywords()->sync($input['keyword_ids']);
    }
}
