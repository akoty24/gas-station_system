@extends('Admin.layouts.master')

@section('pageTitle')
    
    <p><strong>تاريخ الوردية:</strong> {{ \Carbon\Carbon::parse($shift->shift_date)->locale('ar')->isoFormat('dddd, D MMMM YYYY') }}</p>
@endsection

@section('content')

    <div class="box">

        <div class="box-header with-border">
          
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <div class="table-responsive">
                <table id="yajra-datatable" class="table table-hover table-bordered text-center">
                <thead>
                    <tr>
                        <th class="text-center " style="color: black;font-weight: bold ;font-size: 25px">المخرج</th>
                        <th class="text-center " style="color: black;font-weight: bold ;font-size: 25px">عداد سابق </th>
                        <th class="text-center " style="color: black;font-weight: bold ;font-size: 25px">عداد حالي </th>
                        <th class="text-center " style="color: black;font-weight: bold ;font-size: 25px">فرق الليتر</th>
                        <th class="text-center " style="color: black;font-weight: bold ;font-size: 25px">القيمة</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($shift->readings as $reading)
                        <tr>
                            @php
                                $fuelTypeColor = '';
                                switch ($reading->device->fuel_type) {
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
                            <td style="color: black;font-weight: bold;font-size: 20px"><span
                                    style="width: 20px;background-color: {{ $fuelTypeColor }}; color: white; padding: 5px ; border-radius: 5px">{{ $reading->device->name }}</span>
                            </td>
                            <td style="color: black;font-weight: bold;font-size: 20px"><span
                                    style="width: 20px;background-color: {{ $fuelTypeColor }}; color: white; padding: 5px ; border-radius: 5px">{{ $reading->start_readings }}</span>
                            </td style="color: black;font-weight: bold;font-size: 20px">
                            <td style="color: black;font-weight: bold;font-size: 20px"><span
                                    style="width: 20px;background-color: {{ $fuelTypeColor }}; color: white; padding: 5px ; border-radius: 5px">{{ $reading->end_readings }}</span>
                            </td>
                            <td style="color: black;font-weight: bold;font-size: 20px"><span
                                    style="width: 20px;background-color: {{ $fuelTypeColor }}; color: white; padding: 5px ; border-radius: 5px">{{ $reading->defrance }}</span>
                            </td>
                            <td style="color: black;font-weight: bold;font-size: 20px"><span
                                    style="width: 20px;background-color: {{ $fuelTypeColor }}; color: white; padding: 5px ; border-radius: 5px">{{ $reading->value }}</span>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <!-- Totals -->
            <h2 class="text-center" style="color: black;font-weight: bold ;font-size: 30px">الاجمالي</h2>
            <table id="yajra-datatable" class="table table-hover table-bordered text-center">
                <thead>
                    <tr>
                        <th class="text-center " style="color: black;font-weight: bold ;font-size: 25px">الصنف</th>
                        <th class="text-center " style="color: black;font-weight: bold ;font-size: 25px">اجمالي الليترات
                        </th>
                        <th class="text-center " style="color: black;font-weight: bold ;font-size: 25px">اجمالي القيمة </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($shift->totals as $total)
                        <tr>
                            @php
                                $fuelTypeColor = '';
                                switch ($total->fuel_type) {
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
        @if ($total->fuel_type == 80)
        <td style="color: black;font-weight: bold;font-size: 30px"><span style="width: 20px;background-color: {{ $fuelTypeColor }}; color: white; padding: 5px ; border-radius: 5px">بنزين{{ $total->fuel_type }}</span >
        @elseif ($total->fuel_type == 92)
        <td style="color: black;font-weight: bold;font-size: 30px"><span style="width: 20px;background-color: {{ $fuelTypeColor }}; color: white; padding: 5px ; border-radius: 5px">بنزين{{ $total->fuel_type }}</span >
        @elseif ($total->fuel_type == 95)
        <td style="color: black;font-weight: bold;font-size: 30px"><span style="width: 20px;background-color: {{ $fuelTypeColor }}; color: white; padding: 5px ; border-radius: 5px">سولار بطئ</span >
        @elseif ($total->fuel_type == 98)
        <td style="color: black;font-weight: bold;font-size: 30px"><span style="width: 20px;background-color: {{ $fuelTypeColor }}; color: white; padding: 5px ; border-radius: 5px">سولارسريع</span >
        @endif


                            </td style="color: black;font-weight: bold;font-size: 30px">
                            <td style="color: black;font-weight: bold;font-size: 30px"><span
                                    style="width: 20px;background-color: {{ $fuelTypeColor }}; color: white; padding: 5px ; border-radius: 5px">{{ $total->total_defrance }}</span>
                            </td style="color: black;font-weight: bold;font-size: 30px">
                            <td style="color: black;font-weight: bold;font-size: 30px"><span
                                    style="width: 20px;background-color: {{ $fuelTypeColor }}; color: white; padding: 5px ; border-radius: 5px">{{ $total->total_value }}</span>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        
    @endsection