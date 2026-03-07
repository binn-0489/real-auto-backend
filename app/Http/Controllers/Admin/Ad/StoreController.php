<?php

namespace App\Http\Controllers\Admin\Ad;

use App\Http\Controllers\Controller;
use App\Http\Filters\AdFilter;
use App\Http\Requests\FilterRequest;
use Illuminate\Http\Request;
use App\Models\Ad;
use App\Models\Brand;
use App\Http\Requests\StoreRequest;


class StoreController extends Controller
{
    public function __invoke(StoreRequest $request){
        $data = $request->validated();
        $data['user_id'] = 1;
        Ad::create($data);
        return redirect()->route('admin.ad.index');
    }


}
