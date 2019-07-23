<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Cast;

class CastUpdateRequest extends FormRequest
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
            'title_id' => 'required|exists:titles,id',
            'role_id'=>'required|exists:roles,id',
            'character_id'=>'exists:characters,id|unique:casts,character_id,'.$this->segment('2').',id,deleted_at,NULL',
            'person_id'=>'required|exists:persons,id',
        ];
    }

    public function persist($id){
        $input = $this->all();
        $cast=Cast::find($id);
        if (empty($cast)) {

            return redirect(route('casts.index'))->with('error','Cast not found.');
        }
        $cast->update($input);
    }
}