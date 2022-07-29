<?php

namespace App\Http\Resources\Bill;

use App\Http\Resources\Client\ClientResource;
use Illuminate\Http\Resources\Json\JsonResource;

class BillResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id'=> $this->id,
            'RECEIVER'=> $this->RECEIVER,
            'TRUCK_DRIVER'=> $this->TRUCK_DRIVER,
            'PRINTED_AT'=> $this->PRINTED_AT,
            'BOD_ORDER_NUMBER_ERP'=> $this->BOD_ORDER_NUMBER_ERP,
            'BOD_WEBSHOP_ORDER_ID'=> $this->BOD_WEBSHOP_ORDER_ID,
            'BOD_ORDER_DATE'=> $this->BOD_ORDER_DATE,
            'BOD_NR_Bill_OF_DELIVERY'=> $this->BOD_NR_Bill_OF_DELIVERY,
            'BOD_Delivery_Date'=> $this->BOD_Delivery_Date,
            'BOD_DELIVERY_TOUR'=> $this->BOD_DELIVERY_TOUR,
            'BOD_DELIVERY_INSTRUCTION'=> $this->BOD_DELIVERY_INSTRUCTION,
            'DISCOUNT_%'=> $this->DISCOUNT,
            'DISCOUNT_INCLUDED'=> $this->DISCOUNT_INCLUDED,
            'TOTAL_WITHOUT_VAT'=> $this->TOTAL_WITHOUT_VAT,
            'TOTAL_WITH_VAT'=> $this->TOTAL_WITH_VAT,



            'client' => new ClientResource($this->client),
//            'user' => new UserResource($this->user)
        ];
    }
}
