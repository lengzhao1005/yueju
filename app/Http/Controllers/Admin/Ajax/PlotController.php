<?php

namespace App\Http\Controllers\Admin\Ajax;

use App\Http\Controllers\Controller;
use App\Repositories\PlotRepository;
use Illuminate\Http\Request;

class PlotController extends Controller
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
