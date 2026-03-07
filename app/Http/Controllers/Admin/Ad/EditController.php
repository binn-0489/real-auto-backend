<?php

namespace App\Http\Controllers\Admin\Ad;

use App\Http\Controllers\Controller;
use App\Http\Filters\AdFilter;
use App\Http\Requests\FilterRequest;
use Illuminate\Http\Request;
use App\Models\Ad;
use App\Models\Brand;
use App\Http\Requests\StoreRequest;


class EditController extends Controller
{
    public function __invoke(Ad $ad){
        $adsCount = Ad::count();
        $brands = Brand::all();
        return view('admin.ad.edit', compact('ad', 'brands', 'adsCount'));
    }



}
