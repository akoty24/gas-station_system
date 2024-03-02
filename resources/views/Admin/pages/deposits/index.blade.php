@extends('Admin.layouts.master')

@section('pageTitle') <i class="fa fa-user-plus"></i> حركة الاستلام والايداع @endsection

@section('content')

    <div class="box">

        <div class="box-header with-border">
            <h3 class="box-title">
                حركة الاستلام والايداع
            </h3>

            <div class="button-page-header">
                <a class="btn btn-block btn-primary" href="{{ route('deposits.create') }}">
                <i class="fa fa-plus-circle fa-fw fa-lg"></i> اضافة حركة الاستلام والايداع</a>
            </div>




        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <div class="table-responsive">
                <table id="yajra-datatable" class="table table-hover table-bordered text-center">
                    <thead>
                        <tr style="background-color: #337ab7">
                            <th class="text-center " style="color: white;font-weight: bold ;font-size: 25px"><b>التاريخ</b></th>
                            <th class="text-center " style="color: white;font-weight: bold ;font-size: 25px"><b> نوع العملية</b></th>
                            <th class="text-center " style="color: white;font-weight: bold ;font-size: 25px"><b> المبلغ </b></th>
                            <th class="text-center " style="color: white;font-weight: bold ;font-size: 25px">ملاحظات</th>
                            <th class="text-center " style="color: white;font-weight: bold ;font-size: 25px">تعديل</th>
                    
                        </tr>
                    </thead>
                    <tbody>
                     
                        @foreach($deposits as $deposit)
                            <tr>
                                <td style="color: black;font-weight: bold;font-size: 20px">{{ $deposit->date }}</td>
@if($deposit->type == "receive")
                                <td style="color: black;font-weight: bold;font-size: 20px">الاستلام</td>
@elseif($deposit->type == "deposit")
                                <td style="color: black;font-weight: bold;font-size: 20px">الايداع</td>
@endif
                                <td style="color: black;font-weight: bold;font-size: 20px">{{ $deposit->amount }}</td>
                                <td style="color: black;font-weight: bold;font-size: 20px">{{ $deposit->notes }}</td>

                                <td >
                                    <a style="color: white;font-weight: bold;font-size: 20px" href="{{ route('deposits.edit', $deposit->id) }}" class="btn btn-primary btn-xs">
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