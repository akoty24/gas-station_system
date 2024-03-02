@extends('Front.layouts.master')
@section('content')
    <style>
        .background-image {
            background: linear-gradient(transparent, transparent, #fff), url('{{ asset('front/assets/images/bg.0669d73ac7189e72e94e.jpg') }}');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            color: #fff;
        }
    </style>
    <div class="background-image">
        <div class="iq-breadcrumb bg-soft-success  ">
            <div class="container">
            </div>
        </div> <!-- bread-crumb -->
    </div>
        <div class="section-padding" style="background-color: rgba(33,150,83,.1)">
            <a href="{{route('send-request')}}"
                    style=" background-color: darkorange; margin-left: 43%; margin-bottom: 20px; border-bottom-right-radius: 20px;border-top-right-radius: 20px;border-bottom-left-radius: 20px;border-top-left-radius: 20px;"
                    class="btn btn-primary text-center" >
                {{ trans('backend.send_your_request_now')}}
            </a>
            <div class="container">
                <form action="{{ route('/') }}" method="GET">
                    <nav class="tab-bottom-bordered border-0 mb-5">
                        <div class="mb-0 nav nav-tabs justify-content-center" id="nav-tab1" role="tablist">
                            <label class="nav-link">
                                <select name="country" class="form-control">
                                    <option value="">{{ trans('backend.country') }}</option>
                                    @foreach ($countries as $country)
                                        <option value="{{ $country->id }}">{{ $country->country }}</option>
                                    @endforeach
                                </select>
                            </label>
                            <label class="nav-link">
                                <select name="job" class="form-control">
                                    <option value="">{{ trans('backend.job') }}</option>
                                    @foreach ($jobs as $job)
                                        <option value="{{ $job->id }}">{{ $job->job }}</option>
                                    @endforeach
                                </select>
                            </label>
                            <label class="nav-link">
                                <select name="category" class="form-control">
                                    <option value="">{{ trans('backend.category') }}</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->category }}</option>
                                    @endforeach
                                </select>
                            </label>
                            <label class="nav-link">
                                <select name="experience" class="form-control">
                                    <option value="">{{ trans('experience')</option>
                                    <option value="Has good experience">Has good experience</option>
                                    <option value="Has no experience">Has no experience</option>
                                    <!-- Add more options as needed -->
                                </select>
                            </label>
                            <label class="nav-link">
                                <select name="religion" class="form-control">
                                    <option value="">religion</option>
                                    <option value="Muslim">muslim</option>
                                    <option value="Christian">christian</option>
                                    <!-- Add more options as needed -->
                                </select>
                            </label>
                            <label class="nav-link">
                                <button type="submit" class="btn btn-sm btn-success search-button">
                                    {{ trans('backend.search')}}
                                </button>
                            </label>
                        </div>
                    </nav>
                </form>
                <div class="tab-content iq-tab-fade-up" id="nav-tabContent">

                    <div class="tab-pane fade show active" id="doc-all" role="tabpanel" aria-labelledby="doc-all-tab">
                        <div class="row row-cols-md-3 row-cols-sm-2 row-cols-1">
                            @foreach($workers as $worker)
                                <div class="col mb-5">
                                    <div class="iq-team-block team-overdetail position-relative p-2"
                                         style="box-shadow: 6px 6px 6px 6px rgba(0, 0, 0, 0.1);">
                                        <div class="iq-team-img">
                                            <a href="{{asset($worker->image)}}">
                                                <img src="{{asset($worker->image)}}" alt="team"
                                                     class="img-fluid w-100" loading="lazy">
                                            </a>
                                        </div>
                                        <div class="share iq-team-social iq-team-info position-absolute"
                                             style="margin-top: 20%">
                                            <ul class="list-inline list-unstyled p-0 m-0 iq-team-main-detail">
                                                <li class="mb-2">
                                                    <a href="{{$website_info->whatsapp}}" class="position-relative bg-success text-white d-flex justify-content-center align-items-center"
                                                    >
                                                        <i class="fab fa-whatsapp fs-4 mr-6"></i>
                                                    </a>
                                                </li>
                                                <li class="mb-2">
                                                    <button data-toggle="modal" data-target="#requestModal" class="position-relative bg-primary text-white d-flex justify-content-center align-items-center">
                                                        <i class="fa fa-handshake fs-4 mr-6"></i>
                                                    </button>
                                                </li>

                                            </ul>
                                        </div>
                                        <div class="iq-team-info position-absolute d-block w-100">
                                            <div class="iq-team-main-detail bg-white">
                                                <div>
                                                    <h5 style="display: inline-block; margin-left: 50%">{{$worker->job->job}}</h5>
                                                </div>
                                                <a href="{{asset($worker->image)}}"
                                                   style="padding-left: 20px; padding-right: 20px;">
                                                    <p class="text-success"
                                                       style="display: inline-block; margin-right: 0px;"><i
                                                                class="fa fa-star-and-crescent"></i>{{$worker->religion}}</p>
                                                    <p class="text-success"
                                                       style="display: inline-block; float: right; margin-left: 10px;"><i
                                                                class="fas fa-globe mr-6"></i>{{$worker->country->country}}</p>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                        </div>
                    </div>

                </div>
            </div>
        </div>
        <!-- Add this modal code at the bottom of your page, just before the closing </body> tag -->
        <div class="modal" id="requestModal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">{{ trans('backend.send_request')}}</h5>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <form id="requestForm" action="{{ route('submit-request') }}" method="POST">
                            @csrf
                            <div class="row">
                                <!-- Identity Id -->
                                <div class="form-group col-md-6">
                                    <label for="identityId">{{ trans('backend.name')}}<span class="mx-1 text-danger">*</span></label>
                                    <input type="text" class="form-control" id="identityId" name="name" >
                                    @if ($errors->has('name'))
                                        <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                                    @endif
                                </div>
                                <!-- Identity ID -->
                                <div class="form-group col-md-6">
                                    <label for="identityId">{{ trans('backend.identity_id')}}<span class="mx-1 text-danger">*</span></label>
                                    <input type="text" class="form-control" id="identityId" name="identityId" >
                                    @if ($errors->has('identityId'))
                                        <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('identityId') }}</strong>
                                </span>
                                    @endif
                                </div>
                            </div>

                            <div class="row">
                                <!-- Date of Birth - Hijri -->
                                <div class="form-group col-md-6">
                                    <label for="dateOfBirthHijri">{{ trans('backend.date_of_birth-hijri')}}<span class="mx-1 text-danger">*</span></label>
                                    <input type="date" class="form-control" id="dateOfBirthHijri" name="dateOfBirthHijri" >
                                    @if ($errors->has('dateOfBirthHijri'))
                                        <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('dateOfBirthHijri') }}</strong>
                                </span>
                                    @endif
                                </div>
                                <!-- Phone -->
                                <div class="form-group col-md-6">
                                    <label for="phone">{{ trans('backend.phone')}}<span class="mx-1 text-danger">*</span></label>
                                    <input type="text" class="form-control" id="phone" name="phone" >
                                </div>
                            </div>

                            <!-- Check if "has visa Already" is checked -->
                            <div class="form-group col-md-6">
                                <input style="height: 20px; width: 20px" type="checkbox" id="hasVisaCheckbox">
                                <label for="hasVisaCheckbox">{{ trans('backend.has_visa_already')}}</label>
                            </div>
                            <div style="margin-left: 20px" class="form-group col-md-6" >
                                <div class="row">
                                    <!-- Verification Code -->
                                    <label for="verificationCode">{{ trans('backend.verification_code')}}<span class="mx-1 text-danger">*</span></label>
                                    <input style="width: 70%" type="text" class="form-control" id="verificationCode" name="verificationCode" >
                                    <span style="margin-left: 10px;background-color: #66bb6a;color: white;width: 80px; height: 32px; padding-top: 9px;" class="input-group-text badge justify-content-center align-items-center">{{ trans('backend.57652')}}</span>
                                    @if ($errors->has('verificationCode'))
                                        <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('verificationCode') }}</strong>
                                </span>
                                    @endif
                                </div>
                            </div>
                           <div id="additionalFields" style="display: none;">


                            <div class="row" >
                                <!-- Visa Number -->
                                <div class="form-group col-md-6">
                                    <label for="visaNumber">{{ trans('backend.visa_number')}}<span class="mx-1 text-danger">*</span></label>
                                    <input type="text" class="form-control" id="visaNumber" name="visaNumber">
                                    @if ($errors->has('visaNumber'))
                                        <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('visaNumber') }}</strong>
                                </span>
                                    @endif
                                </div>
                                <!-- Visa Date - Hijri -->
                                <div class="form-group col-md-6">
                                    <label for="visaDateHijri">{{ trans('backend.visa_date-hijri')}}<span class="mx-1 text-danger">*</span></label>
                                    <input type="date" class="form-control" id="visaDateHijri" name="visaDateHijri">
                                    @if ($errors->has('visaDateHijri'))
                                        <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('visaDateHijri') }}</strong>
                                </span>
                                    @endif
                                </div>
                            </div>

                            <div class="row">
                                <!-- Border Number -->
                                <div class="form-group col-md-6">
                                    <label for= "borderNumber">{{trans('backend.border_number')}}<span class="mx-1 text-danger">*</span></label>
                                    <input type="text" class="form-control" id="borderNumber" name="borderNumber">
                                    @if ($errors->has('borderNumber'))
                                        <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('borderNumber') }}</strong>
                                </span>
                                    @endif
                                </div>
                                <!-- Work Place -->
                                <div class="form-group col-md-6">
                                    <label for="workPlace">{{ trans('backend.work_place')}}<span class="mx-1 text-danger">*</span></label>
                                    <input type="text" class="form-control" id="workPlace" name="workPlace" >
                                    @if ($errors->has('workPlace'))
                                        <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('workPlace') }}</strong>
                                </span>
                                    @endif
                                </div>
                            </div>

                            <div class="row">
                                <!-- Work City -->
                                <div class="form-group col-md-6">
                                    <label for="workCity">{{ trans('backend.work_city')}}<span class="mx-1 text-danger">*</span></label>
                                    <input type="text" class="form-control" id="workCity" name="workCity" >
                                    @if ($errors->has('workCity'))
                                        <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('workCity') }}</strong>
                                </span>
                                    @endif
                                </div>
                                <!-- Address -->
                                <div class="form-group col-md-6">
                                    <label for="address">{{ trans('backend.address')}}<span class="mx-1 text-danger">*</span></label>
                                    <input type="text" class="form-control" id="address" name="address" >
                                    @if ($errors->has('address'))
                                        <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('address') }}</strong>
                                </span>
                                    @endif
                                </div>
                            </div>

                            <div class="row">
                                <!-- Name of a first-degree relative -->
                                <div class="form-group col-md-6">
                                    <label for="relativeName">{{ trans('backend.name_of_a_first_degree_relative')}}<span class="mx-1 text-danger">*</span></label>
                                    <input type="text" class="form-control" id="relativeName" name="relativeName" >
                                    @if ($errors->has('relativeName'))
                                        <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('relativeName') }}</strong>
                                </span>
                                    @endif
                                </div>
                                <!-- Relative Type -->
                                <div class="form-group col-md-6">
                                    <label for="relativeType">{{ trans('backend.relative_type')}}<span class="mx-1 text-danger">*</span></label>
                                    <input type="text" class="form-control" id="relativeType" name="relativeType" >
                                    @if ($errors->has('relativeType'))
                                        <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('relativeType') }}</strong>
                                </span>
                                    @endif
                                </div>
                            </div>

                            <div class="row">
                                <!-- Relative Phone -->
                                <div class="form-group col-md-6">
                                    <label for="relativePhone">{{ trans('backend.relative_phone')}}<span class="mx-1 text-danger">*</span></label>
                                    <input type="text" class="form-control" id="relativePhone" name="relativePhone" >
                                    @if ($errors->has('relativePhone'))
                                        <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('relativePhone') }}</strong>
                                </span>
                                    @endif
                                </div>
                                <!-- Employer of the person close to you -->
                                <div class="form-group col-md-6">
                                    <label for="employer">{{ trans('backend.employer_of_the_person_close_to_you')}}<span class="mx-1 text-danger">*</span></label>
                                    <input type="text" class="form-control" id="employer" name="employer" >
                                    @if ($errors->has('employer'))
                                        <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('employer') }}</strong>
                                </span>
                                    @endif
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="numFloors">{{ trans('backend.number_of_floors')}}<span class="mx-1 text-danger">*</span></label>
                                    <input type="number" class="form-control" id="numFloors" name="numFloors" value="1">
                                    @if ($errors->has('numFloors'))
                                        <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('numFloors') }}</strong>
                                </span>
                                    @endif
                                </div>
                                <div class="form-group col-md-6">
                                    <!-- Number of rooms -->
                                    <label for="numRooms">{{ trans('backend.number_of_rooms')}}<span class="mx-1 text-danger">*</span></label>
                                    <input type="number" class="form-control" id="numRooms" name="numRooms" value="1">
                                    @if ($errors->has('numRooms'))
                                        <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('numRooms') }}</strong>
                                </span>
                                    @endif
                                </div>
                            </div>

                            <div class="row">
                                <!-- Number of family members -->
                                <div class="form-group col-md-6">
                                    <label for="numFamilyMembers">{{ trans('backend.number_of_family_members')}}<span class="mx-1 text-danger">*</span></label>
                                    <input type="number" class="form-control" id="numFamilyMembers" name="numFamilyMembers" value="1">
                                    @if ($errors->has('numFamilyMembers'))
                                        <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('numFamilyMembers') }}</strong>
                                </span>
                                    @endif
                                </div>

                            </div>
                        </div>
                            <!-- Notes -->
                            <div class="row form-group col-md-12">
                            <label for="notes">{{ trans('backend.notes')}}</label>
                            <textarea style="margin-left:20px;width: 100%" class="form-control" id="notes" name="notes" rows="3"></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
@endsection

{{--    // $(document).ready(function () {
    //     $('#hasVisaCheckbox').change(function () {
    //         if (this.checked) {
    //             // Fields are required when "hasVisaCheckbox" is checked
    //             $('#verificationCode').prop('required', true);
    //             $('#identityId').prop('required', true);
    //             $('#name').prop('required', true);
    //             $('#dateOfBirthHijri').prop('required', true);
    //             $('#phone').prop('required', true);
    //             $('#visaNumber').prop('required', true);
    //             $('#visaDateHijri').prop('required', true);
    //             $('#borderNumber').prop('required', true);
    //             $('#workPlace').prop('required', true);
    //             $('#workCity').prop('required', true);
    //             $('#address').prop('required', true);
    //             $('#relativeName').prop('required', true);
    //             $('#relativeType').prop('required', true);
    //             $('#relativePhone').prop('required', true);
    //             $('#employer').prop('required', true);
    //             $('#numFloors').prop('required', true);
    //             $('#numRooms').prop('required', true);
    //             $('#numFamilyMembers').prop('required', true);
    //         } else {
    //             // Fields are not required when "hasVisaCheckbox" is unchecked
    //            // $('#verificationCode').prop('required', false);
    //         }
    //     });
    // });
    // JavaScript to trigger the modal
--}}
