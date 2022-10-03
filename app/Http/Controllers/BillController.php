<?php

namespace App\Http\Controllers;

use App\Http\Resources\Bill\BillResource;
use App\Imports\BillsImport;
use App\Models\Bill;
use App\Models\BillData;
use App\Models\ItemReturn;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class BillController extends Controller
{
    public function getBillsById($id)
    {
        $bill = Bill::where('id',$id)->first();
        return new BillResource($bill);
    }
    public function getBillsByUser($id)
    {
//        $bill = Bill::with('users');

            if(filter_var($id, FILTER_VALIDATE_INT) !== false) {
                $bill = Bill::whereHas('users', function ($query) use ($id) {
                    $query->where('user_id', $id);
                })->get();
            }
            else
                $bill = Bill::whereHas('users', function ($query) use ($id) {
                    $query->where('username', $id);
                })->get();

        return BillResource::collection($bill);
    }
    public function import(Request $request) {
//        $this->validate($request, [
//            'select_file'  => 'required|mimes:xls,xlsx'
//        ]);
        $path = $request->file('select_file')->getRealPath();
// $data = Excel::load($path, function($reader) {})->get();
        $data = Excel::import(new BillsImport(), $path);
        return 'Excel Data Imported successfully.';
    }

    public function editBillData($id,Request $request)
    {
        $data = BillData::where('id',\request('column_id'))->where('bill_id',$id)->first();

        if(isset($request->itemMissing)){
            $data->update([
                "itemMissing" => $request->itemMissing,
            ]);
        }
        if(isset($request->wrongItem)){
            $data->update([
                "wrongItem" =>  $request->wrongItem,
                "nameOfCorrectedItem" => $request->nameOfCorrectedItem
            ]);
        }
        if(isset($request->wrongQuantity)){
            $data->update([
                "wrongQuantity" => $request->wrongQuantity,
                "quantityNeeded" => $request->quantityNeeded,
            ]);
        }
        if(isset($request->damaged)){
            $data->update([
                "damaged" => $request->damaged,
                "typeOfDamage" => $request->typeOfDamage,
//                "damagedPhoto" => $request->damagedPhoto,
            ]);
        }
        if(isset($request->comments)){
            $data->update([
                "comments" => $request->comments,
            ]);
        }
        if(isset($request->accepted)){
            $data->update([
                "accepted" => $request->accepted,
            ]);
            Bill::where("id",$id)->update(['status'=>'accepted']);
        }
        if(isset($request->rejected)){
            $data->update([
                "rejected" => $request->rejected
            ]);
            Bill::where("id",$id)->update(['status'=>'rejected']);
        }
        return ;
    }

    public function returns($id)
    {
        foreach (request('returns') as $item)
        {
            if (isset($item['id'])){
                $data = ItemReturn::where('id',$item['id'])->first();
                $data->update([
                    'name' => $item['name'],
                    'amount' => $item['amount']
                ]);
            }
            else {
                $data = ItemReturn::create([
                    'bill_id' => $id,
                    'name' => $item['name'],
                    'amount' => $item['amount']
                ]);
                return 'Successfully added';
            }
        }
    }
}
