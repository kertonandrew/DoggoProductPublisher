<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class DogProductVariantResource extends JsonResource
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
            'option1' => $this->option1,
            'price' => $this->price,
            'sku' => $this->sku,
            'product' => new DogProductResource($this->product),
        ];
    }
}
