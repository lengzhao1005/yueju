<?php
/**
 * Created by PhpStorm.
 * User: 13264
 * Date: 2019/2/19
 * Time: 9:29
 */

namespace App\Repositories;


use App\Model\Plot;

class PlotRepository
{
    protected $plot_model;
    public function __construct(Plot $plot)
    {
        $this->plot_model = $plot;
    }

    public function getPlotList($page, $limit)
    {
        $skip = $limit * ($page-1);
        $plot_list = $this->plot_model->skip($skip)->take($limit)->get()->toArray();
        $count = $this->plot_model->count();
        return response()->json(['code'=>0,'data'=>$plot_list,'msg'=>'','count'=>$count]);
    }
}