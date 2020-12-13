<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Detail_folder;
use Illuminate\Support\Facades\Storage;

class fileMove extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fileMove:move';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $all_folders=Detail_folder::whereColumn('count','=','total_count')->get();
        foreach ($all_folders as $all_folder){
                $code_water=$all_folder->code_water;
                $folder_name=$all_folder->folder_name;
            if(Storage::exists('public/finalImage/'.$code_water.'/'.$folder_name)){
                Storage::move('public/finalImage/'.$code_water.'/'.$folder_name,'public/Delivery/'.$code_water.'/'.$folder_name);
            }


        }
    }
}
