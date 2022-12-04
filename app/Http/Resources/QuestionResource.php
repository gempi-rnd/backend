<?php

namespace App\Http\Resources;

use App\Casts\JsonArray;
use App\Casts\Options;
use App\Models\Question;
use GuzzleHttp\Psr7\Response;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Response as HttpResponse;
use Illuminate\Support\Facades\Response as FacadesResponse;

class QuestionResource extends JsonResource
{
    public $status;
    public $message;

    public function __construct($status, $message, $resource)
    {
        parent::__construct($resource);
        $this->status  = $status;
        $this->message = $message;
    }

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'success'                   => $this->status,
            'message'                   => $this->message,
            'data'                      => $this->resource,
        ];
    }
}
