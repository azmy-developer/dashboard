<?php

namespace App\Http\Resources\Task;

use App\Http\Resources\Employee\EmployeeResource;
use Illuminate\Http\Resources\Json\JsonResource;

class TaskResource extends JsonResource
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

            'id'  => $this->id,
            'title'  => $this->title,
            'empolyee'  => EmployeeResource::make($this->employee),
            'active'  => $this->active,
            'created_at'  => $this->created_at,

        ];
    }
}
