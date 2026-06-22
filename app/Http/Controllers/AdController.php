<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Filters\AdFilter;
use App\Http\Requests\FilterRequest;
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

    public function recIndex(RecommendationService $service)
    {   
        $ads = $service->getRecommendations(auth()->user());

        return view('ad.index', compact('ads'));
    }

    public function create()
    {
        $brands = Brand::all();
        return view('ad.create', compact('brands'));
    }

    public function store(StoreRequest $request)
    {
        $ad = DB::transaction(function () use ($request) {
            $data = $request->validated();

            $ad = auth()->user()->ads()->create($data);

            if($request->hasFile('images')){ 
                foreach ($request->file('images') as $index => $image){
                    $path = $image->store('ads', 'public');

                    $ad->images()->create([
                        'path' => $path,
                        'is_main' => (int)$request->main_image === $index,
                    ]);
                }
            }
            return $ad;
        });
        return redirect()->route('ad.show', $ad/*->id*/);
    }

    public function show(Ad $ad)
    {
        // if (auth()->check()) {

        //     $exists = AdView::where('user_id', auth()->id())
        //         ->where('ad_id', $ad->id)
        //         ->where('created_at', '>=', now()->subMinutes(30))
        //         ->exists();
        
        //     if (!$exists) {
        //         AdView::create([
        //             'user_id' => auth()->id(),
        //             'ad_id' => $ad->id,
        //         ]);
        //     }
        // }
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


        if($request->hasFile('images'))
        {
            foreach($request->file('images') as $index => $image){
                $path = $image->store('ads', 'public');
                $ad->images()->create([
                    'is_main' => (int)$request->main_image === $index,
                    'path' => $path,
                ]);
            }
        }
        return redirect()->route('ad.show', $ad->id);
    }

    public function myAdsIndex(FilterRequest $request)
    {
        $data = $request->validated();

        $filter = app()->make(AdFilter::class, ['queryParams' => array_filter($data)]);

        $ads = Ad::with('brand')
        ->where('user_id', auth()->id())
        ->filter($filter)
        ->paginate(10)
        ->withQueryString();;

        return view('ad.myAdIndex', compact('ads'));
    }

    public function destroy(Ad $ad)
    {
        $ad->delete();
        return redirect()->route('ad.myAdIndex');
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


    public function addFav(Ad $ad)
    {
        // 'user_id' => auth()->id(),
        // 'ad_id' => $ad->id,
        auth()->user()->favourites()->syncWithoutDetaching($ad->id);
        return redirect()->back();
    }

    public function remFav(Ad $ad)
    {
        auth()->user()->favourites()->detach($ad->id);
        return redirect()->back();
    }

    public function favAdsIndex(FilterRequest $request)
    {
        $data = $request->validated();

        $filter = app()->make(AdFilter::class, ['queryParams' => array_filter($data)]);

        $ads = auth()->user()
        ->favourites()
        ->with('brand')
        ->filter($filter)
        ->paginate(10)
        ->withQueryString();
        
        // $ads = Ad::with('brand')
        // ->favourites()
        // ->filter($filter)
        // ->paginate(10)
        // ->withQueryString();;

        return view('ad.favIndex', compact('ads'));
    }

    














    
    /////////////////////////////////////////////////////////////////////////////////////////////////
    //------------------------------тут начинается функционал тг бота------------------------------//
    /////////////////////////////////////////////////////////////////////////////////////////////////



    public function apiIndex(FilterRequest $request)
{
    $data = $request->validated();
    $filter = app()->make(AdFilter::class, [
        'queryParams' => array_filter($data)
    ]);

    $ads = Ad::with('brand')
        ->filter($filter)
        ->limit(10)
        ->get();

    return response()->json($ads);
}
}
