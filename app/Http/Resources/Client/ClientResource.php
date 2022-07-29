<?php

namespace App\Http\Resources\Client;

use Illuminate\Http\Resources\Json\JsonResource;

class ClientResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id'=> $this->id,
            'CLIENT_ID'=> $this->CLIENT_ID,
            'CLIENT_NUMBER'=> $this->CLIENT_NUMBER,
            'CLIENT_NAME'=> $this->CLIENT_NAME,
            'CLIENT_ADR_STREET_NAME'=> $this->CLIENT_ADR_STREET_NAME,
            'CLIENT_ADR_STREET_NR'=> $this->CLIENT_ADR_STREET_NR,
            'CLIENT_ADR_ZIPCODE'=> $this->CLIENT_ADR_ZIPCODE,
            'CLIENT_ADR_CITY'=> $this->CLIENT_ADR_CITY,
            'CLIENT_ADR_STATE'=> $this->CLIENT_ADR_STATE,
            'CLIENT_ADR_COUNTRY'=> $this->CLIENT_ADR_COUNTRY,
            'CLIENT_PHONE'=> $this->CLIENT_PHONE,
            'CLIENT_EMAIL%'=> $this->CLIENT_EMAIL,
        ];
    }
}
