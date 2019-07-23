<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Cast;
class CastStoreRequest extends FormRequest
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
            'character_id'=>'nullable|exists:characters,id|unique:casts,character_id,{$id},id,deleted_at,NULL',
            'person_id'=>'required|exists:persons,id',
        ];
    }

    public function persist(){
        $input = $this->all();
        $cast = Cast::create($input);
    }
}
