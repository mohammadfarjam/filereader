<?php

namespace App\Http\Controllers\Backend;

use App\Detail_photo;
use App\Detail_folder;
use App\CodeWater;
use App\Http\Controllers\Controller;
use App\User;
use Carbon\Carbon;
use Hekmatinasser\Verta\Facades\Verta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class MainController extends Controller
{
    public function index()
    {
        return view('Admin.layout.index');
    }

    public function detail()
    {

        $info = User::with('detail_photo')->orderBy('created_at', 'desc')->paginate(35);
        $date = Carbon::now()->format('Y-m-d');
        $how_much_upload = count(Detail_photo::where('date', $date)->get());
        return view('Admin.details.index', compact(['info', 'how_much_upload']));
    }

    public function report()
    {
        return view('Admin.report_upload.index');
    }

    public function report_upload_daily()
    {
        return view('Admin.report_upload_daily.index');
    }

    public function compare_date(Request $request)
    {

        $en_start_date = strtr($request['date_start'], array('۰' => '0', '۱' => '1', '۲' => '2', '۳' => '3', '۴' => '4', '۵' => '5', '۶' => '6', '۷' => '7', '۸' => '8', '۹' => '9', '٠' => '0', '١' => '1', '٢' => '2', '٣' => '3', '٤' => '4', '٥' => '5', '٦' => '6', '٧' => '7', '٨' => '8', '٩' => '9'));


        $en_end_date = strtr($request['date_end'], array('۰' => '0', '۱' => '1', '۲' => '2', '۳' => '3', '۴' => '4', '۵' => '5', '۶' => '6', '۷' => '7', '۸' => '8', '۹' => '9', '٠' => '0', '١' => '1', '٢' => '2', '٣' => '3', '٤' => '4', '٥' => '5', '٦' => '6', '٧' => '7', '٨' => '8', '٩' => '9'));

        $tarikh_start = explode('/', $en_start_date);
        $year = $tarikh_start[0];
        $month = $tarikh_start[1];
        $day = $tarikh_start[2];
        $start_dateGregorian = Verta::getGregorian($year, $month, $day);
        $start_date_string = implode('-', $start_dateGregorian);

        $tarikh_end = explode('/', $en_end_date);
        $year = $tarikh_end[0];
        $month = $tarikh_end[1];
        $day = $tarikh_end[2];
        $end_dateGregorian = Verta::getGregorian($year, $month, $day);
        $end_date_string = implode('-', $end_dateGregorian);


        $get_info_dates = Detail_folder::whereBetween('date',[$start_date_string,$end_date_string])->where('user_id', $request['user_name'])->paginate(65);

        return view('Admin.view_report.index', compact(['get_info_dates']));
    }


    public function report_daily(Request $request)
    {

        $en_start_date = strtr($request['date_start'], array('۰' => '0', '۱' => '1', '۲' => '2', '۳' => '3', '۴' => '4', '۵' => '5', '۶' => '6', '۷' => '7', '۸' => '8', '۹' => '9', '٠' => '0', '١' => '1', '٢' => '2', '٣' => '3', '٤' => '4', '٥' => '5', '٦' => '6', '٧' => '7', '٨' => '8', '٩' => '9'));


        $en_end_date = strtr($request['date_end'], array('۰' => '0', '۱' => '1', '۲' => '2', '۳' => '3', '۴' => '4', '۵' => '5', '۶' => '6', '۷' => '7', '۸' => '8', '۹' => '9', '٠' => '0', '١' => '1', '٢' => '2', '٣' => '3', '٤' => '4', '٥' => '5', '٦' => '6', '٧' => '7', '٨' => '8', '٩' => '9'));

        $tarikh_start = explode('/', $en_start_date);
        $year = $tarikh_start[0];
        $month = $tarikh_start[1];
        $day = $tarikh_start[2];
        $start_dateGregorian = Verta::getGregorian($year, $month, $day);
        $start_date_string = implode('-', $start_dateGregorian);

        $tarikh_end = explode('/', $en_end_date);
        $year = $tarikh_end[0];
        $month = $tarikh_end[1];
        $day = $tarikh_end[2];
        $end_dateGregorian = Verta::getGregorian($year, $month, $day);
        $end_date_string = implode('-', $end_dateGregorian);


        $get_info_dates = Detail_folder::whereBetween('date', [$start_date_string, $end_date_string])->paginate(50);

        return view('Admin.report_upload_daily.index', compact(['get_info_dates']));
    }









    public function count_upload_user(Request $request)
    {
        return response()->json($request['user_id'], 200);
    }

}
