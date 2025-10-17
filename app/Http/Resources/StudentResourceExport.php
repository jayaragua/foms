<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class StudentResourceExport extends JsonResource
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
            'StudID' => $this->StudID,
            'StudLName' => $this->StudLName,
            'StudFName' => $this->StudFName,
            'StudMName' => $this->StudMName,

            'StudSex' => $this->StudSex,
            'StudCStatus' => $this->StudCStatus,
            'StudBDate' => $this->StudBDate,
            'StudCNum' => $this->StudCNum,
            'email' => $this->email,
            'isGraduated' => $this->isGraduated,
            'TESGrant' => $this->TESGrant,
            
            
            'EnrIDNum' => $this->EnrIDNum,
            'EnrCourse' => $this->EnrCourse,
            'EnrYear' => $this->EnrYear,
            'EnrClass' => $this->EnrClass,
            'EnrTUnits' => $this->EnrTUnits,

            'CDesc' => $this->CDesc,
            'StudPFFName' => $this->StudPFFName,
            'StudPFLName' => $this->StudPFLName,
            'StudPFMName' => $this->StudPFMName,
            'StudPMMaidFName' => $this->StudPMMaidFName,
            'StudPMMaidLName' => $this->StudPMMaidLName,
            'StudPMMaidMName' => $this->StudPMMaidMName,
            // '4ps' => $this->4ps,
            'StudPMIncome' => $this->StudPMIncome,
            'StudPStr' => $this->StudPStr . ', ' . $this->Bgry_Name,
            // 'Bgry_Name' => $this->Bgry_Name,
            'City_Name' => $this->City_Name,
            'Prov_Name' => $this->Prov_Name,
            'AssTotDue' => $this->AssLecTot + $this->AssLabTot + $this->AssOthTot + $this->AssMiscTot,
            'StudPZip' => $this->StudPZip,
            'StudLRN' => $this->StudLRN,

            'TESGAY' => $this->TESGAY,
            'tesAwardNo' => $this->tesAwardNo,
            
            

            

            
            
            
            
            
            

            
            

            

            
            
            
            

            





            




            // 'EnrIDNum', 'EnrCourse', 'EnrClass', 'EnrYear',
            // 'link' => $this->categorylink,
        ];
    }
}
