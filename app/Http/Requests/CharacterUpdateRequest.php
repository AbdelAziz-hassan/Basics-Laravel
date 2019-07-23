<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Character;
use App\Models\File;
class CharacterUpdateRequest extends FormRequest
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
            'name' => 'required',
            'picture'=>'image',
            'pictures'=>'array',
            'pictures.*'=>'image',
        ];
    }
    public function persist($id){
        $input = $this->all();
        $character=Character::find($id);
        if (empty($character)) {

            return redirect(route('characters.index'))->with('error','Character not found.');
        }
        if($input['name']!=$character->name)
            $input['slug'] = getSlug($input['name'],Character::class);
        if($this->hasFile('picture')){
            $input['picture'] = $this->file('picture')->store('/uploads/images/characters/pictures');
        }
        $character->update($input);
    }
}
