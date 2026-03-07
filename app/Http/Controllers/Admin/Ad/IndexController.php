<?php

namespace App\Http\Controllers\Admin\Ad;

use App\Http\Controllers\Controller;
use App\Http\Filters\AdFilter;
use App\Http\Requests\FilterRequest;
use Illuminate\Http\Request;
use App\Models\Ad;
use App\Models\Brand;
use App\Http\Requests\StoreRequest;


class IndexController extends Controller
{
    public function __invoke(FilterRequest $request){


        $data = $request->validated();
        $filter = app()->make(AdFilter::class, ['queryParams' => array_filter($data)]);
        $ads = Ad::with('brand')->filter($filter)->paginate(10)->withQueryString();;
        $adsCount = Ad::count();
        return view('admin/ad/index', compact('ads', 'adsCount'));
    }



}
