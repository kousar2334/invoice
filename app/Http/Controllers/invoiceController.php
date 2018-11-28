<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\product;
use App\Invoice;

use Session;
session_start();
class invoiceController extends Controller
{
    public function index()
    {
     $product_info=product::get();
     return view('invoice')->with('product_info',$product_info);
    }
    public function store_invoice(Request $request)
    {
     $data=array();
     $data['customer_name']=$request->customer_name;
     $data['s_date']=$request->s_date;
     $data['product_code']=$request->product_code;
     $data['qty']=$request->qty;
     $data['total']=$request->total;
     $data['sub_total']=$request->sub_total;
     Invoice::insert($data);
     // Session::put('message','Invoice Added');
     // return Redirect('/');
    }
    public function view_product_info()
    {
     $product_code=input::get('product_code');
     $product_info=Product::where('product_code','=',$product_code)->get();
     return response()->json($product_info);
    }
    public function view_invoice(){
        $all_invoice=Invoice::get();
        return view('view_invoice')->with('invoice_data',$all_invoice);
    }
}
