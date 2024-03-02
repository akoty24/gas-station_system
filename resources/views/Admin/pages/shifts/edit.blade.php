@extends('Admin.layouts.master')

@section('pageTitle') 
    <i class="fa fa-user-plus"></i> تعديل سعر البنزين 
@endsection

@section('content')

<div class="box">
    <div class="box-header with-border">
        <h3 class="box-title">تعديل سعر البنزين</h3>
    </div>

    <div class="box-body">
        <form id="editDeviceForm" action="{{ route('devices.update', $device->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="name">المخرج</label>
                        <input type="text" name="name" id="name" class="form-control" placeholder="ادخل  المخرج" value="{{ $device->name }}">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="fuel_type">نوع البنزين</label>
                        <select name="fuel_type" id="fuel_type" class="form-control">
                            <option disabled value="">اختر نوع البنزين</option>
                            <option value="80" {{ $device->fuel_type == '80' ? 'selected' : '' }}>بنزين 80</option>
                            <option value="92" {{ $device->fuel_type == '92' ? 'selected' : '' }}>بنزين 92</option>
                            <option value="95" {{ $device->fuel_type == '95' ? 'selected' : '' }}>سولار بطئ</option>
                            <option value="98" {{ $device->fuel_type == '98' ? 'selected' : '' }}>سولار سريع</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="price_per_liter">سعر اللتر</label>
                        <input type="text" name="price_per_liter" id="price_per_liter" class="form-control" placeholder="ادخل سعر اللتر" value="{{ $device->price_per_liter }}">
                    </div>
                </div>
            </div>

            <button type="submit" class="btn btn-primary">حفظ</button>
        </form>
    </div>
</div>



<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js"></script>
<script>
    $(document).ready(function(){
        $('#editDeviceForm').validate({
            rules: {
                name: {
                    required: true,
                    maxlength: 255
                },
                fuel_type: {
                    required: true
                },
                price_per_liter: {
                    required: true,
                    number: true
                }
            },
            messages: {
                name: {
                    required: "يرجى إدخال اسم المخرج",
                    maxlength: "يجب ألا يتجاوز اسم المخرج 255 حرفًا"
                },
                fuel_type: {
                    required: "يرجى اختيار نوع البنزين"
                },
                price_per_liter: {
                    required: "يرجى إدخال سعر اللتر",
                    number: "الرجاء إدخال قيمة صحيحة لسعر اللتر"
                }
            },
            errorElement: 'span',
            errorPlacement: function(error, element) {
                error.addClass('text-danger');
                error.insertAfter(element);
            }
        });
    });
</script>
@endsection




