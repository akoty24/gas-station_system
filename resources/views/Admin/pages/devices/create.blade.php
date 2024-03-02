@extends('Admin.layouts.master')

@section('pageTitle') 
    <i class="fa fa-user-plus"></i> اسعار البنزين 
@endsection

@section('content')

<div class="box">
    <div class="box-header with-border">
        <h3 class="box-title">اضافة سعر جديد</h3>
    </div>

    <div class="box-body">
        <form action="{{ route('devices.store') }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label style="color: black;font-weight: bold;font-size: 20px" for="name">المخرج</label>
                        <input type="text" name="name" id="name" class="form-control" placeholder="ادخل  المخرج">

                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label style="color: black;font-weight: bold;font-size: 20px" for="fuel_type">نوع البنزين</label>
                        <select name="fuel_type" id="fuel_type" class="form-control">
                            <option value="">اختر نوع البنزين</option>
                            <option value="80">بنزين 80</option>
                            <option value="92">بنزين 92</option>
                            <option value="95">سولار بطئ</option>
                            <option value="98">سولار سريع</option>
                          
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label style="color: black;font-weight: bold;font-size: 20px" for="device_per_liter">سعر اللتر</label>
                        <input type="text" name="device_per_liter" id="device_per_liter" class="form-control" placeholder="ادخل سعر اللتر">
                    </div>
                </div>
            </div>

            <button type="submit" class="btn btn-primary">حفظ</button>
        </form>
    </div>
</div>

@endsection

@push('scripts')
<script>
    $(document).ready(function(){
        $('#yajra-datatable').DataTable();
    });
</script>
@endpush
