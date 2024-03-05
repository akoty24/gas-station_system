@extends('Admin.layouts.master')

@section('pageTitle') 
    <div class="row">
        <div class="">
            <i class="fa fa-dashboard"></i> 
            تقفيل وردية اليوم 
        </div>
    </div>
@endsection

@section('content')
    <div class="box">
        <div class="box-body">
            <div class="table-responsive">
                <form id="myForm" method="POST" action="{{ route('shifts.store') }}">
                    @csrf
                    <div class="form-group col-md-12" >
                        <label for="shift_date"  style=" margin-right: 37%; color: black;font-weight: bold ;font-size: 30px">تاريخ الوردية</label>
                        <input required 
                            style="margin-right: 35%; width: 20%; background-color: darkgray; color: white" 
                            type="date" 
                            class="form-control" 
                            id="shift_date" 
                            name="shift_date"
                            lang="ar"
                            value="{{ \Carbon\Carbon::parse(now()->toDateString())->locale('ar')->isoFormat('YYYY-MM-DD') }}">
                    </div>
                    <table id="yajra-datatable" class="table table-hover table-bordered text-center">
                        <!-- Table Header -->
                        <thead>
                            <tr style="background-color: #337ab7">

                                <th class="text-center " style="color: white;font-weight: bold ;font-size: 20px"><b>المخرج</b></th>
                                <th class="text-center " style="color: white;font-weight: bold ;font-size: 20px"><b> سعرالليتر  </b></th>
                                <th class="text-center " style="color: white;font-weight: bold ;font-size: 20px"><b> الصنف </b></th>
                                <th class="text-center " style="color: white;font-weight: bold ;font-size: 20px"><b>عداد سابق </b></th>
                                <th class="text-center " style="color: white;font-weight: bold ;font-size: 20px"><b>عداد حالي </b></th>
                                <th class="text-center " style="color: white;font-weight: bold ;font-size: 20px"><b> فرق الليترات </b></th>
                                <th class="text-center " style="color: white;font-weight: bold ;font-size: 20px"><b> القيمة </b></th>
                            </tr>
                        </thead>
                        <!-- Table Body -->
                        <tbody>

                            @foreach($devices as $device)
                            <tr>
                                @php
                                    $fuelTypeColor = '';
                                    switch ($device->fuel_type) {
                                        case '80':
                                            $fuelTypeColor = '#9561e2';
                                            break;
                                        case '92':
                                            $fuelTypeColor = '#343a40';
                                            break;
                                        case '95':
                                            $fuelTypeColor = '#f6993f';
                                            break;
                                        case '98':
                                            $fuelTypeColor = 'orange ';
                                            break;
                                        default:
                                            $fuelTypeColor = '#337ab7';
                                    }
                                @endphp
                                <td><span style="width: 20px;background-color: {{ $fuelTypeColor }}; color: white; padding: 5px ; border-radius: 5px">{{ $device->name }}</span></td>
                                <td><span style="width: 20px; background-color: {{ $fuelTypeColor }};color: white; padding: 5px ; border-radius: 5px">{{ $device->price_per_liter }}</span></td>
                                <td class="fuel-type" data-fuel-type="{{ $device->fuel_type }}">
                                    @if ($device->fuel_type == 80)
                                        <span style="width: 20px; background-color: {{ $fuelTypeColor }}; color: white; padding: 5px ; border-radius: 5px">بنزين{{ $device->fuel_type }}</span>
                                    @elseif ($device->fuel_type == 92)
                                        <span style="width: 20px; background-color: {{ $fuelTypeColor }}; color: white; padding: 5px ; border-radius: 5px">بنزين{{ $device->fuel_type }}</span>
                                    @elseif ($device->fuel_type == 95)
                                        <span style="width: 20px; background-color: {{ $fuelTypeColor }}; color: white; padding: 5px ; border-radius: 5px">سولار بطئ</span> 
                                    @elseif ($device->fuel_type == 98)
                                        <span style="width: 20px; background-color: {{ $fuelTypeColor }}; color: white; padding: 5px ; border-radius: 5px">سولارسريع</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="form-group">
                                        @foreach($previousReadings as $reading)
                                            @if($reading->device_id == $device->id)
                                                <input style="width: 70%; background-color: {{ $fuelTypeColor }}; color: white" type="number" class="form-control start-readings" id="start_readings{{$device->id}}" value="{{ $reading->end_readings }}" readonly name="start_readings[{{ $device->id }}]">
                                            @endif
                                        @endforeach
                                    </div>
                                </td>
                                <td> 
                                    <div class="form-group">
                                        <input style="width: 70%;  color: black" type="number" min="0" class="form-control end-readings" data-device-id="{{ $device->id }}" data-price-per-liter="{{ $device->price_per_liter }}" name="end_readings[{{ $device->id }}]">
                                    </div>
                                </td>
                                <td>
                                    <input style="width: 70%; background-color: {{ $fuelTypeColor }}; color: white"  type="text" class="form-control defrance" id="defrance{{$device->id}}" name="defrance[{{ $device->id }}]" readonly>
                                </td>
                                <td> 
                                    <div class="form-group">
                                        <input style="width: 70%; background-color: {{ $fuelTypeColor }}; color: white"  type="text" class="form-control value" id="value{{$device->id}}" name="value[{{ $device->id }}]" readonly>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                     
                            <td class="form-group col-md-12" style=" margin-top: 30px; background-color: #337ab7; color: white; border-radius: 5px;font-weight: bold;font-size: 30px" colspan="7"><span >الخزنة</span></td>
                          <br>

                            @foreach($fuelTypes as $fuelType)
                            <tr class="total-row" id="totalRow{{$fuelType}}">

                                    @if ($fuelType == 80)
                                    
                                        <td style="color: black;font-weight: bold;font-size: 20px" colspan="3"><span style="width: 20px;background-color: #9561e2; color: white; padding: 5px ; border-radius: 5px">اجمالي بنزين{{ $fuelType }}</span></td>
                                    @elseif ($fuelType == 92)
                                         <td style="color: black;font-weight: bold;font-size: 20px" colspan="3"><span style="width: 20px;background-color: #343a40; color: white; padding: 5px ; border-radius: 5px">اجمالي بنزين{{ $fuelType }}</span></td>
                                    @elseif ($fuelType == 95)
                                        <td style="color: black;font-weight: bold;font-size: 20px" colspan="3"><span style="width: 20px;background-color: #f6993f; color: white; padding: 5px ; border-radius: 5px">اجمالي سولار بطئ </span></td> 
                                    @elseif ($fuelType == 98)
                                        <td style="color: black;font-weight: bold;font-size: 20px" colspan="3"><span style="width: 20px;background-color: orange; color: white; padding: 5px ; border-radius: 5px">اجمالي سولارسريع</span></td>
                                    @endif              
                                     <td colspan="2">
                                        <input style="width: 70%; background-color: red;color: white"  type="text" name="total_defrance[{{ $fuelType }}]" class="form-control total-defrance" id="totalDefrance{{ $fuelType }}" readonly>
                                    </td>
                                    <td colspan="2">
                                        <input style="width: 70%; background-color: red;color: white"  type="text"  name="total_value[{{ $fuelType }}]" class="form-control total-value" id="totalValue{{ $fuelType }}" readonly>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    
                   <div class="row text-center">
                    <div class="form-group col-md-6">
                        <label for="tax" style="margin-right: 37%; color: black;font-weight: bold ;font-size: 20px">الضريبة</label>
                        <input type="text" class="form-control" id="tax" name="tax" placeholder="ادخل قيمة الضريبة">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="expenses" style="margin-right: 37%; color: black;font-weight: bold ;font-size: 20px">المصاريف</label>
                        <input type="text" class="form-control" id="expenses" name="expenses" placeholder="ادخل قيمة المصاريف">
                    </div>
                   </div>
                  
               <div class="row">
                <div class="form-group col-md-12">
                    <label for="total_value_after_deductions" style="margin-right: 37%; color: black;font-weight: bold ;font-size: 20px">  المطلوب</label>
                    <input style="background-color: darkgray;color: white" type="text" class="form-control" id="total_value_after_deductions" name="total_value_after_deductions" readonly>
                </div>
               </div>
                    <div class="row">
                    <div class="form-group col-md-6">
                        <label for="supply" style="margin-right: 37%; color: black;font-weight: bold ;font-size: 20px">توريد</label>
                        <input type="text" class="form-control" id="supply" name="supply" placeholder="ادخل قيمة التوريد">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="went_out" style="margin-right: 37%; color: black;font-weight: bold ;font-size: 20px">خوارج</label>
                        <input type="text" class="form-control" id="went_out" name="went_out" placeholder="ادخل قيمة الخوارج">
                    </div>
                    </div>
                    <div class="text-center">
                        <button class="btn btn-success" style="font-size:25px;color: white" type="submit"> <span><i class="fa fa-save"></i>  </span>  تقفيل الوردية</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

   
@endsection
{{-- @section('scripts')
    <script src="{{ asset('Dashboard/js/shifts.js') }}"></script>
@endsection --}}

@section('scripts')
<script>
   document.addEventListener("DOMContentLoaded", function() {
    var endReadingsInputs = document.querySelectorAll('.end-readings');

    endReadingsInputs.forEach(function(input) {
        input.addEventListener('change', function() {
            calculateDifferenceAndValue(this);
        });
    });

    function calculateDifferenceAndValue(input) {
        var deviceId = input.dataset.deviceId;
        var pricePerLiter = input.dataset.pricePerLiter;
        var endReadings = parseFloat(input.value);
        var startReadingsElement = document.querySelector('#start_readings' + deviceId);

        if (startReadingsElement) {
            var startReadings = parseFloat(startReadingsElement.value);
            var defrance = endReadings - startReadings;
            var value = defrance * pricePerLiter;

            document.querySelector('#defrance' + deviceId).value = defrance;
            document.querySelector('#value' + deviceId).value = value;

            updateTotalValues(); // Update total defrance and total value
        }
    }

    function updateTotalValues() {
        var fuelTypes = {!! json_encode($fuelTypes) !!};
        var totalDefrance = {};
        var totalValue = {};

        var endReadingsInputs = document.querySelectorAll('.end-readings');

        endReadingsInputs.forEach(function(input) {
            var fuelTypeElement = input.closest('tr').querySelector('.fuel-type');
            var defranceElement = document.querySelector('#defrance' + input.dataset.deviceId);
            var valueElement = document.querySelector('#value' + input.dataset.deviceId);

            if (fuelTypeElement && defranceElement && valueElement) {
                var fuelType = fuelTypeElement.dataset.fuelType;
                totalDefrance[fuelType] = (totalDefrance[fuelType] || 0) + (parseFloat(defranceElement.value) || 0);
                totalValue[fuelType] = (totalValue[fuelType] || 0) + (parseFloat(valueElement.value) || 0);
            }
        });

        // Update total defrance and total value fields for each fuelType
        fuelTypes.forEach(function(fuelType) {
            var totalDefranceElement = document.querySelector('#totalDefrance' + fuelType);
            var totalValueElement = document.querySelector('#totalValue' + fuelType);

            if (totalDefranceElement && totalValueElement) {
                totalDefranceElement.value = totalDefrance[fuelType].toFixed(2);
                totalValueElement.value = totalValue[fuelType].toFixed(2);
            }
        });

        updateTotalValueAfterDeductions();
    }

    function updateTotalValueAfterDeductions() {
        var totalDefranceInputs = document.querySelectorAll('.total-value');
        var totalDefranceSum = 0;
        totalDefranceInputs.forEach(function(input) {
            totalDefranceSum += parseFloat(input.value) || 0;
        });

        var expenses = parseFloat(document.getElementById('expenses').value) || 0;
        var tax = parseFloat(document.getElementById('tax').value) || 0;

        var totalValueAfterDeductions = totalDefranceSum - expenses - tax;
        document.getElementById('total_value_after_deductions').value = totalValueAfterDeductions.toFixed(2);
    }

    // Attach event listeners to expenses and tax inputs
    var expensesInput = document.getElementById('expenses');
    var taxInput = document.getElementById('tax');

    expensesInput.addEventListener('change', updateTotalValueAfterDeductions);
    taxInput.addEventListener('change', updateTotalValueAfterDeductions);

    // Form Validation
    document.getElementById('myForm').addEventListener('submit', function(event) {
        var endReadingsInputs = document.querySelectorAll('.end-readings');
        var isValid = true;

        endReadingsInputs.forEach(function(input) {
            if (!input.value || isNaN(input.value)) {
                isValid = false;
            }
        });

        if (!isValid) {
            event.preventDefault();
            alert('يرجى ملء جميع الحقول بقيم صحيحة.');
        }
    });
});

</script>
@endsection