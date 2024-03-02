@extends('Admin.layouts.master')

@section('pageTitle') 
    <div class="row">
        <div class="">
            <i class="fa fa-dashboard"></i> 
            تقفيل وردية اليوم 
        </div>
        {{-- <div class="text-center">   
            {{ now()->toDateString() }} 
        </div> --}}
    </div>
@endsection

@section('content')
    <div class="box">
        <div class="box-header with-border">
          
            {{-- <h3 class="box-title text-center">  {{ now()->toDateString() }} </h3> --}}
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <div class="table-responsive">
                <form id="myForm" method="POST" action="{{ route('shifts.store') }}">
                    @csrf
                    <div class="form-group col-md-12" >
                        <label for="shift_date"  style=" margin-right: 37%; color: black;font-weight: bold ;font-size: 20px">تاريخ الوردية</label>
                       <input required 
       style="margin-right: 35%; width: 20%; background-color: darkgray; color: white" 
       type="date" 
       class="form-control" 
       id="shift_date" 
       name="shift_date"
       lang="ar"
       value="{{ \Carbon\Carbon::parse(now()->toDateString())->locale('ar')->isoFormat('YYYY-MM-DD') }}">
                  <table id="yajra-datatable" class="table table-hover table-bordered text-center">
                        <thead>
                            <tr>
                                <th class="text-center " style="color: black;font-weight: bold ;font-size: 20px"><b>المخرج</b></th>
                                <th class="text-center " style="color: black;font-weight: bold ;font-size: 20px"><b> سعرالليتر  </b></th>
                                <th class="text-center " style="color: black;font-weight: bold ;font-size: 20px"><b> الصنف </b></th>
                                <th class="text-center " style="color: black;font-weight: bold ;font-size: 20px"><b>عداد سابق </b></th>
                                <th class="text-center " style="color: black;font-weight: bold ;font-size: 20px"><b>عداد حالي </b></th>
                                <th class="text-center " style="color: black;font-weight: bold ;font-size: 20px"><b> فرق الليترات </b></th>
                                <th class="text-center " style="color: black;font-weight: bold ;font-size: 20px"><b> القيمة </b></th>
                            </tr>
                        </thead>
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
                        
                            @foreach($fuelTypes as $fuelType)
                                <tr class="total-row" id="totalRow{{$fuelType}}">
                                    <td style="color: black;font-weight: bold;font-size: 30px" colspan="5"><b>اجمالي: {{ $fuelType }}</b></td>
                                  
                                     <td>
                                        <input style="width: 70%; background-color: red;color: white"  type="text" name="total_defrance[{{ $fuelType }}]" class="form-control total-defrance" id="totalDefrance{{ $fuelType }}" readonly>
                                    </td>
                                    <td>
                                        <input style="width: 70%; background-color: red;color: white"  type="text"  name="total_value[{{ $fuelType }}]" class="form-control total-value" id="totalValue{{ $fuelType }}" readonly>
                                    </td>
                                    
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="text-center">
                        <button  class="btn btn-success" style="font-size:25px;color: white" type="submit"> <span><i class="fa fa-save"></i>  </span>  تقفيل الوردية</button>
                    </div>
                </form>
            </div>
        </div>
        <!-- /.box-body -->
    </div>

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
    }

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
