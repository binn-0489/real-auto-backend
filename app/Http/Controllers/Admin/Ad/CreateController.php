<?php

namespace App\Http\Controllers\Admin\Ad;

use App\Http\Controllers\Controller;
use App\Http\Filters\AdFilter;
use App\Http\Requests\FilterRequest;
use Illuminate\Http\Request;
use App\Models\Ad;
use App\Models\Brand;
use App\Http\Requests\StoreRequest;


class CreateController extends Controller
{
    public function __invoke(){
        $adsCount = Ad::count();
        $brands = Brand::all();
        return view('admin/ad/create', compact('brands', 'adsCount'));
    }



}
