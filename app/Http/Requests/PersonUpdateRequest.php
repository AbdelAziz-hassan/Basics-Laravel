<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Person;
class PersonUpdateRequest extends FormRequest
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
            'picture'=>'image',
            'birth_date'=>'required|date',
        ];
    }
    public function persist($id){
        $input = $this->all();
        $person=Person::find($id);
        if (empty($person)) {

            return redirect(route('persons.index'))->with('error','Person not found.');
        }
        if($input['name']!=$person->name)
            $input['slug'] = getSlug($input['title'],Person::class);
        if($this->hasFile('picture')){
            $input['picture'] = $this->file('picture')->store('/uploads/images/persons/pictures');
        }
        $person->update($input);
    }
}
