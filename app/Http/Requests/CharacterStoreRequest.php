<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Character;
use App\Models\File;
class CharacterStoreRequest extends FormRequest
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
            'picture'=>'required|image',
            'pictures'=>'array',
            'pictures.*'=>'image',
        ];
    }

    public function persist(){
        $input = $this->all();
        $input['slug'] = getSlug($input['name'],Character::class);
        if($this->hasFile('picture')){
            $input['picture'] = $this->file('picture')->store('/uploads/images/characters/pictures');
        }
        $character = Character::create($input);
        if($pictures=$this->file('pictures')){
            $pictures=File::uploadMultiple($pictures,'/uploads/images/characters/galary/'.$character->id,'image');
        }
        $character->files()->attach($pictures);
    }
}
