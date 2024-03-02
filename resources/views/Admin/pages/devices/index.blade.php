@extends('Admin.layouts.master')

@section('pageTitle') <i class="fa fa-user-plus"></i> الاسعار @endsection

@section('content')

    <div class="box">

        <div class="box-header with-border">
            <h3 class="box-title">
                اسعار البنزين 

            </h3>

            <div class="button-page-header">
                <a class="btn btn-block btn-primary" href="{{ route('devices.create') }}">
                <i class="fa fa-plus-circle fa-fw fa-lg"></i> اضافة مخرج جديد</a>
            </div>




        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <div class="table-responsive">
                <table id="yajra-datatable" class="table table-hover table-bordered text-center">
                    <thead>
                        <tr style="background-color: #337ab7">
                            <th class="text-center " style="color: white;font-weight: bold ;font-size: 25px"><b>المخرج</b></th>
                            <th class="text-center " style="color: white;font-weight: bold ;font-size: 25px"><b>نوع البنزين</b></th>
                            <th class="text-center " style="color: white;font-weight: bold ;font-size: 25px"><b>سعر اللتر</b></th>
                            <th class="text-center " style="color: white;font-weight: bold ;font-size: 25px">التعديلات</th>
                    
                        </tr>
                    </thead>
                    <tbody>
                     
                        @foreach($devices as $device)
                            <tr>
                                <td style="color: black;font-weight: bold;font-size: 20px">{{ $device->name }}</td>
                               @if ($device->fuel_type == 95)
                               <td style="color: black;font-weight: bold;font-size: 20px" >سولار بطئ</td>
                               @elseif ($device->fuel_type == 98)
                               <td style="color: black;font-weight: bold;font-size: 20px">سولار سريع</td>
                               @else
                               <td style="color: black;font-weight: bold;font-size: 20px">بنزين{{ $device->fuel_type }}</td>
                               @endif
                                <td style="color: black;font-weight: bold;font-size: 20px">{{ $device->price_per_liter }}</td>
                                <td >
                                    <a style="color: white;font-weight: bold;font-size: 20px" href="{{ route('devices.edit', $device->id) }}" class="btn btn-primary btn-xs">
                                        <i class="fa fa-edit"></i>  {{ trans('backend.edit') }}
                                    </a>
                                </td>
                            </tr>
                        @endforeach

                 
                    </tbody>
                </table>
            </div>
        </div>
        <!-- /.box-body -->
    </div>

@endsection


@push('scripts')
    <script>
        $(document).ready(function(){
            var table = $('#yajra-datatable').DataTable();
        });
    </script>
@endpush