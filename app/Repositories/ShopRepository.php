<?php
/**
 * Created by PhpStorm.
 * User: 13264
 * Date: 2019/3/3
 * Time: 14:59
 */

namespace App\Repositories;


use App\Models\Shop;

class ShopRepository
{
    protected $shop_model;
    public function __construct(Shop $shop)
    {
        $this->shop_model = $shop;
    }

    public function getShopList($page, $limit)
    {
        $skip = $limit * ($page-1);
        $plot_list = $this->shop_model->skip($skip)->take($limit)->get()->toArray();
        $count = $this->shop_model->count();
        return response()->json(['code'=>0,'data'=>$plot_list,'msg'=>'','count'=>$count]);
    }
}