<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;

class CommonController extends Controller
{
    //图片上传
    public function upload()
    {
        $file = Input::file('Filedata');
        if ($file -> isValid()){

            $entension = $file -> getClientOriginalExtension();//获取文件后缀
            $newName = date('YmdHis').mt_rand(100,999).'.'.$entension;

            $path = $file -> move('/Users/youjiahua/blog/public/uploads',$newName);
            $filepath = 'uploads/'.$newName;
            return $filepath;
        }
    }
}
