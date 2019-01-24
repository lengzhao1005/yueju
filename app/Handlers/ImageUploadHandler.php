<?php
/**
 * Created by PhpStorm.
 * User: zhao
 * Date: 2018/3/22
 * Time: 11:30
 */

namespace App\Handlers;

use Image;

class ImageUploadHandler
{
    /*
     * @param resource $file
     * @param string $save_path
     * @param string $save_name
     * @param int $img_width
     * @return bool
     */
    public function save($file,$save_path,$save_name,$max_width='')
    {
        //文件保存路径
        $upload_path = storage_path('app/public/'.$save_path);

        //保存文件后缀名
        $extension = strtolower($file->getClientOriginalExtension());

        //保存文件名称
        $file_name = $save_name.'.'.$extension;

        //保存文件
        $res = $file->move($upload_path,$file_name);

        if($max_width && $extension!='gif'){
            $this->reduseSize($upload_path.$file_name,$max_width);
        }

        return [
            'path' => 'storage/'.$save_path.$file_name
        ];
    }

    public function reduseSize($file_path,$max_width)
    {
        /*
         *
         * http://image.intervention.io/api/resize
         */
        // open an image file
        $img = Image::make($file_path);

        $img->resize($max_width,null,function($constraint){
            // 将图像调整为$max_width的宽度和约束宽高比（自动高度）
            $constraint->aspectRatio();
            // prevent possible upsizing
            $constraint->upsize();
        });

    }
}