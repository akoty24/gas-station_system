<?php

namespace App\Http\Controllers;

use App\Models\Device;
use Illuminate\Http\Request;

class DeviceController extends Controller
{
    public function index(){
        $devices=Device::all();
        return view('admin.pages.devices.index',compact('devices'));
    }
    public function create(){
        return view('admin.pages.devices.create');
    }
    public function store(Request $request){
        Device::create($request->all());
        return redirect()->route('devices.index')->with('success','تمت العملية بنجاح');
    }
    public function edit($id){
        $device=Device::find($id);
        return view('admin.pages.devices.edit',compact('device'));
    }
    public function update(Request $request,$id){
        $device=Device::find($id);
        $device->update($request->all());
        return redirect()->route('devices.index')->with('success','تمت العملية بنجاح');
    }

}
