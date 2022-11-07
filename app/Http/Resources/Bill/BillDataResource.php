<?php

namespace App\Http\Resources\Bill;

use App\Http\Resources\Client\ClientResource;
use Illuminate\Http\Resources\Json\JsonResource;

class BillDataResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id'=> $this->id,
            'bill_id'=> $this->bill_id,
            'BOD_DELIVER_ITEM_NR'=> $this->BOD_DELIVER_ITEM_NR,
            'BOD_ITEM_DESCRIPTION'=> $this->BOD_ITEM_DESCRIPTION,
            'BOD_ORDER_AMOUNT'=> $this->BOD_ORDER_AMOUNT,
            'BOD_ORDER_UNIT'=> $this->BOD_ORDER_UNIT,
            'PRICE'=> $this->PRICE,
            'BOD_Deliver_AMOUNT'=> $this->BOD_Deliver_AMOUNT,
            'BOD_DELIVER_UNIT'=> $this->BOD_DELIVER_UNIT
        ];
    }
}
