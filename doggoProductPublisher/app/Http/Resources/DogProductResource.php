<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class DogProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'title' => $this->title,
            'body_html' => $this->body_html,
            'vendor' => $this->vendor,
            'product_type' => $this->product_type,
            'images' => DogProductImageResource::collection($this->images),
            'variants' => DogProductVariantResource::collection($this->variants),
        ];
    }
}
