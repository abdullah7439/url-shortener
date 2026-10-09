<?php

namespace App\Http\Requests;

use App\Models\ShortUrl;
use Illuminate\Foundation\Http\FormRequest;

class StoreShortUrlRequest extends FormRequest
{
    public function authorize()
    {
        // Only Admin and Member can create short urls (see ShortUrlPolicy).
        return $this->user()->can('create', ShortUrl::class);
    }

    public function rules()
    {
        return [
            'original_url' => ['required', 'url:http,https', 'max:2048'],
        ];
    }

    public function messages()
    {
        return [
            'original_url.required' => 'Please enter the long URL.',
            'original_url.url' => 'Please enter a valid URL starting with http:// or https://',
            'original_url.max' => 'The URL may not be longer than 2048 characters.',
        ];
    }
}
