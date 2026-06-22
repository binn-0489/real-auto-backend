<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AdImage;
use Illuminate\Support\Facades\Storage;
class AdImageController extends Controller
{
    
    public function destroy(AdImage $image)
    {
        Storage::disk('public')->delete($image->path);
        $image->delete();
        return response()->json([
            'status' => 'ok'
        ]);
        //dd($image);
    }
}
