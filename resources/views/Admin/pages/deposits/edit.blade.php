@extends('Admin.layouts.master')

@section('pageTitle') 
    <i class="fa fa-user-plus"></i> تعديل العملية
@endsection

@section('content')

<div class="box">
    <div class="box-header with-border">
        <h3 class="box-title">تعديل العملية</h3>
    </div>

    <div class="box-body">
        <form action="{{ route('deposits.update', $deposit->id) }}" method="POST">
            @csrf
            @method('PUT') {{-- This is needed to spoof PUT request as HTML forms only support GET and POST --}}
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label style="color: black;font-weight: bold;font-size: 20px" for="type">نوع العملية</label>
                        <select name="type" id="type" class="form-control">
                            <option disabled value="">اختر نوع العملية</option>
                            <option value="receive" {{ $deposit->type == 'receive' ? 'selected' : '' }}>الاستلام</option>
                            <option value="deposit" {{ $deposit->type == 'deposit' ? 'selected' : '' }}>الايداع</option>
                        </select>
                        <span class="text-danger">{{ $errors->first('type') }}</span>
                    </div>
                </div>

<!-- Other form fields -->
<div class="col-md-4">
    <div class="form-group">
        <label style="color: black;font-weight: bold;font-size: 20px" for="date">التاريخ</label>
        <input required 
               type="date" 
               class="form-control" 
               id="date" 
               name="date"
               lang="ar"
               value="{{ $deposit->date }}">
    </div>
</div>

<div class="col-md-4">
    <div class="form-group">
        <label style="color: black;font-weight: bold;font-size: 20px" for="amount">المبلغ</label>
        <input type="number" name="amount" id="amount" class="form-control" value="{{ $deposit->amount }}" placeholder="ادخل المبلغ">
    </div>
    <span class="text-danger">{{ $errors->first('amount') }}</span>
</div>

<div class="col-md-4">
    <div class="form-group">
        <label style="color: black;font-weight: bold;font-size: 20px" for="notes">الملاحظات</label>
        <textarea name="notes" id="notes" class="form-control" placeholder="ادخل الملاحظات">{{ $deposit->notes }}</textarea>
    </div>
    <span class="text-danger">{{ $errors->first('notes') }}</span>
</div>
            </div>
            <button type="submit" class="btn btn-primary">حفظ التغييرات</button>
        </form>
    </div>
</div>

@endsection
