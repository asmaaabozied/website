<?php

namespace App\Http\Controllers\Api;

use App\Adminmenu;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAdminmenuRequest;
use App\Http\Requests\UpdateAdminmenuRequest;
use App\Http\Resources\Admin\AdminmenuResource;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Category;
use App\Image;
use App\Video;
use App\Sound;
use App\Setting;
use App\Like;
use App\Favorite;
use App\Http\Controllers\Api\ApiController;

class ImageApiController extends Controller
{
    public function random_images(){
        $images = Image::all()->random(10);

        return response()->json([
            'data' => $images
        ]);
    }

    public function category_image(){

        $categories = Category::with('sub_categories')
            ->where('parent_category',0)
            ->where('category_type',3)
            ->where('active',1)->get();

        return response()->json([
            'data' => $categories
        ]);
    }

}
