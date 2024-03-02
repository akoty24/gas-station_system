<?php

namespace App\Http\Controllers;

use App\Models\Deposit;
use Illuminate\Http\Request;

class DepositController extends Controller
{
    public function index(){
        $deposits=Deposit::all();
        return view('admin.pages.deposits.index',compact('deposits'));
    }
    public function create(){
        return view('admin.pages.deposits.create');
    }
    public function store(Request $request){
        $request->validate([
            'type' => 'required',
            'date' => 'required|date',
            'amount' => 'required|numeric',
            'notes' => 'nullable',
        ],[
            'amount.required' => 'حقل المبلغ مطلوب.',
            'amount.numeric' => 'يجب أن يكون المبلغ رقمًا.',
            'date.required' => 'حقل التاريخ مطلوب.',
            'date.date' => 'يجب أن يكون التاريخ تاريخًا.',
            'type.required' => 'حقل النوع مطلوب.',
            
        ]);

        Deposit::create($request->all());
        return redirect()->route('deposits.index')->with('success','تمت العملية بنجاح');
    }
    public function edit($id){
        $deposit=Deposit::find($id);
        return view('admin.pages.deposits.edit',compact('deposit'));
    }
    public function update(Request $request,$id){
        $request->validate([
            'type' => 'required',
            'date' => 'required|date',
            'amount' => 'required|numeric',
            'notes' => 'nullable',
        ]);
        $Deposit=Deposit::find($id);
        $Deposit->update($request->all());
        return redirect()->route('deposits.index')->with('success','تمت العملية بنجاح');
    }

}
