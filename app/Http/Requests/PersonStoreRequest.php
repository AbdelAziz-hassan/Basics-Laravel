<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Person;
use App\Models\File;
class PersonStoreRequest extends FormRequest
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
            'birth_place' => 'required',
            'picture'=>'required|image',
            'pictures'=>'array',
            'pictures.*'=>'image',
            'videos'=>'array',
            'videos.*'=>'mimes:mp4,mov,ogg,qt | max:20000',
            'birth_date'=>'required|date',
        ];
    }

    public function persist(){
        $input = $this->all();
        $input['slug'] = getSlug($input['name'],Person::class);
        if($this->hasFile('picture')){
            $input['picture'] = $this->file('picture')->store('/uploads/images/persons/pictures');
        }
        $person = Person::create($input);
        if($pictures=$this->file('pictures')){
            $pictures=File::uploadMultiple($pictures,'/uploads/images/persons/galary/'.$person->id,'image');
        }
        if($videos=$this->file('videos')){
            $videos=File::uploadMultiple($videos,'/uploads/images/persons/galary/'.$person->id,'video');
        }

        $person->files()->attach($pictures);
        $person->files()->attach($videos);
    }
}