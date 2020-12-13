@extends('Admin.layout.index')

@section('content')
    <link href="{{asset('css/persian-datepicker.css')}}" rel="stylesheet">

    <script src="{{asset('js/persian-date.js')}}" type="text/javascript"></script>
    <script src="{{asset('js/persian-datepicker.js')}}" type="text/javascript"></script>

    <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title"> گزارش آپلود روزانه کاربران</h3>
            <div class="form-group" style="float: left">
                <input id="total" style="width: 80px" name="total">
                <label>: جمع کل </label>
            </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">

            @if(Session::has('publish_comment'))
                <div class="alert alert-success">
                    <div>{{Session('publish_comment')}}</div>
                </div>
            @endif

            @if(Session::has('not_info'))
                <div class="alert alert-danger">
                    <div>{{Session('not_info')}}</div>
                </div>
            @endif


            <div class="table-responsive">
                <form action="{{route('report.daily')}}" method="get">
                    @csrf
                    <div class="form-group col-lg-3">
                        <label for="data_start">تاریخ شروع :</label>
                        <input class="form-control date1 " type="text" name="date_start" value="">
                    </div>

                    <div class="form-group col-lg-3">
                        <label for="data_end"> تاریخ پایان :</label>
                        <input class="form-control date1" type="text" name="date_end" value="">
                    </div>

                    <button class="btn btn-dropbox" type="submit" id="submit" style="margin-right: 50px;margin-top: 25px">
                        گزارش گیری
                    </button>
                </form>
            </div>




                <div class="box-body">


                    <div class="table-responsive">
                        <table class="table no-margin">
                            <thead>
                            <tr style="background: #5fff93">
                                <th class="text-center">ردیف</th>
                                <th class="text-center">نام کاربر</th>
                                <th class="text-center">نام پرونده</th>
                                <th class="text-center">تعداد آپلود</th>
                            </tr>
                            </thead>
                            <tbody class="compare_date">
                            <thead>
                            @if(isset($get_info_dates))
                                @foreach($get_info_dates as $get_info_date)
                                    <tr class="tr">
                                        <th class="text-center">{{$loop->index+1}}</th>
                                        <th class="text-center">{{$get_info_date->user->name}}</th>
                                        <th class="text-center ">{{$get_info_date->folder_name}} </th>
                                        <th class="text-center sum"> {{$get_info_date->count}}
                                            <input name="sum" class="sum" type="hidden" value="{{$get_info_date->count}} ">
                                        </th>
                                    </tr>
                                @endforeach
                            @endif
                            </thead>


                            </tbody>
                        </table>

                        <style>
                            .pagination .page-item.active .page-link {
                                background: #5fff93 !important;
                                color: black;
                                border: 1px solid #cccccc;
                            }
                        </style>
                        @if(isset($get_info_dates))
                        <span class="w-100" style=" display: flex;">
                    <div class="" style="margin-left: 0;margin-right: 0;margin: auto">

              {{$get_info_dates->appends(['date_start' => request()->input('date_start'),'date_end' => request()->input('date_end')])->links() }}
                    </div>
</span>
                        @endif
                    </div>

            <script>
                $(".date1").pDatepicker({
                    initialValue: true,
                    format: 'YYYY/MM/DD',
                    persianDigit: false,
                });


                let sums=[];
                let tr_length=$('.tr').length;
                $('.sum').map(function() {
                    let sum= $(this).val()
                    sums.push(sum);
                });
                var total = 0;
                for (var i = 0; i < sums.length; i++) {
                    total += sums[i] << 0;
                }
                $('input[name=total]').val(total);

            </script>
@endsection
