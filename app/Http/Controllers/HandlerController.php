<?php

namespace App\Http\Controllers;

use App\Handlers\ImageUploadHandler;
use Illuminate\Http\Request;

class HandlerController extends Controller
{
    public function upload($action,ImageUploadHandler $imageUploadHandler)
    {
        switch ($action){
            case 'avatar':

                $save_path = 'upload/images/avatars/'; //图片保存地址 /storage
                $save_name = 'avatar_';         //图片名称

                dd(request()->avatar);

                if(request()->avatar) {
                    $avatar_res = $imageUploadHandler->save(request()->avatar,$save_path,$save_name,150);

                }

                break;
            case 'other':
                break;
        }
    }
}
