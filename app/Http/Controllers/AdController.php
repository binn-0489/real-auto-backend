<?php

namespace App\Http\Controllers;

use App\Http\Filters\AdFilter;
use App\Http\Requests\FilterRequest;
use Illuminate\Http\Request;
use App\Models\Ad;
use App\Models\Brand;
use App\Http\Requests\StoreRequest;


class AdController extends Controller
{
    public function index(FilterRequest $request){
//        $brand = Brand::find(6);
//        dd($brand->ads);

        $data = $request->validated();
        $filter = app()->make(AdFilter::class, ['queryParams' => array_filter($data)]);
        $ads = Ad::with('brand')->filter($filter)->paginate(10)->withQueryString();;
        //dd($ads);
        //$ads = Ad::with('brand')->paginate(10);
        return view('ad.index', compact('ads'));
    }

    public function create()
    {
        $brands = Brand::all();
        return view('ad.create', compact('brands'));
    }

    public function store(StoreRequest $request)
    {
        $data = $request->validated();
        $data['user_id'] = 1;
        Ad::create($data);
        //Ad::create($data);
        return redirect()->route('ad.index');
    }

    public function show(Ad $ad)
    {
        //$ad = Ad::findOrFail($id);
        return view('ad.show', compact('ad'));
    }

    public function edit(Ad $ad)
    {
        $brands = Brand::all();
        return view('ad.edit', compact('ad', 'brands'));
    }

    public function update(Ad $ad, StoreRequest $request)
    {
        $data = $request->validated();
        $ad->update($data);
        //Ad::factory()->create($data);
        return redirect()->route('ad.show', $ad->id);

//        $ad = Ad::find(1);
//        $ad->update(
//            [
//                'brand' => 'updated',
//                'model' => 'updated',
//            ]
//        );
    }

    public function destroy(Ad $ad)
    {
        $ad->delete();
        return redirect()->route('ad.index');
    }
    public function delete(Ad $ad)
    {
//        $ad = Ad::find('1');
//        $ad->delete();
//        dd('deleted');

        $ad = Ad::withTrashed()->find('1');
        $ad->restore();
        dd('restored');
    }

    public function firstOrCreate()
    {
        $ad = Ad::firstOrCreate([
            'brand_id' => 1
        ],[
            'user_id' => 1,
            'brand_id' => 1,
            'model' => 'S2000',
            'generation' => 'I',
            'price' => '1500000',
            'mileage' => '230000',
            'year' => '2004',
            'transmission' => 'AT',
            'drive' => 'задний',
            'engine_type' => 'бензин',
            'engine_volume' =>'2.0',
            'engine_power' => '210',
            'wheel' => 'левый',
            'condition' => 'не битый',
            'body_type' => 'кабриолет',
            'description' => 'ни б ни к',
            'location' => 'Ростов-на-Дону',
            'vin' => '1234',
            'number' => '1234',
            ]);
        dump($ad->model);
        dd("end");
    }

    public function updateOrCreate()
    {
        $anotherAd = [
            'user_id' => 1,
            'brand_id' => 1,
            'model' => 'S2000',
            'generation' => 'I',
            'price' => '1500000',
            'mileage' => '230000',
            'year' => '2004',
            'transmission' => 'AT',
            'drive' => 'задний',
            'engine_type' => 'бензин',
            'engine_volume' =>'2.0',
            'engine_power' => '210',
            'wheel' => 'левый',
            'condition' => 'не битый',
            'body_type' => 'кабриолет',
            'description' => 'ни б ни к',
            'location' => 'Ростов-на-Дону',
            'vin' => '1234',
            'number' => '1234',
        ];
        $ad = Ad::updateOrCreate(['model' => 'S2000'],$anotherAd);
        dump($ad->model);
        dd('end');
    }
}
