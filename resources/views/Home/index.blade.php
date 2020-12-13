<!doctype html>
<html lang="fa">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>مبین اتصال آسمان</title>

    <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('css/style.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('css/file_input.min.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('css/file_input_theme.min.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('css/dropzone_new.min.css')}}" rel="stylesheet">
    {{--    <link rel='stylesheet' href="{{asset('css/sweetalert.min.css')}}">--}}

    <script src="{{asset('js/jquery-3.5.1.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('js/tiff.js')}}" type="text/javascript"></script>
    <script src="{{asset('js/UTIF.js')}}" type="text/javascript"></script>
    <script src="{{asset('js/bootstrap.min.js')}}" type="text/javascript"></script>
    <script type="text/javascript" src="{{asset('js/dropzone_new.min.js')}}"></script>
<!-- <script href="{{asset('js/popper.min.js')}}" type="text/javascript"></script> -->
    <script src="{{asset('js/sweetalert.min.js')}}"></script>
    <script src="{{asset('js/jquery.elevateZoom-3.0.8.min.js')}}" type="text/javascript"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body style="direction: rtl;text-align: right;padding-right:0px;" class="font body p-0">

<div class="alert alert-danger col-7 mt-2 mx-auto exists_file" style="display: none;color: black">
    <div><p>این فایل در دیتابیس قبلا ثبت شده است.لطفا این فایل را حذف نمایید و مجددا تلاش نمایید</p></div>
</div>

<div class="error container col-8 d-flex justify-content-start">
    <div class="alert alert-danger w-75 mx-auto mt-3" style="display: none">
        <ul class="append_error">
        </ul>
    </div><!--alert-danger-->
</div><!--erorr-->

<div class="container-fluid" style="border: 1px solid #a5df98;border-radius: 7px;">
    @if(Session::has('no_permission'))
        <div class="alert alert-danger col-lg-3 text-right error">
            <div>{{Session('no_permission')}}</div>
        </div>
    @endif
    <div class="row">
        <div class="col-lg-3  p-0 mt-2 remove_zoom" style="height: 100vh;overflow-y: auto">
            <button href="{{route('logout')}}" class="btn btn-danger mr-1"
                    style="text-align: center;height: 40px!important;cursor: pointer;width:98%;"
                    onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">خروج
            </button>
            <form id="logout-form" action="{{ route('logout') }}" method="post"
                  style="display: none;">
                @csrf
            </form>
            <div class="mt-2 d-flex justify-content-between">
                <button data-toggle="modal" data-target="#modal_delete_date" class="btn mr-1 clear_refresh"
                        style="background-color: #26de81">
                    پاکسازی
                    تاریخچه
                </button>
                <button data-toggle="modal" data-target="#continue_case" class="btn continue_document"
                        style="background-color: #26de81">
                    ادامه پرونده
                </button>

                <button data-toggle="modal" class="btn samab" data-target="#amplifier"
                        style="background: #26de81;color:black">
                    ساماب
                </button>

                <button class="btn btn-success new_coding savee" style="color:black;display:none" onclick="Operation()">
                    کد گذاری جدید
                </button>
            </div>

            <br>
            <div class="form-group col-lg-12" id="dropzone">
                <label for="name"> تصویر اصلی :</label>
                <div id="photo" class="dropzone style_dropzone"></div>
                <input type=text class='form-control' style="display: none" name=fake_photo id=fake_photo
                       placeholder='لطفا عملیات پاک سازی تاریخچه را انجام دهید' readonly>
            </div><!--form-group-->


            <div class="form-group col-lg-12" id="total_img">
                <label for="date_evidence"><p style="color:#ccc;margin:0;padding:0;"> تعداد تصاویر آپلود شده پرونده
                        :</p></label>
                <input class="form-control " style="direction: ltr;text-align: right" type="text"
                       name="total_img" value="" readonly>
            </div><!--form-group-->


            <div class="form-group col-lg-12 mt-3" id="rename_img">
                <label for="date_evidence"><p style="color:#ccc;margin:0;padding:0;"> تعداد تصاویر تغیر نام داده
                        شده:</p></label>
                <input class="form-control " style="direction: ltr;text-align: right" type="text"
                       name="rename_img" value="" readonly>
            </div><!--form-group-->

            <div class="form-group col-lg-12" id="folder_coding">
                <label for="name_folder"><p style="margin:0;padding:0;"> نام پرونده : (به جای '/' از '.' استفاده شود)
                    </p></label>
                <input class="form-control " style="direction: ltr;text-align: right" type="text"  placeholder="نام پرونده"
                       name="code_clase" id="code_clase" value="">
            </div><!--form-group-->

            <div class="form-group col-lg-12">
                <label for="state1">  انتخاب منطقه :</label>
                <select class="form-control state1" id="state1" name="state1">
                    <option value="">منطقه مورد نظر را انتخاب نمایید </option>
                    <option value="ق">قزوین</option>
                    <option value="آ">آبیک</option>
                    <option value="ت">تاکستان</option>
                    <option value="ب">بوئین زهرا</option>
                    <option value="ج">آوج</option>
                </select>
            </div><!--form-group-->

            <div class="form-group col-lg-12" id="user_name" style="display: none;">
                <label for="user_name"><p style="margin:0;padding:0;"> نام کاربر کد گذار
                        :</p></label>
                <input class="form-control read_only" style="direction: ltr;text-align: right" type="text"
                       placeholder="نام کاربر"
                       name="user_name" value="">
            </div><!--form-group-->

            <div class="form-group col-lg-12" id="folder_coded" style="display: none;">
                <label for="name_folder"><p style="margin:0;padding:0;"> نام پرونده کد گذاری شده
                        :</p></label>
                <input class="form-control read_only" style="direction: ltr;text-align: right" type="text"
                       placeholder="نام پرونده"
                       name="code_clase" id="code_clase" value="">
            </div><!--form-group-->

            <div class="form-group col-lg-12">
                <label for="code_special">کد منحصر به فرد (ساماب) :</label>
                <input class="form-control code_special read_only" type="text" name="code_special" value=""
                       placeholder="کد 6 رقمی" maxlength="6">{{ old('code_special') }}
            </div><!--form-group-->


            <div class="form-group col-lg-12">
                <label for="code_water"> منبع آب :</label>
                <select class="form-control code_water" id="code_water" name="code_water">
                    <option value="">منبع آب را انتخاب نمایید</option>
                    <option value="11">چاه</option>
                    <option value="12">چشمه</option>
                    <option value="13">شبکه</option>
                    <option value="14">قنات</option>
                    <option value="15">سد</option>
                    <option value="16">رودخانه</option>
                    <option value="17">آب بندان</option>
                    <option value="18">استخر ذخیره</option>
                    <option value="19">پس آب</option>
                    <option value="20">حریم و بستر</option>
                    <option value="99">سایر</option>
                </select>
            </div><!--form-group-->

            <div class="form-group col-lg-12 madrak ">
                <label for="code_evidence"> گروه مدرک:</label>
                <select class="form-control code_evidence" id="code_evidence"
                        name="code_evidence">
                    <option value=" "> گروه مدرک را انتخاب نمایید</option>
                    <option value="01">درخواست ها</option>
                    <option value="02">اسناد و مدارک دریافتی</option>
                    <option value="03">گزارش های کارشناسی، کروکی و مستندات مربوطه</option>
                    <option value="04">کمیسیون ها</option>
                    <option value="05">پروانه ها و مجوز ها و تمدید آنها</option>
                    <option value="06">اخطاریه ها / ابلاغیه ها</option>
                    <option value="07">معرفی نامه ها</option>
                    <option value="08"> شکایات و اسناد حقوقی و قضایی</option>
                    <option value="09">گزارش های عملیات حفاری، صورت جلسات استقرار و ترخیص دستگاه های حفاری،لوله
                        گذاری و
                        لوگ حفاری
                    </option>
                    <option value="10">گزارش های مامورین ماده 30 و گروه های گشت و بازرسی و آمار برداری</option>
                    <option value="11">مکاتبات اداری ، استعلام ها و پاسخ آنها</option>
                    <option value="12">نتایج آزمایش های فیزیکی و شیمیایی آب</option>
                    <option value="13">مدارک تخصیص آب</option>
                    <option value="14">اسناد مالی</option>
                    <option value="15">جلد پرونده</option>
                    <option value="99">سایر موارد</option>
                </select>
            </div><!--form-group-->

            <div class="form-group col-lg-12">
                <label for="evidence">نوع مدرک:</label>
                <select class="form-control Document_type evidence_type" id="evidence_type"
                        name="evidence_type">

                </select>
            </div><!--form-group-->

            <div class="form-group col-lg-12">
                <label for="row_evidence"><p style="color:#ccc;margin:0;padding:0;"> ردیف مدرک :</p></label>
                <input class="form-control row_evidence read_only" type="text" name="row_evidence" value="1"
                       placeholder="مقدار پیش فرض 1 می باشد" maxlength="3"
                       style="background:#ccc">{{ old('row_evidence') }}
            </div><!--form-group-->

            <div class="form-group col-lg-12">
                <label for="page_number"> شماره صفحه:</label>
                <input class="form-control page_number read_only" id=page_number type="text" name="page_number"
                       value="1">{{ old('page_number') }}
                <p class="click_for_sum_page" style='color:red;font-size:9.9pt'>لطفا پس از هر تغیر روی فیلد شماره صفحه
                    کلیک نمایید.</p>
            </div><!--form-group-->

            <div class="form-group col-lg-12">
                <label for="page_counter"> برگ شمار :</label>
                <input class="form-control page_counter read_only" type="text" name="page_counter" value=""
                       placeholder="برگ شمار " maxlength="4" readonly>{{ old('page_counter') }}
            </div><!--form-group-->


            <div class="form-group col-lg-12">
                <label for="Number_evidence"> شماره مدرک:</label>
                <input class="form-control Number_evidence read_only" id="Number_evidence" type="text"
                       name="Number_evidence" value="" placeholder="شماره مدرک">{{ old('Number_evidence') }}
            </div><!--form-group-->


            <div class="form-group col-lg-12">
                <label for="date_evidence"> تاریخ مدرک:</label>
                <input class="form-control date_evidence read_only" id="date_evidence"
                       style="direction: ltr;text-align: right"
                       type="text"
                       name="date_evidence" value="" maxlength="8" placeholder="13990422">{{ old('date_evidence') }}
            </div><!--form-group-->


            <div class="form-group col-lg-12 address">
                <input class="form-control" type="hidden" id="image" name="image" value="" placeholder="ادرس تصویر">
                <input class="form-control" type="hidden" id="ext" name="ext" value="" placeholder="پسوند تصویر">
            </div><!--form-group-->
            <button data-toggle="modal" data-target="#exampleModalCenter" type="button" id="modal" class="d-none">
            </button>

            <div class="col-lg-12">
                <button id="save" disabled class="btn btn-success mt-3 savee"> ثبت اطلاعات</button>
            </div>

            <!-- <span class="col-lg-11 d-block w-100 mx-auto mt-4 d-none" style="border: 1px solid #ccc;height:2px;display: none"></span> -->
            <!-- <div class="col-lg-12 ">
                <label for="edit"><p style="margin:0;padding:0;" class="mt-2"> ویرایش :</p></label>
                <button  disabled id="edit"class="btn mt-1 savee p-0" style="background:#ffb90f">
                     <a href="{{route('edit')}}" target="_blank" style="color: black;text-decoration: none;width: 100%;display: block;height: 100%;line-height: 70px;">ویرایش اطلاعات</a>
                </button>
            </div> -->

{{--            <span class="col-lg-11 d-block w-100 mx-auto mt-4 d-none" style="border: 1px solid #ccc;height:2px"></span>--}}

            <div class="col-lg-12 ">
                <label for="oneReview"><p style="margin:0;padding:0;" class="mt-2"> بررسی :</p></label>
                <button data-toggle="modal" data-target="#overView" class="btn btn-outline-primary mb-4 savee"
                        style="height: 40px!important;">بررسی کلی
                </button>

                <button data-toggle="modal" data-target="#OneoverView" class="btn btn-outline-primary mb-4 savee"
                        style="height: 40px!important;">بررسی جزئی
                </button>
            </div>

            <div>
            </div>


            <span class="col-lg-11 d-block w-100 mx-auto" style="border: 1px solid #ccc;height:2px"></span>


            <div class="form-group col-lg-12 mt-3 ">
                <label for="delet"><p style="margin:0;padding:0;"> حذف فایل :</p></label>

                <button data-toggle="modal" data-target="#delete_file_by_user" id="delete"
                        class="form-control btn btn-outline-danger"> حذف فایل
                </button>
            </div><!--form-group-->
        </div><!--col-lg-3-->


        <div class="col-lg-9 click_for_up_down_image">

            <div id="carouselExampleIndicators" class="carousel mt-2 mb-2 slide " data-ride="carousel">
                <div class="carousel-inner sc" style="height:100vh;">
                </div>

                <div class="arrow_orginal">
                    <a class="carousel-control-prev" onclick="prev()" style="display: none;"
                       href="#carouselExampleIndicators" role="button"
                       data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" style="display: none;" href="#carouselExampleIndicators"
                       role="button"
                       data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
                {{--arrow_orginal--}}


                <div class="arrow_overview" style="display: none">
                    <a class="carousel-control-prev" onclick="overViewPrev()" href="#carouselExampleIndicators"
                       role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" onclick="overViewNext()" href="#carouselExampleIndicators"
                       role="button"
                       data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
                {{--arrow_overview--}}


            </div>
        </div><!--col-lg-9-->


    </div><!--row-->
</div><!--continer-->


<!-- modal for access delete all image-->
<div class="modal fade" id="modal_delete_date" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
     aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered " style="width: 480px!important; " role="document">
        <div class="modal-content" style="border-radius: 8px">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <div class="w-100">
                    <div>
                        {{--                        <p style="font-size:17pt;color:red;text-align:center" class="w-100 d-block m-0 p-0"> توجه--}}
                        {{--                            !!!</p>--}}
                    </div>

                </div>

            </div>


            <div class="modal-body" style="border-top: none!important;">
                <p style="" class="p-1 text-center">آیا میخواهید تمام تصاویر آپلود شده را حذف
                    نمایید؟</p>
            </div>

            <div class="modal-footer" style="border: none!important;">
                <div class="col-8 mx-auto d-flex justify-content-between">
                    <button type="button" class="btn btn-danger" style="width: 80px" data-dismiss="modal"
                            aria-label="Close">لغو
                    </button>
                    <button type="button" class="btn btn-primary" style="width: 80px" data-dismiss="modal"
                            onclick="Operation()" id="">تایید
                    </button>

                </div>

            </div>
        </div>
    </div>
</div>


<!-- modal delete page by user-->
<div class="modal fade" id="delete_file_by_user" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
     aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">حذف برگه</h5>
                <button type="button" class="close" style="position: absolute; left: 0px;" data-dismiss="modal"
                        aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group col-lg-12">
                    <label for="page_number"><p style="margin:0;padding:0;">شماره برگه :</p></label>
                    <input class="form-control " style="direction: ltr;text-align: right" type="text"
                           name="delete_file_by_user" value="" placeholder="شماره برگه" maxlength="4">
                    <div class="form-group mt-3">
                        <label for="code_water"> منبع آب :</label>
                        <select class="form-control code_water" id="code_water_modal" name="code_water_modal">
                            <option value="">منبع آب را انتخاب نمایید</option>
                            <option value="11">چاه</option>
                            <option value="12">چشمه</option>
                            <option value="13">شبکه</option>
                            <option value="14">قنات</option>
                            <option value="15">سد</option>
                            <option value="16">رودخانه</option>
                            <option value="17">آب بندان</option>
                            <option value="18">استخر ذخیره</option>
                            <option value="19">پس آب</option>
                            <option value="20">حریم و بستر</option>
                            <option value="99">سایر</option>
                        </select>
                    </div><!--form-group-->

                    <div class="form-group">
                        <label for="date_evidence"><p style="margin:0;padding:0;">نام پرونده : (به جای '/' از '.'
                                استفاده شود)</p></label>
                        <input class="form-control " style="direction: ltr;text-align: right" type="text"
                               placeholder="نام پرونده را وارد نمایید"
                               name="code_clase_modal" value="">
                    </div><!--form-group-->

                    <div class="form-group">
                        <label for="modal_delete_state">  انتخاب منطقه :</label>
                        <select class="form-control modal_delete_state" id="modal_delete_state" name="modal_delete_state">
                            <option value="">منطقه مورد نظر را انتخاب نمایید </option>
                            <option value="ق">قزوین</option>
                            <option value="آ">آبیک</option>
                            <option value="ت">تاکستان</option>
                            <option value="ب">بوئین زهرا</option>
                            <option value="ج">آوج</option>
                        </select>
                    </div><!--form-group-->
                </div>
                <div class="modal-footer">
                    <div class="col-6 mx-auto d-flex justify-content-between">
                        <button type="button" onclick="" style="width: 80px"
                                class="btn btn-danger" class="close" data-dismiss="modal" aria-label="Close">خیر
                        </button>

                        <button type="button" class="btn btn-primary" style="width: 80px" data-dismiss="modal"
                                onclick="delete_file_by_user()">بله
                        </button>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- modal continue case-->
<div class="modal fade" id="continue_case" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
     aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">ادامه پرونده</h5>
                <button type="button" class="close" style="position: absolute; left: 0px;" data-dismiss="modal"
                        aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group col-lg-12">
                    <div class="form-group">
                        <label for="code_water"> منبع آب :</label>
                        <select class="form-control code_water" id="code_water_continue" name="code_water_continue">
                            <option value="">منبع آب را انتخاب نمایید</option>
                            <option value="11">چاه</option>
                            <option value="12">چشمه</option>
                            <option value="13">شبکه</option>
                            <option value="14">قنات</option>
                            <option value="15">سد</option>
                            <option value="16">رودخانه</option>
                            <option value="17">آب بندان</option>
                            <option value="18">استخر ذخیره</option>
                            <option value="19">پس آب</option>
                            <option value="20">حریم و بستر</option>
                            <option value="99">سایر</option>
                        </select>
                    </div><!--form-group-->

                    <div class="form-group">
                        <label for="date_evidence"><p style="margin:0;padding:0;">نام پرونده : (به جای '/' از '.'
                                استفاده شود) </p></label>
                        <input class="form-control " style="direction: ltr;text-align: right" type="text"
                               placeholder="نام پرونده را وارد نمایید"
                               name="code_clase_continue" value="">
                    </div><!--form-group-->

                    <div class="form-group">
                        <label for="state_continue"> انتخاب منطقه :</label>
                        <select class="form-control state_continue" id="state_continue" name="state_continue">
                            <option value="">منطقه مورد نظر را انتخاب نمایید </option>
                            <option value="ق">قزوین</option>
                            <option value="آ">آبیک</option>
                            <option value="ت">تاکستان</option>
                            <option value="ب">بوئین زهرا</option>
                            <option value="ج">آوج</option>
                        </select>
                    </div><!--form-group-->
                </div>
                <div class="modal-footer">
                    <div class="col-6 mx-auto d-flex justify-content-between">
                        <button type="button" onclick="" style=""
                                class="btn btn-danger" class="close" data-dismiss="modal" aria-label="Close">لغو
                        </button>

                        <button type="button" class="btn btn-primary" style="" data-dismiss="modal"
                                onclick="continueDucument()">ادامه
                        </button>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- modal to recive code samab-->
<div class="modal fade" id="amplifier" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
     aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">ساماب</h5>
                <button type="button" class="close" style="position: absolute; left: 0px;" data-dismiss="modal"
                        aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group col-lg-12">
                    <div class="form-group">
                        <label for="date_evidence"><p style="margin:0;padding:0;"> کد کلاسه :</p></label>
                        <input class="form-control " style="direction: ltr;text-align: right" type="text"
                               placeholder="کد کلاسه را وارد نمایید"
                               name="code_clase_modal_samab" value="">
                    </div><!--form-group-->


                    <div class="form-group">
                        <label for="date_evidence"><p style="margin:0;padding:0;">نام پرونده : </p></label>
                        <input class="form-control " style="direction: ltr;text-align: right" type="text"
                               placeholder=" نام پرونده را وارد نمایید"
                               name="folder_operation_modal_samab" value="">
                    </div><!--form-group-->

                    <div class="form-group">
                        <label for="state">  انتخاب منطقه :</label>
                        <select class="form-control state" id="state" name="state">
                            <option value="">منطقه مورد نظر را انتخاب نمایید </option>
                            <option value="ق">قزوین</option>
                            <option value="آ">آبیک</option>
                            <option value="ت">تاکستان</option>
                            <option value="ب">بوئین زهرا</option>
                            <option value="ج">آوج</option>
                        </select>
                    </div><!--form-group-->
                </div>
                <div class="modal-footer">
                    <div class="col-6 mx-auto d-flex justify-content-between">
                        <button type="button" onclick="" style=""
                                class="btn btn-danger" class="close" data-dismiss="modal" aria-label="Close">لغو
                        </button>

                        <button type="button" class="btn btn-primary" style="" data-dismiss="modal"
                                onclick="get_code_samab()">دریافت کد ساماب
                        </button>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- modal for overView-->
<div class="modal fade" id="overView" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
     aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle"> بررسی کلی</h5>
                <button type="button" class="close" style="position: absolute; left: 0px;" data-dismiss="modal"
                        aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group col-lg-12">
                    <div class="form-group">
                        <label for="code_water"> منبع آب :</label>
                        <select class="form-control code_water" id="code_water_overView" name="code_water_modal">
                            <option value="">منبع آب را انتخاب نمایید</option>
                            <option value="11">چاه</option>
                            <option value="12">چشمه</option>
                            <option value="13">شبکه</option>
                            <option value="14">قنات</option>
                            <option value="15">سد</option>
                            <option value="16">رودخانه</option>
                            <option value="17">آب بندان</option>
                            <option value="18">استخر ذخیره</option>
                            <option value="19">پس آب</option>
                            <option value="20">حریم و بستر</option>
                            <option value="99">سایر</option>
                        </select>
                    </div><!--form-group-->

                    <div class="form-group">
                        <label for="date_evidence"><p style="margin:0;padding:0;">نام پرونده : (به جای '/' از '.'
                                استفاده شود) </p></label>
                        <input class="form-control " style="direction: ltr;text-align: right" type="text"
                               placeholder="نام پرونده را وارد نمایید"
                               name="code_clase_overView" value="">
                    </div><!--form-group-->
                </div>
                <div class="modal-footer">
                    <div class="col-6 mx-auto d-flex justify-content-between">
                        <button type="button" onclick="" style=""
                                class="btn btn-danger" class="close" data-dismiss="modal" aria-label="Close">لغو
                        </button>

                        <button type="button" class="btn btn-primary" style="" data-dismiss="modal"
                                onclick="overView()">نمایش
                        </button>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- modal for one overView-->
<div class="modal fade" id="OneoverView" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
     aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle"> بررسی جزئی</h5>
                <button type="button" class="close" style="position: absolute; left: 0px;" data-dismiss="modal"
                        aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group col-lg-12">
                    <label for="one_over_view"><p style="margin:0;padding:0;">شماره برگه :</p></label>
                    <input class="form-control " style="direction: ltr;text-align: right" type="text"
                           name="OneOverView" value="" placeholder="شماره برگه" maxlength="4">

                    <div class="form-group">
                        <label for="code_water"> منبع آب :</label>
                        <select class="form-control code_water" id="code_water_one_overView"
                                name="code_water_one_overView">
                            <option value="">منبع آب را انتخاب نمایید</option>
                            <option value="11">چاه</option>
                            <option value="12">چشمه</option>
                            <option value="13">شبکه</option>
                            <option value="14">قنات</option>
                            <option value="15">سد</option>
                            <option value="16">رودخانه</option>
                            <option value="17">آب بندان</option>
                            <option value="18">استخر ذخیره</option>
                            <option value="19">پس آب</option>
                            <option value="20">حریم و بستر</option>
                            <option value="99">سایر</option>
                        </select>
                    </div><!--form-group-->

                    <div class="form-group">
                        <label for="date_evidence"><p style="margin:0;padding:0;">نام پرونده : (به جای '/' از '.'
                                استفاده شود) </p></label>
                        <input class="form-control " style="direction: ltr;text-align: right" type="text"
                               placeholder="نام پرونده را وارد نمایید"
                               name="code_clase_one_overView" value="">
                    </div><!--form-group-->
                </div>
                <div class="modal-footer">
                    <div class="col-6 mx-auto d-flex justify-content-between">
                        <button type="button" onclick="" style=""
                                class="btn btn-danger" class="close" data-dismiss="modal" aria-label="Close">لغو
                        </button>

                        <button type="button" class="btn btn-primary" style="" data-dismiss="modal"
                                onclick="OneOverView()">نمایش
                        </button>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<script>


    $(window).on("load", function () {
        let user_id = {{\Illuminate\Support\Facades\Auth::user()->id}}
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'POST',
            url: '{{route('access.upload')}}',
            dataType: 'json',
            data: {user_id},
            success: function (accessUpload) {
                window.accessUpload_folder_name = accessUpload.folder_name;
                alertContinueDocument();
                $('input[name=code_clase]').val(accessUpload.folder_name.split('.').slice(0, -1).join('.'));
                // $("select[name=code_water]").val(accessUpload.code_water).change();
                $('input[name=code_clase]').prop('readonly', true);
                // $('select[name="code_water"]').attr("disabled", true);

            }
        })
    });


    //for get code samab
    function get_code_samab() {
        let code_clase_modal_samab = $('input[name=code_clase_modal_samab]').val();
        let folder_operation_modal_samab = $('input[name=folder_operation_modal_samab]').val();
        let state = $('#state :selected').val();
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'POST',
            url: '{{route('get.samab')}}',
            dataType: 'json',
            data: {
                code_clase_modal_samab: code_clase_modal_samab,
                folder_operation_modal_samab: folder_operation_modal_samab,
                state:state,
            },
            success: function (code_samab) {
                if (code_samab == 'no') {
                    noCodeSpecial();
                } else {
                    $('input[name=code_special]').val(code_samab);
                }
            }
        });
    }


    // for check name folder if coding by user
    $(document).on('change', '#code_water', function () {
        let code_clase = $('input[name=code_clase]').val()
        let code_water = $('#code_water :selected').val();
        let state1 = $('#state1 :selected').val();
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'POST',
            url: '{{route('check.folder')}}',
            dataType: 'json',
            data: {code_clase, code_water,state1},
            success: function (checkFolder) {
              alert('این پرونده قبلا توسط کاربر '.concat(checkFolder).concat(' کد گذاری شده است. '))

            }
        });
    });


    // for continue document
    function continueDucument() {
        let code_clase_continue = $('input[name=code_clase_continue]').val()
        let code_water_continue = $('#code_water_continue :selected').val();
        let state_continue = $('#state_continue :selected').val();
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'POST',
            url: '{{route('continue.document')}}',
            dataType: 'json',
            data: {code_clase_continue, code_water_continue,state_continue:state_continue},
            success: function (countDocument) {
                let len_finalImage_directory = countDocument.length;
                $('input[name=rename_img]').val(len_finalImage_directory);
                $('#photo').css('display', 'block');
                $('#fake_photo').css('display', 'none');
            }
        });
    }


    // for delete upload photos after click on Operation button
    function Operation() {
        location.reload();
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'POST',
            url: '{{route('delete.upload.photos')}}',
            dataType: 'json',
            data: {},
            success: function (deleteStorage) {

            }, error: function (deleteStorage) {
                alert("در حذف کردن فایل های آپلود شده خطایی به وجود آمده است");
            }
        });
    }


    //for upload picture by dropzone
    $("#photo").dropzone({
        url: '{{route('upload.image')}}',
        uploadMultiple: true,
        parallelUploads: 1,
        timeout: 1000000,
        maxRequestSize: 800000, //Mb
        autoProcessQueue: true,
        autoDiscover: false,
        dictDefaultMessage: "آپلود تصویر",
        acceptedFiles: ".jpeg,.jpg,.png,.tif,.tiff",
        sending: function (file, xhr, formData) {
            formData.append("_token", "{{csrf_token()}}")
        },
        success: function (file, response) {
            // $('#photo').css('display','none');
            $('.carousel-item.active img').attr('id', '');
            // $('input[name=rename_img]').val('');
            $('input[name=total_img]').val('');
            $('input[name=row_evidence]').val(1);
            $('.zoomContainer').fadeOut();
            $('.carousel-inner .carousel-item').removeClass('active');
            // if (response.number !== null) {
            //     $('input[name=code_special]').val(response.number);
            // }
            // if (response.clase !== null) {
            //     $('input[name=code_clase]').val(response.clase);
            // }
            var content_img = '<div class="carousel-item" data_img="' + response.preview_name + '"><img  id="" class="d-block img w-100"' +
                ' data-src="storage/photos/' + response.photo_name + '"' +
                ' src="storage/photos/{{\Illuminate\Support\Facades\Auth::user()->id}}/' + response.preview_name + '" alt="' +
                response.preview_name +
                '" data-zoom-image="storage/photos/{{\Illuminate\Support\Facades\Auth::user()->id}}/' +
                response.preview_name + '"></div>';


            $(content_img).appendTo('.carousel-inner');
            $(".carousel-item").sort(sort_img).appendTo('.carousel-inner');

            function sort_img(a, b) {
                return $(a).attr('data_img') < $(b).attr('data_img') ? 1 : -1;
            }


            $('.carousel-inner .carousel-item:last-child').addClass('active');
            let insert_src_image = $('.carousel-inner .carousel-item.active img').attr('data-src').substr(15);
            var ext = insert_src_image.split('.').pop();
            var only_name = insert_src_image.split('.').slice(0, -1).join('.');
            $('input[name=image]').val(only_name);
            $('input[name=ext]').val(ext);
            $('.carousel-item.active img').attr('id', 'zoom_01');
            var length_carousel_item_active = $('.carousel-item.active').length;
            if (length_carousel_item_active > 0) {
                $('#save').prop("disabled", false);
            }


            window.tedad_item = $('.carousel-item').length;


            //for value page counter
            let recive_name_img = $('input[name=image]').val()
            let value_page_counter = recive_name_img.slice(0, -1);
            $('input[name=page_counter]').val(value_page_counter);
            //for total img
            const total_img = $('.carousel-item').length;
            $('input[name=total_img]').val(total_img);
        }
    });


    window.veryMuchUpload=true;
    $(document).on('click', '#save', function () {
       let total_img= $('input[name=total_img]').val();
       let rename_img= $('input[name=rename_img]').val();
       let code_clase= $('input[name=code_clase]').val();
       let code_water = $('#code_water :selected').val();
       let state1 = $('#state1 :selected').val();

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'POST',
            url: '{{route('sum.total.count')}}',
            dataType: 'json',
            data: {total_img,rename_img,code_clase,code_water,state1},
            success: function (sumTotal) {
                if (sumTotal == 'sum is biger'){
                    veryMuchUpload=false;
                }
            }
    });
    });

        //for if page refresh
    let length_carousel_item = $('.carousel-item').length;
    if (length_carousel_item == 0) {
        $('input[name=image]').val('');
        $('input[name=ext]').val('');
        $('input[name=date_evidence]').val('');
        $('input[name=Number_evidence]').val('');
        $('input[name=rename_img]').val('');
        $('input[name=total_img]').val('');
        $('input[name=row_evidence]').val(1);
    }


    //for recive sub evidence
    $('.code_evidence').click(function () {
        var id_code_evidence = $(this).val();

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'POST',
            url: '{{route('get.evidence')}}',
            dataType: 'json',
            data: {id_code_evidence: id_code_evidence},
            success: function (get_id_code_evidence) {
                if (get_id_code_evidence.length > 0) {
                    $('.Document_type').html('');
                    $.each(get_id_code_evidence, function (index, element) {
                        var data_ajax = '<option value="' + element.value + '">' + element.title + '</option>';
                        $('.Document_type').append(data_ajax);
                    });
                } else {
                    $('.Document_type').html('');
                }
            },
            // error: function (getdata_sub_cat) {
            //     alert("خطا در دریافت اطلاعات نوع مدرک");
            // }
        });
    });


    //for stop scroll slider
    $('.carousel').carousel({
        interval: 0,
        wrap: false,
    });


    //for read storage and sum count file if exist
    window.access_submit = false;
    $(document).on('click', '#page_number', function () {
        let code_water = $('#code_water :selected').val();
        let code_clase = $('input[name=code_clase]').val();
        let state1 = $('#state1 :selected').val();
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'POST',
            url: '{{route('read.storage')}}',
            dataType: 'json',
            data: {code_water: code_water, code_clase: code_clase,state1:state1},
            success: function (ReadStorage) {
                window.arr = [];
                window.arr2 = [];
                window.arr3 = [];
                access_submit = true;

                $.each(ReadStorage, function (index, value) {
                    let storage_full_name = value.replace(/^.*\//, "");
                    let del1 = storage_full_name.split('@').slice(0, -1).join('@');
                    let del2 = del1.split('@').slice(0, -1).join('@');
                    let del3 = del2.substr(8);
                    let result = del3.substring(7, -7);
                    let for_row_evidence = del3.substring(4, -10);
                    let del4 = del3.substr(4);
                    let del5 = del3.substr(9).substring(1, -4);
                    arr.push(result);
                    arr2.push(del5);
                    arr3.push(for_row_evidence);
                });

                let code_evidence = $('#code_evidence :selected').val();
                let evidence_type = $('#evidence_type :selected').val();
                // let compare_page_number = $('input[name=page_number]').val();
                let row_evidence = $('input[name=row_evidence]').val();
                if (row_evidence.length == 1) {
                    let twoZero = '00';
                    row_evidence = twoZero.concat(row_evidence);
                }
                if (row_evidence.length == 2) {
                    let oneZero = '0';
                    row_evidence = oneZero.concat(row_evidence);
                }

                let array_get_code_user = code_evidence.concat(evidence_type).concat(row_evidence);

                if ($.inArray(array_get_code_user, arr) !== -1) {
                    var counter = 0;
                    for (var i = 0; i < arr.length; i++) {
                        if (array_get_code_user == arr[i]) {
                            counter++;
                        }
                    }


                    $('input[name=page_number]').val(counter);
                    let val_row_evidence = $('input[name=row_evidence]').val();
                    let val_page_number = $('input[name=page_number]').val();

                    if (val_row_evidence <= 999) {
                        var sum_page_number = 1;
                        sum_page_number += val_page_number * 1;
                        $('input[name=page_number]').val(sum_page_number);
                    }
                } else {
                    $('input[name=page_number]').val(1);
                }
            },
            error: function (ReadStorage) {
                alert("خطا در خواندن Storage");
            }
        });
    });


    //for create new row evidence
    $(document).on('keyup', '#page_number', function () {
        let val_after_key_up = $('input[name=page_number]').val();
        let code_evidence = $('#code_evidence :selected').val();
        let evidence_type = $('#evidence_type :selected').val();
        let compare_page_number = $('input[name=page_number]').val();
        let array_get_code_user = code_evidence.concat(evidence_type);
        if (val_after_key_up === '1') {

            if ($.inArray(array_get_code_user, arr3) !== -1 && $.inArray(compare_page_number, arr2) !== -1) {
                var counter = 0;
                for (var i = 0; i < arr.length; i++) {
                    if (array_get_code_user == arr3[i] && compare_page_number == arr2[i]) {
                        counter++;
                    }
                }

                $('input[name=row_evidence]').val(counter);
                let val_row_evidence = $('input[name=row_evidence]').val();
                if (val_row_evidence <= 999) {
                    var sum_row_evidence = 1;
                    sum_row_evidence += val_row_evidence * 1;
                    $('input[name=row_evidence]').val(sum_row_evidence);
                }
            } else {
                // $('input[name=page_number]').val(1);
            }
        } else {
            // $('input[name=row_evidence]').val(1);
        }
    });


    // trim for input number_evidence
    $('#Number_evidence').keyup(function () {
        let get_val_Number_evidence = $(this).val();
        get_val_Number_evidence = $.trim(get_val_Number_evidence).replace('/', '.');
        $('#Number_evidence').val(get_val_Number_evidence);
    });

    // convert slash to . for input code clase
    $('#code_clase').keyup(function () {
        let get_val_code_clase = $(this).val();
        get_val_code_clase = $.trim(get_val_code_clase).replace('/', '.');
        $('#code_clase').val(get_val_code_clase);
    });

    // convert slash to . for input code clase over view
    $('input[name=code_clase_overView]').keyup(function () {
        let code_clase_overView = $(this).val();
        get_code_clase_overView = $.trim(code_clase_overView).replace('/', '.');
        $('input[name=code_clase_overView]').val(get_code_clase_overView);
    });

    // convert slash to . for input code clase modal
    $('input[name=code_clase_modal]').keyup(function () {
        let code_clase_modal = $(this).val();
        get_code_clase_modal = $.trim(code_clase_modal).replace('/', '.');
        $('input[name=code_clase_modal]').val(get_code_clase_modal);
    });

    // convert slash to . for input code clase continue
    $('input[name=code_clase_continue]').keyup(function () {
        let code_clase_continue = $(this).val();
        get_code_clase_continue = $.trim(code_clase_continue).replace('/', '.');
        $('input[name=code_clase_continue]').val(get_code_clase_continue);
    });


    //for reset code water by check has folder
    $('#code_clase').keyup(function () {
        $("#code_water").val('').change();
    });

    //for reset state1 by check has folder
    $('#state1').change(function () {
        $("#code_water").val('').change();
    });


    //replace bad characters for date_evidence
    $('#date_evidence').keyup(function () {
        let get_val_date_evidence = $(this).val();
        get_val_date_evidence = get_val_date_evidence.replace(/[^\w\s]/gi, '');
        $('#date_evidence').val(get_val_date_evidence);
    });


    //for change code evidence to empty field
    $(document).on('change', '#code_evidence', function () {
        window.access_submit = false;
        $('input[name=date_evidence]').val('');
        $('input[name=Number_evidence]').val('');
        $('input[name=row_evidence]').val(1);
        $('input[name=page_number]').val(1);
    });


    //for change row evidence to empty field
    $(document).on('change', '#evidence_type', function () {
        window.access_submit = false;
        $('input[name=date_evidence]').val('');
        $('input[name=Number_evidence]').val('');
        $('input[name=row_evidence]').val(1);
        $('input[name=page_number]').val(1);
    });

    //for disable submit
    $('#code_evidence').change(function () {
        window.access_submit = false;
    })

    //for disable submit
    $('#evidence_type').change(function () {
        window.access_submit = false;
    })


    //for send info form to controller
    $(document).on('mouseup', '#save', function () {
        setTimeout(() => {
            if (veryMuchUpload == true) {
                if (access_submit == true) {
                    let code_special = $('input[name=code_special]').val();
                    let total_count = $('input[name=total_img]').val();
                    let code_water = $('#code_water :selected').val();
                    let code_evidence = $('#code_evidence :selected').val();
                    let evidence_type = $('#evidence_type :selected').val();
                    let row_evidence = $('.row_evidence').val();
                    window.save_row_evidence = $('.row_evidence').val();
                    let page_number = $('.page_number').val();
                    let page_counter = $('.page_counter').val();
                    window.save_page_counter = $('.page_counter').val();
                    let Number_evidence = $('.Number_evidence').val();
                    window.save_Number_evidence = $('.Number_evidence').val();
                    let date_evidence = $('.date_evidence').val();
                    window.save_date_evidence = $('.date_evidence').val();
                    let image = $('input[name=image]').val();
                    let ext = $('input[name=ext]').val();
                    let code_clase = $('input[name=code_clase]').val();
                    let state1 = $('#state1 :selected').val();
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },

                        type: 'POST',
                        url: '{{route('store')}}',
                        dataType: 'json',
                        data: {
                            code_special,
                            code_water,
                            code_evidence,
                            evidence_type,
                            row_evidence,
                            page_number,
                            page_counter,
                            Number_evidence,
                            image,
                            ext,
                            date_evidence,
                            code_clase,
                            total_count,
                            state1,
                        },
                        success: function (return_data_image) {

                            if (return_data_image === 'success') {
                                sweetalert();
                                $('.carousel-item.active').addClass('del');
                                $('.alert-danger').css('display', 'none');
                                $(".carousel-control-prev").click();
                                // $('.row_evidence').val(1);
                                $('#photo').css('display', 'none');
                                $('#fake_photo').css('display', 'block');

                                //for sum rename img
                                let val_rename_img = $('input[name=rename_img]').val();
                                let rename_file = 1;
                                rename_file += val_rename_img * 1;
                                $('input[name=rename_img]').val(rename_file);


                                //for minus total img
                                let val_total_img = $('input[name=total_img]').val();
                                let total_file = 1;
                                total_file = val_total_img -1 * 1;
                                $('input[name=total_img]').val(total_file);
                            }
                            if (return_data_image === 'exists_file') {
                                $('.exists_file').css('display', 'block');
                                $("html, body").animate({scrollTop: 0}, "slow");
                            }

                            if (return_data_image === 'not_match') {
                                moreThanUpload();
                            }
                        },
                        error: function (return_data_image) {
                            if (!return_data_image.responseJSON) {
                                $('.alert-danger').css('display', 'none');
                            } else {
                                sweetalertError();
                                $('.error .append_error').html(' ');
                                $('.alert-danger').css('display', 'block');
                                $("html, body").animate({scrollTop: 0}, "slow");
                                $.each(return_data_image.responseJSON, function (index, value) {
                                    $('.error .append_error').append('<li>' + value + '</li>');
                                });
                            }
                        }
                    });

                } else if (access_submit == false) {
                    clickOnPageNumber();
                }
            } else if (veryMuchUpload == false) {
                notEqulSumUpload();
            }
        },200);
           
    });




    //for view prev image
    function prev() {
        access_submit = false;
        $('.carousel-item img').attr('id', '');
        $('.zoomContainer').fadeOut();
        $('input[name=page_number]').val(1);

        setTimeout(function () {
            // $('#save').attr('onclick','sub()');

            $('.carousel-item.del').remove();
            var length_carousel = $('.carousel-item.active').length;
            if (length_carousel < 1) {
                $('#save').prop("disabled", "disabled");
            }
            $('.carousel-item.active img').attr('id', 'zoom_01');
            let insert_src_image = $('.carousel-inner .carousel-item.active img').attr('data-src').substr(15);
            var ext = insert_src_image.split('.').pop();
            var only_name = insert_src_image.split('.').slice(0, -1).join('.');
            $('input[name=image]').val(only_name);
            $('input[name=ext]').val(ext);

            // var myString = $('input[name=image]').val();
            // myString[myString.length - 1];

            // if (myString[myString.length - 1] == 'A') {
            //     $('input[name=page_number]').val(1);
            // } else {
            //     $('input[name=page_number]').val(2);
            // }


            //for value page counter
            let recive_name_img = $('input[name=image]').val()
            let value_page_counter = recive_name_img.slice(0, -1);
            $('input[name=page_counter]').val(value_page_counter);
            let save_value_page_counter = recive_name_img.slice(0, -1);
        }, 700);
        let tedad_item = $('.carousel-item').length;
        if (tedad_item == 1) {
            OperationComplete();
        }
    }


    //for delete file by user
    function delete_file_by_user() {
        let val_delete = $('input[name=delete_file_by_user]').val();
        if (val_delete.length == 1) {
            val_delete = '000'.concat(val_delete)
        }
        if (val_delete.length == 2) {
            val_delete = '00'.concat(val_delete)
        }
        if (val_delete.length == 3) {
            val_delete = '0'.concat(val_delete)
        }
        let code_clase_modal = $('input[name=code_clase_modal]').val();
        let code_water_modal = $('#code_water_modal :selected').val();
        let delete_state_modal = $('#modal_delete_state :selected').val();

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'POST',
            url: '{{route('delete.file.by.user')}}',
            dataType: 'json',
            data: {code_clase_modal: code_clase_modal, code_water_modal: code_water_modal, val_delete: val_delete,delete_state_modal:delete_state_modal},
            success: function (result) {
                alert('ردیف مدرک برگه حذف شده : '.concat(result.deleted_row_evidence));
            let val_rename_img=$('input[name=rename_img]').val();
               let minus_rename_img=val_rename_img - result.counter_delete;
                $('input[name=rename_img]').val(minus_rename_img);
            }
        });

    }


    //for press enter key to submit form
    $(document).keyup(function (e) {
        if (e.keyCode === 13) {
            sub();
        }
        if (e.keyCode === 37) {
            overViewPrev();
        }
        if (e.keyCode === 39) {
            overViewNext();
        }
    });

    // for overVeiw
    function overView() {
        let code_clase_overView = $('input[name=code_clase_overView]').val()
        let code_water_overView = $('#code_water_overView :selected').val();
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'POST',
            url: '{{route('overView')}}',
            dataType: 'json',
            data: {code_water_overView, code_clase_overView},
            success: function (overview) {
                $('.carousel-inner').html(' ');
                $('.alert-danger').css('display', 'none');
                $('.carousel-control-prev').css('display', 'block');
                $('.carousel-control-next').css('display', 'block');
                $('.new_coding').css('display', 'block');
                $('#save').css('display', 'none');
                $('#rename_img').css('display', 'none');
                $('#total_img').css('display', 'none');
                $('#dropzone').css('display', 'none');
                $('.samab').css('display', 'none');
                $('.continue_document').css('display', 'none');
                $('.clear_refresh').css('display', 'none');
                $('#folder_coding').css('display', 'none');
                $('#folder_coded').css('display', 'block');
                $('#user_name').css('display', 'block');
                $('input[name=user_name]').val(overview.user_name);
                $('.read_only').prop('readonly', true);
                $('.page_number').removeAttr('id', 'page_number');
                $('.click_for_sum_page').css('display', 'none');
                $('select[name="code_water"]').attr("disabled", true);
                $('select[name="code_water"]').removeAttr('id', 'code_water');
                $('#code_evidence').attr("disabled", true);
                $('#evidence_type').attr("disabled", true);
                $('.arrow_orginal').css('display', 'none');
                $('.arrow_overview').css('display', 'block');
                $('input[name=code_clase]').val(overview.folder_name);

                $.each(overview.read_overview, function (index, value) {
                    $('.carousel-inner .carousel-item').removeClass('active');

                    let storage_full_name = value.replace(/^.*\//, "");
                    let del1 = storage_full_name.split('@').slice(0, -1).join('@');
                    let del2 = del1.split('@').slice(0, -1).join('@');
                    let save_for_sort = del2.substr(18);
                    var c = '<div class="carousel-item"><img id="" class="d-block img w-100"' + ' src="storage/review/{{Auth::user()->id}}/' + storage_full_name + '" alt="" data_page="' + save_for_sort + '" data_info="' + storage_full_name + '"></div>';

                    $(c).appendTo('.carousel-inner');
                    $(".carousel-item").sort(sort_img).appendTo('.carousel-inner');

                    function sort_img(a, b) {
                        return parseInt($(a).attr('data_img')) < parseInt($(b).attr('data_img')) ? 1 : -1;

                    }

                    $('.carousel-inner .carousel-item:first-child').addClass('active');

                    let data_info = $('.carousel-inner .carousel-item.active img').attr('data_info');
                    let samab = data_info.substring(0, 6);
                    let code_water = data_info.substr(6, 2);
                    let code_evidence = data_info.substr(8, 2);
                    let evidence_type = data_info.substr(10, 2);
                    let row_evidence = data_info.substr(12, 3);
                    let page_number = data_info.substr(15, 3);
                    let page_counter = data_info.substr(18, 4);
                    let e1 = data_info.split('@').slice(1, -1).join('@');
                    let e2 = data_info.split('.').slice(0, -1).join('.');
                    let e3 = e2.split('.').slice(0, -1).join('.');
                    let e4 = e3.split('@');

                    $('input[name=code_special]').val(samab);
                    $("select[name=code_water]").val(code_water).change();
                    $("#code_evidence").val(code_evidence).change();
                    $('#code_evidence').click();
                    setTimeout(function () {
                        $("#evidence_type").val(evidence_type).change();
                        $('input[name=row_evidence]').val(row_evidence);
                        $('input[name=page_number]').val(page_number);
                        $('input[name=page_counter]').val(page_counter);
                        $('input[name=Number_evidence]').val(e1);
                        $('input[name=date_evidence]').val(e4[2]);
                    }, 500);
                });
            }
        });
    }


    // for one overVeiw
    function OneOverView() {
        let page_OneOverView = $('input[name=OneOverView]').val()
        let code_water_one_overView = $('#code_water_one_overView :selected').val();
        let code_clase_one_overView = $('input[name=code_clase_one_overView]').val()

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'POST',
            url: '{{route('oneOverView')}}',
            dataType: 'json',
            data: {page_OneOverView, code_water_one_overView, code_clase_one_overView},
            success: function (overview) {

                $('.carousel-inner').html(' ');
                $('.alert-danger').css('display', 'none');
                $('.carousel-control-prev').css('display', 'block');
                $('.carousel-control-next').css('display', 'block');
                $('.new_coding').css('display', 'block');
                $('#save').css('display', 'none');
                $('#rename_img').css('display', 'none');
                $('#total_img').css('display', 'none');
                $('#dropzone').css('display', 'none');
                $('.samab').css('display', 'none');
                $('.continue_document').css('display', 'none');
                $('.clear_refresh').css('display', 'none');
                $('#folder_coding').css('display', 'none');
                $('#folder_coded').css('display', 'block');
                $('#user_name').css('display', 'block');
                $('input[name=user_name]').val(overview.user_name);
                $('.read_only').prop('readonly', true);
                $('.click_for_sum_page').css('display', 'none');
                $('.page_number').removeAttr('id', 'page_number');
                $('select[name="code_water"]').attr("disabled", true);
                $('select[name="code_water"]').removeAttr('id', 'code_water');
                $('#code_evidence').attr("disabled", true);
                $('#evidence_type').attr("disabled", true);
                $('.arrow_orginal').css('display', 'none');
                $('.arrow_overview').css('display', 'block');
                $('input[name=code_clase]').val(overview.folder_name);

                $.each(overview.read_overview, function (index, value) {
                    $('.carousel-inner .carousel-item').removeClass('active');

                    let storage_full_name = value.replace(/^.*\//, "");
                    let del1 = storage_full_name.split('@').slice(0, -1).join('@');
                    let del2 = del1.split('@').slice(0, -1).join('@');
                    let save_for_sort = del2.substr(18);

                    var c = '<div class="carousel-item"><img id="" class="d-block img w-100"' + ' src="storage/review/{{Auth::user()->id}}/' + storage_full_name + '" alt="" data_page="' + save_for_sort + '" data_info="' + storage_full_name + '"></div>';

                    $(c).appendTo('.carousel-inner');
                    $(".carousel-item").sort(sort_img).appendTo('.carousel-inner');

                    function sort_img(a, b) {
                        return parseInt($(a).attr('data_img')) < parseInt($(b).attr('data_img')) ? 1 : -1;

                    }

                    $('.carousel-inner .carousel-item:first-child').addClass('active');


                    let data_info = $('.carousel-inner .carousel-item.active img').attr('data_info');
                    let samab = data_info.substring(0, 6);
                    let code_water = data_info.substr(6, 2);
                    let code_evidence = data_info.substr(8, 2);
                    let evidence_type = data_info.substr(10, 2);
                    let row_evidence = data_info.substr(12, 3);
                    let page_number = data_info.substr(15, 3);
                    let e1 = data_info.split('@').slice(1, -1).join('@');
                    let page_counter = data_info.substr(18, 4);
                    let e2 = data_info.split('.').slice(0, -1).join('.');
                    let e3 = e2.split('.').slice(0, -1).join('.');
                    let e4 = e3.split('@');

                    $('input[name=code_special]').val(samab);
                    $("select[name=code_water]").val(code_water).change();
                    $("#code_evidence").val(code_evidence).change();
                    $('#code_evidence').click();
                    setTimeout(function () {
                        $("#evidence_type").val(evidence_type).change();
                        $('input[name=row_evidence]').val(row_evidence);
                        $('input[name=page_counter]').val(page_counter);
                        $('input[name=page_number]').val(page_number);
                        $('input[name=Number_evidence]').val(e1);
                        $('input[name=date_evidence]').val(e4[2]);
                    }, 500);
                });
            }
        });
    }


    //for overViewPrev
    function overViewPrev() {
        setTimeout(function () {
            let data_info = $('.carousel-inner .carousel-item.active img').attr('data_info');
            let samab = data_info.substring(0, 6);
            let code_water = data_info.substr(6, 2);
            let code_evidence = data_info.substr(8, 2);
            let evidence_type = data_info.substr(10, 2);
            let row_evidence = data_info.substr(12, 3);
            let page_number = data_info.substr(15, 3);
            let page_counter = data_info.substr(18, 4);
            let e1 = data_info.split('@').slice(1, -1).join('@');
            let e2 = data_info.split('.').slice(0, -1).join('.');
            let e3 = e2.split('.').slice(0, -1).join('.');
            let e4 = e3.split('@');


            $('input[name=code_special]').val(samab);
            $("select[name=code_water]").val(code_water).change();
            $("#code_evidence").val(code_evidence).change();
            $('#code_evidence').click();
            setTimeout(function () {
                $("#evidence_type").val(evidence_type).change();
                $('input[name=row_evidence]').val(row_evidence);
                $('input[name=page_number]').val(page_number);
                $('input[name=page_counter]').val(page_counter);
                $('input[name=Number_evidence]').val(e1);
                $('input[name=date_evidence]').val(e4[2]);
            }, 500);
        }, 700);
    }







    //for overViewNext
        function overViewNext() {
            setTimeout(function () {
                let data_info = $('.carousel-inner .carousel-item.active img').attr('data_info');
                let samab = data_info.substring(0, 6);
                let code_water = data_info.substr(6, 2);
                let code_evidence = data_info.substr(8, 2);
                let evidence_type = data_info.substr(10, 2);
                let row_evidence = data_info.substr(12, 3);
                let page_number = data_info.substr(15, 3);
                let page_counter = data_info.substr(18, 4);
                let e1 = data_info.split('@').slice(1, -1).join('@');
                let e2 = data_info.split('.').slice(0, -1).join('.');
                let e3 = e2.split('.').slice(0, -1).join('.');
                let e4 = e3.split('@');


                $('input[name=code_special]').val(samab);
                $("select[name=code_water]").val(code_water).change();
                $("#code_evidence").val(code_evidence).change();
                $('#code_evidence').click();
                setTimeout(function () {
                    $("#evidence_type").val(evidence_type).change();
                    $('input[name=row_evidence]').val(row_evidence);
                    $('input[name=page_number]').val(page_number);
                    $('input[name=page_counter]').val(page_counter);
                    $('input[name=Number_evidence]').val(e1);
                    $('input[name=date_evidence]').val(e4[2]);
                }, 500);
            }, 700);
        }






        function sweetalert() {
        swal({
            animation: true,
            icon: 'success',
            toast: true,
            allowEscapeKey: true,
            background: '#8fdf85',
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            title: 'تصویر ثبت شد',
        });
    }


    function sweetalertError() {
        swal({
            animation: true,
            icon: 'danger',
            toast: true,
            allowEscapeKey: true,
            background: '#ff5252',
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            title: 'خطا در ثبت تصویر!',
        });
    }

    //for remove elevatezoom
    $('.remove_zoom').hover(function () {
        $('.zoomLens').remove();
        $('.zoomContainer').remove();
        $('.zoomWindowContainer').remove();
    });


    // for elevatezoom and dom jquery
    $(document).on('click', '.carousel-item.active', function () {
        $("#zoom_01").elevateZoom({
            zoomType: "lens",
            lensShape: "round",
            lensSize: 400,
            // containLensZoom: true,
            // scrollZoom: true,
        });
    });


    function clickOnPageNumber() {
        swal({
            text: "لطفا بر روی فیلد شماره صفحه کلیک نمایید",
            icon: "warning",
            timer: 3000,
            button: false,
        })
    }

    function OperationComplete() {
        swal({
            text: "عملیات کد گذاری با موفقیت به پایان رسید",
            button: false,
        })
    }


    function deleteFileSucces() {
        swal({
            text: "تصویر مورد نظر با موفقیت حذف شد",
            button: false,
        })
    }


    function deleteNoFile() {
        swal({
            text: "تصویر مورد نظر یافت نشد ",
            button: false,
        })
    }


    function noCodeSpecial() {
        swal({
            text: "کد ساماب یافت نشد ",
            button: false,
        })
    }

    function moreThanUpload() {
        swal({
            text: "شما بیش از حد مجاز پرونده فایل ثبت کرده اید ",
            button: false,
        })
    }

    function notEqulSumUpload() {
        swal({
            text: "تعداد آپلود شما با تعداد فایل ثبتی پرونده برابر نیست لطفا مجددا تصاویر را بارگذاری نمایید",
            button: false,
        })
    }


    function alertContinueDocument() {
        swal({
            text: "جهت ادامه کار باید پرونده " + accessUpload_folder_name + " را تکمیل نمایید. ",
            button: false,
        })
    }

    // function folderExists() {
    //     swal({
    //         text: "این پرونده قبلا توسط کاربر " + NameCheckFolder + " کد گذاری شده است. ",
    //         button: false,
    //     })
    // }


</script>
</body>
</html>
