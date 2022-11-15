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
        $path = $request->file('select_file');
// $data = Excel::load($path, function($reader) {})->get();
        $data = Excel::import(new BillsImport(), $path);

        return 'Excel Data Imported successfully.';
    }

    public function editBillData($id,Request $request)
    {
            foreach ($request['data'] as $data){
            $column = BillData::where('id',$data['column_id'])->where('bill_id',$id)->first();
            if(isset($data['itemMissing'])){
                $column->update([
                    "itemMissing" => $data['itemMissing'],
                ]);
            }
            if(isset($data['wrongItem'])){
                $column->update([
                    "wrongItem" =>  $data['wrongItem'],
                    "nameOfCorrectedItem" => $data['nameOfCorrectedItem']
                ]);
            }
            if(isset($data['wrongQuantity'])){
                $column->update([
                    "wrongQuantity" => $data['wrongQuantity'],
                    "quantityNeeded" => $data['quantityNeeded'],
                ]);
            }
            if(isset($data['damaged'])){
                $column->update([
                    "damaged" => $data['damaged'],
                    "typeOfDamage" => $data['typeOfDamage'],
    //                "damagedPhoto" => $request->damagedPhoto,
                ]);
            }
            if(isset($data['comments'])){
                $column->update([
                    "comments" => $data['comments'],
                ]);
            }
            if(isset($data['accepted'])){
                $column->update([
                    "accepted" => $data['accepted'],
                ]);
                Bill::where("id",$id)->update(['status'=>'accepted']);
            }
            if(isset($data['rejected'])){
                $column->update([
                    "rejected" => $data['rejected']
                ]);
                Bill::where("id",$id)->update(['status'=>'rejected']);
            }
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
