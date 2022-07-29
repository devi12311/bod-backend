<?php

namespace App\Imports;

use App\Models\Bill;
use App\Models\BillData;
use App\Models\Client;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToCollection;

class BillsImport implements ToCollection
{
    /**
     * @param Collection $rows
     * @return void
     */
    public function collection(Collection $rows)
    {
        unset($rows[0],$rows[1]);

            $client = Client::create([
                'CLIENT_ID' => $rows[2][0],
                'CLIENT_NUMBER' => $rows[2][1],
                'CLIENT_NAME' => $rows[2][2],
                'CLIENT_ADR_STREET_NAME' => $rows[2][3],
                'CLIENT_ADR_STREET_NR' => $rows[2][4],
                'CLIENT_ADR_ZIPCODE' => $rows[2][5],
                'CLIENT_ADR_CITY' => $rows[2][6],
                'CLIENT_ADR_STATE' => $rows[2][7],
                'CLIENT_ADR_COUNTRY' => $rows[2][8],
                'CLIENT_PHONE' => $rows[2][9],
                'CLIENT_EMAIL' => $rows[2][10],
            ]);

            $bill = Bill::create([
                'client_id' => $client['id'],
                'RECEIVER' => $rows[2][11],
                'TRUCK_DRIVER' => $rows[2][12],
                'PRINTED_AT' => $rows[2][13],
                'BOD_ORDER_NUMBER_ERP' => $rows[2][14],
                'BOD_WEBSHOP_ORDER_ID' => $rows[2][15],
                'BOD_ORDER_DATE' => $rows[2][16],
                'BOD_NR_Bill_OF_DELIVERY' => $rows[2][17],
                'BOD_Delivery_Date' => $rows[2][18],
                'BOD_DELIVERY_TOUR' => $rows[2][19],
                'BOD_DELIVERY_INSTRUCTION' => $rows[2][20],
                'DISCOUNT' => $rows[2][28],
                'DISCOUNT_INCLUDED' => $rows[2][29],
                'TOTAL_WITHOUT_VAT' => $rows[2][30],
                'TOTAL_WITH_VAT' => $rows[2][31],
            ]);

            //Create receiver
        $receiverFound = User::where('username',$rows[2][11]);
        if($receiverFound->count() <= 0) {
            $receiver = User::create([
                'username' => $rows[2][11],
            ]);
            $receiver->assignRole('receiver');
            $bill->users()->attach($receiver['id']);
        }else{
            $bill->users()->attach($receiverFound->first()->id);
        }
        //Create truck driver
        $truck_driverFound = User::where('username',$rows[2][12]);
        if ($truck_driverFound->count() <= 0) {
            $truck_driver = User::create([
                'username' => $rows[2][12],
            ]);
            $truck_driver->assignRole('truck_driver');
            $bill->users()->attach($truck_driver['id']);
        }else{
            $bill->users()->attach($truck_driverFound->first()->id);
        }
        //Create Sender
        $senderFound = User::where('username',request('username'));
        if ($senderFound->count() <= 0) {
            $sender = User::create([
                'username' => request('username'),
            ]);
            $sender->assignRole('sender');
            $bill->users()->attach($sender['id']);
        }else{
            $bill->users()->attach($senderFound->first()->id);
        }
        //Bill items
            foreach ($rows as $row) {
                BillData::create([
                    'bill_id' => $bill['id'],
                    'BOD_DELIVER_ITEM_NR' => $row[21],
                    'BOD_ITEM_DESCRIPTION' => $row[22],
                    'BOD_ORDER_AMOUNT' => $row[23],
                    'BOD_ORDER_UNIT' => $row[24],
                    'PRICE' => $row[25],
                    'BOD_Deliver_AMOUNT' => $row[26],
                    'BOD_DELIVER_UNIT' => $row[27],
                ]);
            }
    }
}
