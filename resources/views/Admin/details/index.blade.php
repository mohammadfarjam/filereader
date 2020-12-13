@extends('Admin.layout.index')

@section('content')
    <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title"> جزئیات آپلود کاربران</h3>
            <div class="form-group" style="float: left">
                <input id="total" style="width: 80px" name="total">
                <label>: جمع کل </label>
            </div>
            <div class="box-body">

        </div>
        <!-- /.box-header -->

            @if(Session::has('publish_comment'))
                <div class="alert alert-success">
                    <div>{{Session('publish_comment')}}</div>
                </div>
            @endif

            @if(Session::has('delete_comment'))
                <div class="alert alert-danger">
                    <div>{{Session('delete_comment')}}</div>
                </div>
            @endif

            <div class="table-responsive">
                <table class="table no-margin">
                    <thead>
                    <tr style="background: #5fff93">
                        <th class="text-center">ردیف</th>
                        <th class="text-center">نام کاربر</th>
                        <th class="text-center">تعداد کل آپلود</th>
                    </tr>
                    </thead>
                    <tbody>

@foreach($info as $inf)
                        <tr>
                            <td class="text-center">{{$loop->index+1}}</td>
                            <td class="text-center">{{$inf->name}}</td>
                            <td class="text-center">{{$inf->upload}}
                                <input name="sum" class="sum" type="hidden" value="{{$inf->upload}}">
                            </td>
                        </tr>

@endforeach

                    </tbody>
                </table>


                <style>
                    .pagination .page-item.active .page-link {
                        background: #5fff93 !important;
                        color: black;
                        border: 1px solid #cccccc;
                    }
                </style>

                <span class="w-100" style=" display: flex;">
                    <div class="" style="margin-left: 0;margin-right: 0;margin: auto">
                    {{ $info->links() }}
                </div>
</span>

            </div>
            <!-- /.table-responsive -->
        </div>
        <!-- /.box-body -->

    </div>

    <script>
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
