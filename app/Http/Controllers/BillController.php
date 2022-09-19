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
        return response()->json($bill);
    }
    public function getBillsByUser($id)
    {
//        $bill = Bill::with('users');

        $bill = Bill::whereHas('users', function($query) use ($id) {
            $query->where('user_id', $id);
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
        return back()->with('success', 'Excel Data Imported successfully.');
    }

    public function editBillData($id)
    {
        $data = BillData::where('id',\request('column_id'))->where('bill_id',$id)->first();

        $data->update([
            "itemMissing" => request('itemMissing'),
            "wrongItem" => request('wrongItem'),
            "nameOfCorrectedItem" => request('nameOfCorrectedItem'),
            "wrongQuantity" => request('wrongQuantity'),
            "quantityNeeded" => request('quantityNeeded'),
            "damaged" => request('damaged'),
            "typeOfDamage" => request('typeOfDamage'),
            "damagedPhoto" => request('damagedPhoto'),
            "comments" => request('comments'),
            "accepted" => request('accepted'),
            "rejected" => request('rejected')
        ]);
        dd($data);
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
                ItemReturn::create([
                    'bill_id' => $id,
                    'name' => $item['name'],
                    'amount' => $item['amount']
                ]);
            }
        }
    }
}
