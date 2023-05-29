<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProjectRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'title' => 'required|max:50',
            'description' => 'nullable|max:65535',
            //'cover_image' => 'required|url|max:255',
            'type_id' => 'nullable|exists:types,id',
            'technologies' => 'exists:technologies,id',
            'cover_image' => 'nullable|image|max:1024'


        ];
    }

    public function messages() {
        return [
            'title.required' => "Il titolo è richiesto",
            'title.max' => "Il titolo deve essere al massimo di 50 caratteri",
            'description.max' => "La descrizione deve essere lunga al massimo 65535 caratteri",
            'cover_image.required' => "Url dell'immagine richiesta",
            'cover_image.url' => "L'url dell'immagine deve essere valida, esempio: http://www.miosito.com",
            'cover_image.max' => "L'url dell'immagine deve essere al massimo di 255 caratteri",


        ];
    }
}
