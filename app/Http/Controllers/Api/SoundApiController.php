<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use Gate;
use App\Category;
use App\Sound;
use App\Setting;
use App\Like;
use App\Favorite;

class SoundApiController extends Controller
{

    public function random_sounds(){
        $sounds = Sound::all()->random(10);

        return response()->json([
            'data' => $sounds
        ]);
    }

    public function category_sound(){


        $categories = Category::with('sub_categories')
            ->where('parent_category',0)
            ->where('category_type',2)
            ->where('active',1)->get();


        return response()->json([
            'data' => $categories
        ]);
    }

}
