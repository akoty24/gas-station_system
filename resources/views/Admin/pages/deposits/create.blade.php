@extends('Admin.layouts.master')

@section('pageTitle') 
    <i class="fa fa-user-plus"></i> الاستلام والايداع
@endsection

@section('content')

<div class="box">
    <div class="box-header with-border">
        <h3 class="box-title">اضافة عملية جديد</h3>
    </div>

    <div class="box-body">
        <form action="{{ route('deposits.store') }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label style="color: black;font-weight: bold;font-size: 20px" for="type">نوع العملية</label>
                        <select name="type" id="type" class="form-control">
                            <option selected disabled value="">اختر نوع العملية</option>
                            <option value="receive">الاستلام</option>
                            <option value="deposit">الايداع</option>
                        </select>
                        <span class="text-danger">{{ $errors->first('type') }}</span>
                    </div>
                </div>
                <div class="col-md-4">
                    
                    <div class="form-group">
                        <label style="color: black;font-weight: bold;font-size: 20px" for="date">التاريخ</label>
                        <input required 
       type="date" 
       class="form-control" 
       id="date" 
       name="date"
       lang="ar"
       value="{{ \Carbon\Carbon::parse(now()->toDateString())->locale('ar')->isoFormat('YYYY-MM-DD') }}">
       
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label style="color: black;font-weight: bold;font-size: 20px" for="amount">المبلغ</label>
                        <input type="number" name="amount" id="amount" class="form-control" placeholder="ادخل المبلغ">
                    </div>
                    <span class="text-danger">{{ $errors->first('amount') }}</span>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label style="color: black;font-weight: bold;font-size: 20px" for="notes">الملاحظات</label>
                        <textarea name="notes" id="notes" class="form-control" placeholder="ادخل الملاحظات"></textarea>
                    </div>
                </div>
                <span class="text-danger">{{ $errors->first('notes') }}
            </div>

            <button  style="font-weight: bold;font-size: 20px" type="submit" class="btn btn-primary">حفظ</button>
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
