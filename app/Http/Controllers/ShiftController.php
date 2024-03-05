<?php

namespace App\Http\Controllers;

use App\Models\Device;
use App\Models\Readings;
use App\Models\Shift;
use App\Models\Total;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ShiftController extends Controller
{
    public function shift_day(){
        $devices = Device::all();
        $fuelTypes = Device::distinct('fuel_type')->pluck('fuel_type');

        $previousShift=Shift::latest()->first();
        if ($previousShift ){
            $previousReadings= $previousShift->readings()->get();
        }
      
        
        return view('Admin.pages.shifts.shift_day' ,get_defined_vars());
    }
    
public function index(){
        $shifts=Shift::orderBy('shift_date', 'desc')->get();
        return view('admin.pages.shifts.index',get_defined_vars());
    }
    public function store(Request $request) {
        
        // Start a database transaction
        DB::beginTransaction();
    
        try {
            // Validate the request data
            $validatedData = $request->validate([
                'shift_date' => 'required|date',
                'tax' => 'nullable',
                'expenses' => 'nullable',
                'went_out'=> 'nullable',
                'supply' => 'nullable',
                'start_readings.*' => 'required|numeric',
                'end_readings.*' => 'required|numeric',
                'defrance.*' => 'required|numeric',
                'value.*' => 'required|numeric',
                'total_defrance.*' => 'required|numeric',
                'total_value.*' => 'required|numeric',
                
            ]);
    
            // Create a new Shift instance
            $shift = Shift::create([
                'shift_date' => $validatedData['shift_date'],
                'tax' => $validatedData['tax'],
                'expenses' => $validatedData['expenses'],
                'went_out' => $validatedData['went_out'],
                'supply' => $validatedData['supply'],
                'total_value_after_deductions' => $request->total_value_after_deductions,
            ]);
    
            // Iterate through the readings and calculate totals by fuel type
            foreach ($validatedData['start_readings'] as $deviceId => $startReadings) {
                // Retrieve end readings, defrance, and value for the device
                $endReadings = $validatedData['end_readings'][$deviceId];
                $defrance = $validatedData['defrance'][$deviceId];
                $value = $validatedData['value'][$deviceId];
    
                // Retrieve the device and its fuel type
                $device = Device::find($deviceId);
                $fuelType = $device->fuel_type;
    
                // Create a Readings record for this device
                Readings::create([
                    'shift_id' => $shift->id,
                    'device_id' => $deviceId,
                    'start_readings' => $startReadings,
                    'end_readings' => $endReadings,
                    'defrance' => $defrance,
                    'value' => $value,
                ]);
            }
    
            // Store totals for each fuel type
            foreach ($validatedData['total_defrance'] as $fuelType => $totalDefrance) {
                // Create a new Total record
                Total::create([
                    'shift_id' => $shift->id,
                    'fuel_type' => $fuelType,
                    'total_defrance' => $totalDefrance,
                    'total_value' => $validatedData['total_value'][$fuelType],
                ]);
            }
    
            // Commit the transaction
            DB::commit();
    
            return redirect()->back()->with('success', 'تم تقفيل الوردية بنجاح');
        } catch (\Exception $e) {
            // Rollback the transaction if an exception occurs
            DB::rollback();
    
            // Handle the exception
            return redirect()->back()->with('error', 'حدث خطأ أثناء تقفيل الوردية: ' . $e->getMessage());
        }
    }
    public function show($id){
        $shift = Shift::with([ 'readings', 'totals'])->find($id);
        return view('admin.pages.shifts.show',get_defined_vars());
    }
    

}
