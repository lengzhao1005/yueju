<?php
/**
 * Created by PhpStorm.
 * User: 13264
 * Date: 2019/3/3
 * Time: 14:58
 */

namespace App\Http\Controllers\Admin\Ajax;


use App\Http\Controllers\Controller;
use App\Repositories\ShopRepository;
use Illuminate\Http\Request;

class ShopController extends Controller
{

    public function ShopList(Request $request, ShopRepository $shopRepository)
    {
        $page = $request->page;
        $limit = $request->limit;
        return $shopRepository->getShopList($page,$limit);
    }
}