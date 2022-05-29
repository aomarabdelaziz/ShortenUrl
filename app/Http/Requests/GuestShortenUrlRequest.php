<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GuestShortenUrlRequest extends FormRequest
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
            'destination_url' => 'string|url'
        ];
    }

    public function messages()
    {
        return [

            'destination_url.string' => 'The provided link must be a string',
             'destination_url.url' => 'The provided link must be a valid url'

        ];
    }
}
