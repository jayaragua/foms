<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class logs extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        // return parent::toArray($request);
        return [
            'id' => $this->id,
            'created_at' => $this->created_at,
            'action' => $this->action,
            'user' => $this->user,

            'actionDtl' => $this->actionDtl,
            'details' => $this->details,
          
           
            
            
            
            
            

            
            

            

            
            
            
            

            





            




            // 'EnrIDNum', 'EnrCourse', 'EnrClass', 'EnrYear',
            // 'link' => $this->categorylink,
        ];
    }
}
