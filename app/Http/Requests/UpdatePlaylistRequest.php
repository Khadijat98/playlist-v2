<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePlaylistRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'playlist_name' => 'max:255|string',
            // 'created_by' => 'max:255|string',
            'description' => 'max:500|string',
            'playlist_image' => 'max:255|url',
            'songs' => 'array|min:1|max:30',
            'songs.*' => 'string'
        ];
    }
}
