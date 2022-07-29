<?php

namespace App\Http\Controllers;

use App\Http\Resources\Bill\BillResource;
use App\Imports\BillsImport;
use App\Models\Bill;
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
}
