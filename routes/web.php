<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

class G
{
    public $get;

    public function Set()
    {

    }
}

Route::get('/', function () {
    $json = '{"charset":"UTF-8","err_code":"ORDERPAID","err_msg":"\u8be5\u8ba2\u5355\u5df2\u652f\u4ed8","mch_id":"101540247292","nonce_str":"1015402472921523667801","result_code":"1","sign":"2F1771AD2FD2F786CA20949006A3763C","sign_type":"MD5","status":"0","version":"2.0","func":"jspay"}';

    dump($id = spl_object_hash(new G()));
    $get[$id] = new G();
    dd($get);

    dd(json_decode($json,1));

    /*$i='PU1ETXdNVE0=';
        $step1=base64_decode($i);
        $step2=strrev($step1);
        $res = base64_decode($step2);

    dd($res);*/


    /*$data = [];
    for($i=5018;$i<=10017;$i++) {
        $data[$i]['allpay_mno'] = '86570004';
        $data[$i]['id_wxplatform'] = 1;
        $data[$i]['mchreturn'] = 20;
        $data[$i]['createtime'] = date('Y-m-d H:i:s');
        $data[$i]['feerate'] = 30;
        $data[$i]['remain_cash'] = 0;
    }
    //dd($data);
    $res = DB::connection('mysql_yinzhun')->table('merchant')->insert($data);
    dd($res);*/
    /*$i=8;
    $step1=base64_encode($i);
    $step2=strrev($step1);
    $res = base64_encode($step2);
    dump($res);*/

    /*$monolog = \Log::getMonolog();

    $monolog->popHandler();
    \Log::useDailyFiles(storage_path().'logs/job/errpr.log');
    \Log::info('test');*/
    return view('welcome');
});

Route::get('/test',function(){
    return view('test');
});

Auth::routes();


Route::get('/home', 'HomeController@index')->name('home');

Route::get('/swoole','SwooleController@index');