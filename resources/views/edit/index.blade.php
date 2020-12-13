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
    <link href="{{asset('css/dropzone.min.css')}}" rel="stylesheet">
    {{--    <link rel='stylesheet' href="{{asset('css/sweetalert.min.css')}}">--}}

    <script src="{{asset('js/jquery-3.5.1.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('js/tiff.js')}}" type="text/javascript"></script>
    <script src="{{asset('js/UTIF.js')}}" type="text/javascript"></script>
    <script src="{{asset('js/bootstrap.min.js')}}" type="text/javascript"></script>
    <script type="text/javascript" src="{{asset('js/dropzone.min.js')}}"></script>
<!-- <script href="{{asset('js/popper.min.js')}}" type="text/javascript"></script> -->
    <script src="{{asset('js/sweetalert.min.js')}}"></script>
    <script src="{{asset('js/jquery.elevateZoom-3.0.8.min.js')}}" type="text/javascript"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body style="direction: rtl;text-align: right;padding-right:0px;" class="font body p-0">

<div class="alert alert-danger col-4 mt-2 mx-auto exists_file" style="display: none">
    <div><p>این فایل در پرونده قبلا ثبت شده است.</p></div>
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
            <div class="form-group col-lg-12" id="folder_coding">
                <label for="name_folder"><p style="margin:0;padding:0;"> نام پرونده : (به جای '/' از '.' استفاده شود)
                    </p></label>
                <input class="form-control " style="direction: ltr;text-align: right" type="text"
                       placeholder="نام پرونده"
                       name="code_clase_edit" id="code_clase" value="">
            </div><!--form-group-->

    <div class="form-group col-lg-12">
        <label for="code_water"> منبع آب :</label>
        <select class="form-control code_water" id="code_water_edit" name="code_water">
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
   <div class="col-lg-12">
       <button id="edit" class="btn btn-outline-primary savee" style="height: 50px!important;">انجام</button>

   </div>

    <span class="col-lg-11 d-block w-100 mx-auto mt-4 mb-3" style="border: 1px solid #ccc;height:2px"></span>
    <div class="form-group col-lg-12" id="folder_coding">
        <label for="name_folder"><p style="margin:0;padding:0;"> نام پرونده : (به جای '/' از '.' استفاده شود)
            </p></label>
        <input class="form-control " style="direction: ltr;text-align: right" type="text"
               placeholder="نام پرونده"
               name="code_clase" id="code_clase" value="">
    </div><!--form-group-->


    <div class="form-group col-lg-12 mt-3">
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
                    <option value="04">کمسیون ها</option>
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
                <input class="form-control page_number read_only" id="" type="text" name="page_number"
                       value="1">{{ old('page_number') }}
                <p class="click_for_sum_page" style='color:red;font-size:9.9pt'>لطفا پس از هر تغیر روی فیلد شماره صفحه
                    کلیک نمایید.</p>
            </div><!--form-group-->

            <div class="form-group col-lg-12">
                <label for="page_counter"> برگ شمار :</label>
                <input class="form-control page_counter read_only" type="text" name="page_counter" value=""
                       placeholder="برگ شمار " maxlength="4">{{ old('page_counter') }}
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
                <input class="form-control" type="hidden" id="edit_image" name="edit_image" value="" placeholder="ادرس تصویر کامل تصویر برای ویرایش">
                <input class="form-control" type="hidden" id="ext" name="ext" value="" placeholder="پسوند تصویر">
            </div><!--form-group-->
            <button data-toggle="modal" data-target="#exampleModalCenter" type="button" id="modal" class="d-none">
            </button>

            <div class="col-lg-12">
                <button id="edit" class="btn mt-1 savee" style="background:#ffb90f;color: black"
                        onclick="editSave()">ویرایش اطلاعات
                </button>
            </div>
            <div>
            </div>
        </div><!--col-lg-3-->


        <div class="col-lg-9 click_for_up_down_image">

            <div id="carouselExampleIndicators" class="carousel mt-2 mb-2 slide " data-ride="carousel">
                <div class="carousel-inner sc" style="height:100vh;">
                </div>




                <div class="arrow_overview" style="display: none">
                    <a class="carousel-control-prev" onclick="overViewPrev()" href="#carouselExampleIndicators" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" onclick="overViewNext()" href="#carouselExampleIndicators" role="button"
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


<script>
     window.access_submit = false;
    $('#edit').click(function () {
        let edit_code_clase = $('input[name=code_clase_edit]').val();
        let edit_code_water = $('#code_water_edit :selected').val();
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'POST',
            url: '{{route('info.edit')}}',
            dataType: 'json',
            data: {edit_code_clase, edit_code_water},
            success: function (infoEdit) {
                $('.carousel-inner').html(' ');
                $('.alert-danger').css('display', 'none');
                $('.arrow_overview').css('display', 'block');
                $('.carousel-control-prev').css('display', 'block');
                $('.carousel-control-next').css('display', 'block');
                $('input[name=code_clase]').val(infoEdit.folder_name);

                $.each(infoEdit.read_edit, function (index, value) {
                    $('.carousel-inner .carousel-item').removeClass('active');
                    let storage_full_name = value.replace(/^.*\//, "");
                    let del1 = storage_full_name.split('@').slice(0, -1).join('@');
                    let del2 = del1.split('@').slice(0, -1).join('@');
                    let save_for_sort = del2.substr(18);

                    var c = '<div class="carousel-item"><img id="" class="d-block img w-100"' + ' src="storage/edit/{{Auth::user()->id}}/' + storage_full_name + '" alt="" data_img="' + save_for_sort + '" data_info="'+storage_full_name+'"></div>';

                    $(c).appendTo('.carousel-inner');
                    $(".carousel-item").sort().appendTo('.carousel-inner');

                    // function sort_img(a, b) {
                    //     return parseInt($(a).attr('data_img') < $(b).attr('data_img') ? 1 : -1);
                    // }

                    $('.carousel-inner .carousel-item:last-child').addClass('active');

                    let insert_src_image = $('.carousel-inner .carousel-item.active img').attr('data_info');
                    let img_src=insert_src_image.split('.').slice(0, -1).join('.');
                    var ext = img_src.split('.').pop();
                    $('input[name=ext]').val(ext);
                    $('input[name=edit_image]').val(img_src);



                    let data_info=$('.carousel-inner .carousel-item.active img').attr('data_info');
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
                    // $('input[name="page_number"]').removeAttr('id', 'page_number');
                });

            }
        });
    });




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

    $(document).on('click', '#page_number', function () {
        let code_water = $('#code_water :selected').val();
        let code_clase = $('input[name=code_clase]').val();
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'POST',
            url: '{{route('read.storage')}}',
            dataType: 'json',
            data: {code_water: code_water, code_clase: code_clase},
            success: function (ReadStorage) {
                window.arr = [];
                window.arr2 = [];
                window.arr3 = [];
                window.arr4 = [];
                access_submit = true;

                $.each(ReadStorage, function (index, value) {
                    let storage_full_name = value.replace(/^.*\//, "");
                    let del1 = storage_full_name.split('@').slice(0, -1).join('@');
                    let del2 = del1.split('@').slice(0, -1).join('@');
                    let del3 = del2.substr(8);
                    let result = del3.substring(7, -7);
                    window.for_no_sum=del3.substring(10, -4);
                    console.log(del3);


                    let for_row_evidence = del3.substring(4, -10);
                    let del4 = del3.substr(4);
                    let del5 = del3.substr(9).substring(1, -4);
                    arr.push(result);
                    arr2.push(del5);
                    arr3.push(for_row_evidence);
                    arr4.push(for_no_sum);
                });

                let code_evidence = $('#code_evidence :selected').val();
                let evidence_type = $('#evidence_type :selected').val();
                let row_evidence = $('input[name=row_evidence]').val();
                let page_number = $('input[name=page_number]').val();
                let page_counter = $('input[name=page_counter]').val();
                if (row_evidence.length == 1) {
                    let twoZero = '00';
                    row_evidence = twoZero.concat(row_evidence);
                }
                if (row_evidence.length == 2) {
                    let oneZero = '0';
                    row_evidence = oneZero.concat(row_evidence);
                }

                if (page_number.length == 1) {
                    let twoZero = '00';
                    page_number = twoZero.concat(page_number);
                }
                if (page_number.length == 2) {
                    let oneZero = '0';
                    page_number = oneZero.concat(page_number);
                }

                let all_parameter = code_evidence.concat(evidence_type).concat(row_evidence).concat(page_number);
                // if($.inArray(all_parameter, arr4) !== -1){
                    // $('input[name=page_number]').val(page_number);
                    // $('input[name=row_evidence]').val(row_evidence);
                // }else {
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
                // }




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

    //for reset code water by check has folder
    // $('#code_clase').keyup(function () {
    //     $("#code_water").val('').change();
    // });



    //replace bad characters for date_evidence
    $('#date_evidence').keyup(function () {
        let get_val_date_evidence = $(this).val();
        get_val_date_evidence = get_val_date_evidence.replace(/[^\w\s]/gi, '');
        $('#date_evidence').val(get_val_date_evidence);
    });


    //for change code evidence to empty field
    $(document).on('change', '#code_evidence', function () {
         access_submit = false;
        $('input[name=date_evidence]').val('');
        $('input[name=Number_evidence]').val('');
        $('input[name=row_evidence]').val(1);
        $('input[name=page_number]').val(1);

    });

// click for add id page_number
    $(document).on('click', '#code_evidence', function () {
        $('input[name="page_number"]').attr('id', 'page_number');
    });

    // click for add id page_number
    $(document).on('click', '#evidence_type', function () {
        $('input[name="page_number"]').attr('id', 'page_number');
    });


    //for change row evidence to empty field
    $(document).on('change', '#evidence_type', function () {
        access_submit = false;
        $('input[name=date_evidence]').val('');
        $('input[name=Number_evidence]').val('');
        $('input[name=row_evidence]').val(1);
        $('input[name=page_number]').val(1);
    });




     // $(document).on('click', '.evidence_type', function () {
     //    access_submit=false;
     // });


    //for send info form to controller
    function editSave() {
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
            let edit_image = $('input[name=edit_image]').val();
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },

                type: 'POST',
                url: '{{route('edit.save')}}',
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
                    edit_image,
                },
                success: function (return_data_image) {
                    if (return_data_image === 'success') {
                        sweetalert_edit();
                        $('.carousel-item.active').addClass('del');
                        $('.alert-danger').css('display', 'none');
                        $(".carousel-control-prev").click();
                    }
                    if (return_data_image === 'exists_file') {
                        $('.exists_file').css('display', 'block');
                        $("html, body").animate({scrollTop: 0}, "slow");
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

        }
        else if (access_submit == false) {
            clickOnPageNumber();
        }
    }



    //for press enter key to submit form
    $(document).keyup(function(e) {
        if (e.keyCode === 13){
            sub();
        }
        if (e.keyCode === 37){
            overViewPrev();
        }
        if (e.keyCode === 39){
            overViewNext();
        }
    });





    //for overViewPrev
    function overViewPrev() {
        setTimeout(function () {
            let data_info = $('.carousel-inner .carousel-item.active img').attr('data_info');
            let insert_src_image = $('.carousel-inner .carousel-item.active img').attr('data_info');
            let img_src=insert_src_image.split('.').slice(0, -1).join('.');
            var ext = img_src.split('.').pop();
            $('input[name=ext]').val(ext);
            $('input[name=edit_image]').val(img_src);



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
            // $('input[name="page_number"]').removeAttr('id', 'page_number');
        }, 700);

    }


    //for overViewNext
    function overViewNext() {
        setTimeout(function () {
            // $('input[name="page_number"]').removeAttr('id', 'page_number');
            let data_info = $('.carousel-inner .carousel-item.active img').attr('data_info');
            let insert_src_image = $('.carousel-inner .carousel-item.active img').attr('data_info');
            let img_src=insert_src_image.split('.').slice(0, -1).join('.');
            var ext = img_src.split('.').pop();
            $('input[name=ext]').val(ext);
            $('input[name=edit_image]').val(img_src);

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
            // $('input[name="page_number"]').removeAttr('id', 'page_number');

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

    function sweetalert_edit() {
        swal({
            animation: true,
            icon: 'warning',
            toast: true,
            allowEscapeKey: true,
            background: '#ffb90f',
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            title: 'تصویر ویرایش شد',
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


    function folderExists() {
        swal({
            text: "این پرونده قبلا توسط کاربر "  + NameCheckFolder +  " کد گذاری شده است. ",
            button: false,
        })
    }


</script>
</body>
</html>
