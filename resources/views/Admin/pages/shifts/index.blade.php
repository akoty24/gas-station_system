@extends('Admin.layouts.master')

@section('pageTitle') 
    <i class="fa fa-dashboard"></i> جميع الورديات
@endsection

@section('content')

    <div class="box">

        <div class="box-header with-border">
            <h3 class="box-title">
                <i class="fa fa-dashboard"></i>  الورديات السابقة
                
            </h3>
            
            
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <div class="table-responsive">
                <table id="yajra-datatable" class="table table-hover table-bordered text-center">
            <thead>
                <tr style="background-color: #337ab7">
                    <th class="text-center " style="color: white;font-weight: bold ;font-size: 25px">تاريخ الوردية</th>
                    <th class="text-center " style="color: white;font-weight: bold ;font-size: 25px">الضريبة</th>
                    <th class="text-center " style="color: white;font-weight: bold ;font-size: 25px">المصاريف</th>
                    <th class="text-center " style="color: white;font-weight: bold ;font-size: 25px">المطلوب</th>
                    <th class="text-center " style="color: white;font-weight: bold ;font-size: 25px"> التوريد</th>
                    <th class="text-center " style="color: white;font-weight: bold ;font-size: 25px"> الخارج</th>
                    <th class="text-center " style="color: white;font-weight: bold ;font-size: 25px">عرض</th>
                </tr>
            </thead>
            <tbody>
                @foreach($shifts as $shift)
                <tr>
                    <td class="text-center " style="color: black;font-weight: bold;font-size: 20px">{{ \Carbon\Carbon::parse($shift->shift_date)->locale('ar')->isoFormat('dddd, D MMMM YYYY') }}</td>
                    <td class="text-center " style="color: black;font-weight: bold;font-size: 20px">{{ $shift->tax }}</td>
                    <td class="text-center " style="color: black;font-weight: bold;font-size: 20px">{{ $shift->expenses }}</td>
                    <td class="text-center " style="color: black;font-weight: bold;font-size: 20px">{{ $shift->total_value_after_deductions }}</td>
                    <td class="text-center" style="color: black; font-weight: bold; font-size: 20px">
                        {{ $shift->supply ?: 'لا يوجد' }}
                    </td>
                    <td class="text-center" style="color: black; font-weight: bold; font-size: 20px">
                        {{ $shift->went_out ?: 'لا يوجد' }}
                    </td>
                    
                    <td class="text-center ">
                        <a href="{{ route('shifts.show', $shift->id) }}" class="btn btn-sm btn-primary"> <i class="fa fa-eye"> </i>عرض</a>
                        <!-- You can add a delete button here if needed -->
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
<!-- /.box-body -->
</div>



@push('scripts')
<script>
$(document).ready(function(){
    var table = $('#yajra-datatable').DataTable();
});
</script>
@endpush

@endsection
