<?php

namespace App\Http\Controllers\Frontend;

use App\Detail_photo;
use App\Detail_folder;
use App\Excel;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;


class HomeController extends Controller
{
    public function index()
    {
        return view('Home.index');
    }

    public function accessUpload(Request $request)
    {
        $user_id = $request->user_id;
        $get_infos = Detail_folder::where('user_id', $user_id)->get();
        foreach ($get_infos as $get_info) {
            if ($get_info->count == $get_info->total_count) {
//                return response()->json('ok');
            } else {
                $folder_name = $get_info->folder_name;
                $code_water = $get_info->code_water;
                return response()->json(['folder_name' => $folder_name,
//                    'code_water' => $code_water,
                ]);

            }
        }
    }


    public function getCodeSamab(Request $request)
    {
        $code_clase_samab = $request['code_clase_modal_samab'];
        $folder_operation_modal_samab = $request['folder_operation_modal_samab'];
        $state = $request['state'];
        $Samab = Excel::where('code_clase', 'like', "%" . $code_clase_samab . "%")->where('code_clase', 'like', "%" . $folder_operation_modal_samab . "%")->where('code_clase', 'like', "%" . $state . "%")->pluck('samab')->first();
        if ($Samab) {
            return response()->json($Samab);
        } else {
            return response()->json('no');
        }
    }


    public function readstorage(Request $request)
    {
        $code_water = $request['code_water'];
        $code_clase = $request['code_clase'];
        $state1 = $request['state1'];
        return Storage::allFiles('public/finalImage/' . $code_water . '/' . $code_clase . '.' . $state1);
    }


    public function continueDocument(Request $request)
    {
        $code_water_continue = $request['code_water_continue'];
        $code_clase_continue = $request['code_clase_continue'];
        $state_continue = $request['state_continue'];
        return Storage::allFiles('public/finalImage/' . $code_water_continue . '/' . $code_clase_continue . '.' . $state_continue);
    }


    public function deleteFileByUser(Request $request)
    {
        $delete_value = $request['val_delete'];
        $code_clase_modal = $request['code_clase_modal'];
        $code_water_modal = $request['code_water_modal'];
        $delete_state_modal = $request['delete_state_modal'];
        $reads = Storage::allFiles('public/finalImage/' . $code_water_modal . '/' . $code_clase_modal . '.' . $delete_state_modal);
        $counter = 0;
        foreach ($reads as $read) {
            $pieces = explode('/', $read);
            $filename = implode('/', array_slice($pieces, -1, 1));
            $variable = substr($filename, 0, strpos($filename, "@"));
            $page_number = substr($variable, -4);
            if ($page_number == $delete_value) {
                $deleted_madrak = $filename;
                $madrak = substr($filename, 0, 15);
                $minusRowevidence = substr($filename, 0, 12);
                Storage::delete('public/finalImage/' . $code_water_modal . '/' . $code_clase_modal . '.' . $delete_state_modal . '/' . $filename);

                $counter++;
                $deleted_row_evidence = substr($variable, 12, -7);

                Detail_photo::where('photo', $deleted_madrak)->delete();

            }
        }


        $create_new_folder = Detail_folder::where('user_id', Auth::user()->id)->where('folder_name', $code_clase_modal . '.' . $delete_state_modal)->where('code_water', $code_water_modal)->first();
        if (isset($create_new_folder)) {
            $create_new_folder->count;
            if ($create_new_folder->count > 0) {
                $create_new_folder->count = $create_new_folder->count - $counter;
                $create_new_folder->save();
            }
        }


        $user_upload = User::findorfail(Auth::user()->id);
        if (isset($user_upload)) {
            $user_upload->upload;
            if ($user_upload->upload >= 0) {
                $user_upload->upload = $user_upload->upload - $counter;
                $user_upload->save();
            }
        }


        $madrakArray = array();
        if (isset($madrak)) {
            $readss = Storage::allFiles('public/finalImage/' . $code_water_modal . '/' . $code_clase_modal . '.' . $delete_state_modal);
            foreach ($readss as $read) {
                $pieces = explode('/', $read);
                $filename = implode('/', array_slice($pieces, -1, 1));
                $variable = substr($filename, 0, strpos($filename, "@"));
                $page_number = substr($variable, 0, 15);
                if ($page_number == $madrak) {
                    $madrakArray[] = $filename;
                }
            }
        }

        $newNameArray = array();
        foreach ($madrakArray as $madrak_element) {
            if (substr($madrak_element, 0, 18) > substr($deleted_madrak, 0, 18)) {
                $new_name = (intval(substr($madrak_element, 0, 18)) - $counter) . substr($madrak_element, 18);
                $newNameArray[] = $new_name;

                Storage::move('public/finalImage/' . $code_water_modal . '/' . $code_clase_modal . '.' . $delete_state_modal . '/' . $madrak_element, 'public/finalImage/' . $code_water_modal . '/' . $code_clase_modal . '.' . $delete_state_modal . '/' . $new_name);

                Detail_photo::where('user_id', Auth::user()->id)->where('folder_name', $code_clase_modal . '.' . $delete_state_modal)->where('photo', $madrak_element)->update(['photo' => $new_name]);

            }

        }


        $madrakArray2 = array();
        if (isset($minusRowevidence)) {
            $reads = Storage::allFiles('public/finalImage/' . $code_water_modal . '/' . $code_clase_modal . '.' . $delete_state_modal);
            foreach ($reads as $read) {
                $pieces = explode('/', $read);
                $filename = implode('/', array_slice($pieces, -1, 1));
                $variable = substr($filename, 0, strpos($filename, "@"));
                $page_number = substr($variable, 0, 12);
                if ($page_number == $minusRowevidence) {
                    $madrakArray2[] = $filename;
                }
            }
        }


        foreach ($madrakArray2 as $madrakArr2) {
            $variable = substr($madrakArr2, 0, strpos($filename, "@"));
            $page_number = substr($variable, 0, 15);
            if ($page_number == $minusRowevidence) {
                $madrakArray2[] = $filename;
            }
        }


        $newNameArray2 = array();
        foreach ($madrakArray2 as $madrak_element2) {
//            $val1 = substr($madrak_element2, 0, 15);
//            $after_val1 = substr($madrak_element2, 0, 12);
            $val2 = substr($deleted_madrak, 0, 15);
//            $after_delete = substr($deleted_madrak, 0, 12);
//
//            if ($val2 == $val1){
//
//            }else{

                return $val2;
//                if (substr($madrak_element2, 0, 15) > substr($deleted_madrak, 0, 15)) {
//                    $new_name2 = (intval(substr($madrak_element2, 0, 15)) - 1) . substr($madrak_element2, 15);
//                    $newNameArray2[] = $new_name2;
//
//                    Storage::move('public/finalImage/' . $code_water_modal . '/' . $code_clase_modal . '.' . $delete_state_modal . '/' . $madrak_element2, 'public/finalImage/' . $code_water_modal . '/' . $code_clase_modal . '.' . $delete_state_modal . '/' . $new_name2);
//                }
//            }




//                    Detail_photo::where('user_id', Auth::user()->id)->where('folder_name', $code_clase_modal . '.' . $delete_state_modal)->where('photo', $madrak_element2)->update(['photo' => $new_name2]);
        }


        return response()->json(['deleted_row_evidence' => $deleted_row_evidence,
            'counter_delete' => $counter
        ]);
    }


    public function checkFolder(Request $request)
    {
        $user_id = Auth::user()->id;
        $find_folder = Detail_folder::where('code_water', $request['code_water'])->where('folder_name', $request['code_clase'] . '.' . $request['state1'])->first();
        if (isset($find_folder)) {
            $user = User::findorfail($find_folder->user_id);
            return response()->json($user->name);
        }
    }


    public function deleteUploadPhotos()
    {
        $user_id = Auth::user()->id;
        $files_photos = Storage::allFiles('public/photos/' . $user_id);

        // Delete Files
        return Storage::delete($files_photos);
    }

    public function sum_total_count(Request $request)
    {
        $rename_img = $request['rename_img'];
        $total_img = $request['total_img'];
        $code_water = $request['code_water'];
        $folder_name = $request['code_clase'];
        $state1 = $request['state1'];

        $value_total_count = Detail_folder::where('user_id', Auth::user()->id)->where('code_water', $code_water)->where('folder_name', $folder_name . '.' . $state1)->pluck('total_count')->first();
        if (isset($value_total_count)) {
            $sum = $rename_img + $total_img;
            if ($sum > $value_total_count) {
                return response()->json('sum is biger', 200);
            } else if ($sum < $value_total_count) {
                return response()->json('sum is biger', 200);
            }
        }
    }


    public function store(Request $request)
    {
//        return $request;
        $validator = Validator::make($request->all(), [
            'code_special' => 'required|digits:6|integer',
            'code_water' => 'required',
            'code_evidence' => 'required',
            'evidence_type' => 'required',
            'row_evidence' => 'required|numeric',
            'page_number' => 'required|numeric',
            'page_counter' => 'required|numeric',
//            'Number_evidence' => 'required',
            'image' => 'required',
            'state1' => 'required',
//            'date_evidence' => 'digits:8',
            'code_clase' => 'required',
        ], [
            'code_special.required' => 'کد منحصر به فرد (ساماب) را وارد نمایید.',
            'code_special.integer' => 'عدد صفر را از ابتدای فیلد کد منحصر به فرد حذف کنید.',
            'code_special.digits' => ' مقدار ورودی برای فیلد کد منحصر به فرد عدد 6 رقمی می باشد.',
            'code_water.required' => 'فیلد منبع آب را انتخاب نمایید.',
            'code_evidence.required' => 'فیلد گروه مدرک را انتخاب نمایید.',
            'evidence_type.required' => 'فیلد نوع مدرک را انتخاب نمایید.',
            'row_evidence.required' => 'فیلد ردیف مدرک خالی است.',
            'row_evidence.numeric' => ' مقدار ورودی ردیف مدرک فقط عدد می باشد.',
            'page_number.required' => 'فیلد شماره صفحه خالی است.',
            'page_number.numeric' => ' مقدار ورودی شماره صفحه فقط عدد می باشد.',
            'page_counter.required' => 'فیلد برگ شمار خالی است.',
            'page_counter.numeric' => ' مقدار ورودی برگ شمار فقط عدد می باشد.',
//            'Number_evidence.required' => 'فیلد شماره مدرک خالی است.',
            'image.required' => 'عکس را انتخاب نمایید.',
//            'date_evidence.required' => 'فیلد تاریخ مدرک خالی است.',
//            'date_evidence.digits' => ' مقدار ورودی برای فیلد تاریخ مدرک صحیح نمی باشد.',
//            'date_evidence.integer' => 'عدد صفر را از ابتدای فیلد تاریخ مدرک حذف کنید.',
            'code_clase.required' => 'فیلد نام پوشه در حال عملیات خالی است.',
            'state1.required' => 'لطفا منطقه مورد نظر را انتخاب نمایید.'
        ]);
        if ($validator->fails()) {
            return response($validator->errors(), 401);
        } else {
            $oneZero = '0';
            $twoZero = '00';
            $threeZero = '000';

            $code_special = $request['code_special'];
            $total_count = $request['total_count'];
            $code_water = $request['code_water'];
            $code_evidence = $request['code_evidence'];
            $evidence_type = $request['evidence_type'];

            $row_evidence = $request['row_evidence'];
            $count_row_evidence = strlen($row_evidence);
            if ($count_row_evidence == 1) {
                $len_row_evidence = $twoZero . '' . $row_evidence;
            }
            if ($count_row_evidence == 2) {
                $len_row_evidence = $oneZero . '' . $row_evidence;
            }
            if ($count_row_evidence == 3) {
                $len_row_evidence = $row_evidence;
            }

            $page_number = $request['page_number'];
            $count_page_number = strlen($page_number);
            if ($count_page_number == 1) {
                $len_page_number = $twoZero . '' . $page_number;
            }
            if ($count_page_number == 2) {
                $len_page_number = $oneZero . '' . $page_number;
            }
            if ($count_page_number == 3) {
                $len_page_number = $page_number;
            }

            $page_counter = $request['page_counter'];
            $Number_evidence = $request['Number_evidence'];
            $name_image = $request['image'];
            $ext = $request['ext'];
            $date_evidence = $request['date_evidence'];
            $code_clase = $request['code_clase'];
            $state1 = $request['state1'];


            $name = $code_special . '' . $code_water . '' . $code_evidence . '' . $evidence_type . '' . $len_row_evidence . '' . $len_page_number . '' . $page_counter . '' . '@' . $Number_evidence . '@' . $date_evidence . '.' . '' . $ext;


            $existsFile = Detail_photo::where('user_id', Auth::user()->id)->where('photo', $name)->where('folder_name', $code_clase . '.' . $state1)->first();

            if (isset($existsFile)) {
                return response()->json('exists_file');
//                Detail_photo::where('user_id', Auth::user()->id)->where('folder_name', $code_clase)->where('photo', $name)->update(['photo' => $name]);
//                return response()->json('success', 200);
            } else {
                $create_new_folder = Detail_folder::where('user_id', Auth::user()->id)->where('code_water', $code_water)->where('folder_name', $code_clase . '.' . $state1)->first();


                if (!isset($create_new_folder)) {
                    $user_id = Auth::user()->id;
                    Storage::move('public/photos/' . $user_id . '/' . $name_image . '.' . $ext, 'public/finalImage/' . $code_water . '/' . $code_clase . '.' . $state1 . '/' . $name);

                    Storage::delete('public/photos/' . $user_id . '/' . $name_image . '.' . $ext . '.jpg');

                    $id = Auth::user()->id;
                    $find_user = User::findorfail($id);
                    $count_upload = User::where('id', $id)->get();
                    foreach ($count_upload as $upload) {
                        $x = $upload->upload + 1;
                        $find_user->upload = $x;
                        $find_user->save();
                    }

                    $date = Carbon::now()->format('Y-n-j');
                    $new_detail_photo = new Detail_photo();
                    $new_detail_photo->user_id = Auth::user()->id;
                    $new_detail_photo->photo = $name;
                    $new_detail_photo->folder_name = $code_clase . '.' . $state1;
                    $new_detail_photo->date = $date;
//                    $new_detail_photo->save();


                    $date = Carbon::now()->format('Y-n-j');
                    $new_detail_folder = new Detail_folder();
                    $new_detail_folder->user_id = Auth::user()->id;
                    $new_detail_folder->folder_name = $code_clase . '.' . $state1;
                    $new_detail_folder->code_water = $code_water;
                    $new_detail_folder->count = 1;
                    $new_detail_folder->total_count = $total_count;
                    $new_detail_folder->date = $date;
//                    $new_detail_folder->save();


                    return response()->json('success', 200);

                } else {
                    if ($create_new_folder->count < $create_new_folder->total_count) {
                        $user_id = Auth::user()->id;
                        Storage::move('public/photos/' . $user_id . '/' . $name_image . '.' . $ext, 'public/finalImage/' . $code_water . '/' . $code_clase . '.' . $state1 . '/' . $name);
                        Storage::delete('public/photos/' . $user_id . '/' . $name_image . '.' . $ext . '.jpg');
                        $create_new_folder->count = intval(($create_new_folder->count) + 1);
                        $create_new_folder->save();

                        $id = Auth::user()->id;
                        $find_user = User::findorfail($id);
                        $count_upload = User::where('id', $id)->get();
                        foreach ($count_upload as $upload) {
                            $x = $upload->upload + 1;
                            $find_user->upload = $x;
                            $find_user->save();
                        }

                        $date = Carbon::now()->format('Y-n-j');
                        $new_detail_photo = new Detail_photo();
                        $new_detail_photo->user_id = Auth::user()->id;
                        $new_detail_photo->photo = $name;
                        $new_detail_photo->folder_name = $code_clase . '.' . $state1;
                        $new_detail_photo->date = $date;
                        $new_detail_photo->save();

                        return response()->json('success', 200);

                    } else {
                        return response()->json('not_match');
                    }
                }

            }
        }


    }


    public function reset()
    {
        return view('passReset.index');
    }

    public function resetPass(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email|max:255',
//            'old_password' => 'required|min:8',
            'password' => 'required|string|min:8|confirmed',

        ], [
            'email.required' => 'ایمیل خود را وارد نمایید.',
            'email.email' => 'فرمت ایمیل وارد شده صحیح نمی باشد.',
            'email.max' => 'تعداد کاراکتر ایمیل بیش از حد مجاز است.',
            'email.string' => 'ایمیل خود را صحیح وارد نمایید.',
//            'old_password.required' => 'رمز عبور قدیم خود را وارد نمایید.',
//            'old_password.min' => 'رمز عبور قدیم باید بیش از 8 کاراکتر باشد.',
            'password.required' => 'رمز عبور جدید خود را وارد نمایید.',
            'password.min' => 'رمز عبور جدید باید بیش از 8 کاراکتر باشد.',
            'password.confirmed' => 'رمز عبور همخوانی ندارد.',

        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        } else {
            $email = $request['email'];
//            $old_password = $request['old_password'];
            $user = User::where('email', $email)->first();
            $hash_pass = $user->password;

//            if (Hash::check($old_password, $hash_pass)) {
            if (isset($user)) {
                $find_user = User::findorfail($user->id);
                $find_user->password = Hash::make($request['password']);
                $find_user->save();
                Session::flash('success_change_pass', 'رمز عبور شما با موفقیت تغییر کرد.');
                return redirect('login');
            } else {
                Session::flash('not_found_user', 'کاربر یافت نشد.');
                return back();
            }
        }

    }


    public static function convertToNativePath($path)
    {
        $path = str_replace("\\", "/", $path);
        $path = str_replace("/", DIRECTORY_SEPARATOR, $path);

        return $path;
    }


    public function overView(Request $request)
    {
        Storage::deleteDirectory('public/review/' . Auth::user()->id);
        $code_clase_overView = $request['code_clase_overView'];
        $code_water_overView = $request['code_water_overView'];
        $user_id = Detail_folder::where('code_water', $code_water_overView)->where('folder_name', $code_clase_overView)->pluck('user_id')->first();
        $user_name = User::findorfail($user_id);
        $user_name_original = $user_name->name;

        $reads = Storage::allFiles('public/finalImage/' . $code_water_overView . '/' . $code_clase_overView);
        foreach ($reads as $read) {
            $pieces = explode('/', $read);
            $filename = implode('/', array_slice($pieces, -1, 1));
            $mainFile = HomeController::convertToNativePath(storage_path("app/" . $read));
            $jpgFile = $mainFile . ".jpg";
            $cmd = "C:\\xampp\\htdocs\\FileReader\\ImageMagick\\magick.exe " . $mainFile . " " . $jpgFile;
            exec($cmd);
            Storage::move('public/finalImage/' . $code_water_overView . '/' . $code_clase_overView . '/' . $filename . ".jpg", 'public/review/' . Auth::user()->id . '/' . $filename . ".jpg");
        }
        $read_overView = Storage::allFiles('public/review/' . Auth::user()->id);

        return response()->json(['read_overview' => $read_overView,
            'folder_name' => $code_clase_overView,
            'user_name' => $user_name_original,
        ]);
    }


    public function OneOverView(Request $request)
    {
        Storage::deleteDirectory('public/review/' . Auth::user()->id);
        $code_clase_one_overView = $request['code_clase_one_overView'];
        $code_water_one_overView = $request['code_water_one_overView'];
        $page_one_overView = $request['page_OneOverView'];

        $user_id = Detail_folder::where('code_water', $code_water_one_overView)->where('folder_name', $code_clase_one_overView)->pluck('user_id')->first();
        $user_name = User::findorfail($user_id);
        $user_name_original = $user_name->name;

        $reads = Storage::allFiles('public/finalImage/' . $code_water_one_overView . '/' . $code_clase_one_overView);

        $oneZero = '0';
        $twoZero = '00';
        $threeZero = '000';
        $count = strlen($page_one_overView);
        if ($count == 1) {
            $len_page_one_overView = $threeZero . '' . $page_one_overView;
        }
        if ($count == 2) {
            $len_page_one_overView = $twoZero . '' . $page_one_overView;
        }
        if ($count == 3) {
            $len_page_one_overView = $oneZero . '' . $page_one_overView;
        }
        if ($count == 4) {
            $len_page_one_overView = $page_one_overView;
        }

        foreach ($reads as $read) {
            $pieces = explode('/', $read);
            $filename = implode('/', array_slice($pieces, -1, 1));
            $variable = substr($filename, 0, strpos($filename, "@"));
            $page_number = substr($variable, -4);

            if ($page_number == $len_page_one_overView) {

                $mainFile = HomeController::convertToNativePath(storage_path("app/" . $read));
                $jpgFile = $mainFile . ".jpg";
                $cmd = "C:\\xampp\\htdocs\\FileReader\\ImageMagick\\magick.exe " . $mainFile . " " . $jpgFile;
                exec($cmd);
                Storage::move('public/finalImage/' . $code_water_one_overView . '/' . $code_clase_one_overView . '/' . $filename . ".jpg", 'public/review/' . Auth::user()->id . '/' . $filename . ".jpg");
            }


        }
        $read_overView = Storage::allFiles('public/review/' . Auth::user()->id);

        return response()->json(['read_overview' => $read_overView,
            'folder_name' => $code_clase_one_overView,
            'user_name' => $user_name_original,
        ]);

    }

//    public function edit()
//    {
//        return view('edit.index');
//    }
//
//    public function InfoEdit(Request $request)
//    {
//        Storage::deleteDirectory('public/edit/' . Auth::user()->id);
//
//        $reads = Storage::allFiles('public/finalImage/' . $request['edit_code_water'] . '/' . $request['edit_code_clase']);
//
//        foreach ($reads as $read) {
//            $pieces = explode('/', $read);
//            $filename = implode('/', array_slice($pieces, -1, 1));
//            $mainFile = HomeController::convertToNativePath(storage_path("app/" . $read));
//            $jpgFile = $mainFile . ".jpg";
//            $cmd = "C:\\xampp\\htdocs\\FileReader\\ImageMagick\\magick.exe " . $mainFile . " " . $jpgFile;
//            exec($cmd);
//
//            Storage::move('public/finalImage/' . $request['edit_code_water'] . '/' . $request['edit_code_clase'] . '/' . $filename . ".jpg", 'public/edit/' . Auth::user()->id . '/' . $filename . ".jpg");
//
//
//        }
//        $read_edit = Storage::allFiles('public/edit/' . Auth::user()->id);
//        return response()->json(['read_edit' => $read_edit,
//            'folder_name' => $request['edit_code_clase'],
//        ]);
//
//    }
//
//
//    public function edit_save(Request $request)
//    {
//        $validator = Validator::make($request->all(), [
//            'code_special' => 'required|digits:6|integer',
//            'code_water' => 'required',
//            'code_evidence' => 'required',
//            'evidence_type' => 'required',
//            'row_evidence' => 'required|numeric',
//            'page_number' => 'required|numeric',
//            'page_counter' => 'required|numeric',
////            'Number_evidence' => 'required',
////            'image' => 'required',
////            'date_evidence' => 'digits:8',
//            'code_clase' => 'required',
//        ], [
//            'code_special.required' => 'کد منحصر به فرد (ساماب) را وارد نمایید.',
//            'code_special.integer' => 'عدد صفر را از ابتدای فیلد کد منحصر به فرد حذف کنید.',
//            'code_special.digits' => ' مقدار ورودی برای فیلد کد منحصر به فرد عدد 6 رقمی می باشد.',
//            'code_water.required' => 'فیلد منبع آب را انتخاب نمایید.',
//            'code_evidence.required' => 'فیلد گروه مدرک را انتخاب نمایید.',
//            'evidence_type.required' => 'فیلد نوع مدرک را انتخاب نمایید.',
//            'row_evidence.required' => 'فیلد ردیف مدرک خالی است.',
//            'row_evidence.numeric' => ' مقدار ورودی ردیف مدرک فقط عدد می باشد.',
//            'page_number.required' => 'فیلد شماره صفحه خالی است.',
//            'page_number.numeric' => ' مقدار ورودی شماره صفحه فقط عدد می باشد.',
//            'page_counter.required' => 'فیلد برگ شمار خالی است.',
//            'page_counter.numeric' => ' مقدار ورودی برگ شمار فقط عدد می باشد.',
////            'Number_evidence.required' => 'فیلد شماره مدرک خالی است.',
////            'image.required' => 'عکس را انتخاب نمایید.',
////            'date_evidence.required' => 'فیلد تاریخ مدرک خالی است.',
////            'date_evidence.digits' => ' مقدار ورودی برای فیلد تاریخ مدرک صحیح نمی باشد.',
////            'date_evidence.integer' => 'عدد صفر را از ابتدای فیلد تاریخ مدرک حذف کنید.',
//            'code_clase.required' => 'فیلد نام پرونده در حال عملیات خالی است.',
//        ]);
//        if ($validator->fails()) {
//            return response($validator->errors(), 401);
//        } else {
//            $oneZero = '0';
//            $twoZero = '00';
//            $threeZero = '000';
//
//            $code_special = $request['code_special'];
//            $total_count = $request['total_count'];
//            $code_water = $request['code_water'];
//            $code_evidence = $request['code_evidence'];
//            $evidence_type = $request['evidence_type'];
//
//            $row_evidence = $request['row_evidence'];
//            $count_row_evidence = strlen($row_evidence);
//            if ($count_row_evidence == 1) {
//                $len_row_evidence = $twoZero . '' . $row_evidence;
//            }
//            if ($count_row_evidence == 2) {
//                $len_row_evidence = $oneZero . '' . $row_evidence;
//            }
//            if ($count_row_evidence == 3) {
//                $len_row_evidence = $row_evidence;
//            }
//
//            $page_number = $request['page_number'];
//            $count_page_number = strlen($page_number);
//            if ($count_page_number == 1) {
//                $len_page_number = $twoZero . '' . $page_number;
//            }
//            if ($count_page_number == 2) {
//                $len_page_number = $oneZero . '' . $page_number;
//            }
//            if ($count_page_number == 3) {
//                $len_page_number = $page_number;
//            }
//
//            $page_counter = $request['page_counter'];
//            $Number_evidence = $request['Number_evidence'];
//            $name_image = $request['image'];
//            $ext = $request['ext'];
//            $date_evidence = $request['date_evidence'];
//            $code_clase = $request['code_clase'];
//            $edit_image = $request['edit_image'];
//
//
//            $name = $code_special . '' . $code_water . '' . $code_evidence . '' . $evidence_type . '' . $len_row_evidence . '' . $len_page_number . '' . $page_counter . '' . '@' . $Number_evidence . '@' . $date_evidence . '.' . '' . $ext;
//
//            if (Storage::exists('public/finalImage/' . $code_water . '/' . $code_clase . '/' . $name)) {
//                return response()->json('exists_file');
//            } else {
//
//
//                Storage::move('public/finalImage/' . $code_water . '/' . $code_clase . '/' . $edit_image, 'public/finalImage/' . $code_water . '/' . $code_clase . '/' . $name);
////                Storage::delete('public/photos/' . $user_id . '/' . $name_image . '.' . $ext . '.jpg');
//            }
//
//
//            return response()->json('success', 200);
//        }
//    }


}
