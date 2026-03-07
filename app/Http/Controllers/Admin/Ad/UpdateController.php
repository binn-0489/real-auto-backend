<?php

namespace App\Http\Controllers\Admin\Ad;

use App\Http\Controllers\Controller;
use App\Http\Filters\AdFilter;
use App\Http\Requests\FilterRequest;
use Illuminate\Http\Request;
use App\Models\Ad;
use App\Models\Brand;
use App\Http\Requests\StoreRequest;


class UpdateController extends Controller
{
    public function __invoke(Ad $ad, StoreRequest $request){
        $data = $request->validated();
        $ad->update($data);
        //Ad::factory()->create($data);
        return redirect()->route('admin.ad.show', $ad->id);
    }


}
