<?php

namespace App\Http\Controllers\Admin\Table;

use App\Http\Controllers\Controller;
use App\Repositories\PermissRepository;
use App\Repositories\PlotRepository;
use Illuminate\Http\Request;

class PlotListController extends Controller
{
    /*
     * 获取小区列表
     */
    public function plotList(Request $request, PlotRepository $plotRepository)
    {
        $page = $request->page;
        $limit = $request->limit;
        return $plotRepository->getPlotList($page,$limit);
    }
}
