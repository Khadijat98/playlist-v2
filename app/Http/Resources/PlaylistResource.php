<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PlaylistResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'playlist_name' => $this->playlist_name,
            'created_by' => $this->created_by,
            'description' => $this->description,
            'playlist_image' => $this->playlist_image,
            'songs' => $this->songs,
        ];
    }
}
