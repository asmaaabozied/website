<?php

namespace App\Http\Controllers\frontend;

use App\Category;
use App\CategoryType;
use App\ContactUsMessage;
use App\Http\Controllers\Controller;
use App\Http\Requests\ContactRequest;
use App\Http\Requests\VideoRequest;
use App\User;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyCategoryRequest;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Video;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Intervention\Image\ImageManager;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class FrontendController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {

        $categories = Category::all();

        $videos = Video::paginate(8);


        return view('frontend.home', compact('categories', 'videos'));
    }


    public function contacts()
    {

        return view('frontend.contacts');


    }


    public function addcontact(ContactRequest $request)
    {

        $input = $request->except(['_token', '_method']);

        ContactUsMessage::create($input);

        return redirect()->route('contacts');


    }

    public function uploadvideo()
    {
        $categories = Category::all();


        return view('frontend.uploadvideo', compact('categories'));


    }

    public function add_uploadvideo(Request $request)
    {

        $categories = Category::all();
        $request->validate([
            'title' => 'required|string',
            'content' => 'required',

        ]);


        Video::create($request->execpt(['_token', '_method']));

        return view('frontend.uploadvideo', compact('categories'));


    }

    public function addregister(Request $request)
    {
        $request->validate([
            'phone' => 'required|string',
            'code' => 'required',
            'password' => 'required',

        ]);

        User::create($request->all());

        return redirect()->route('register');


    }

    public function checklogin(Request $request)
    {


        $password = $request->password;
        $phone = $request->phone;

        $user = User::where('phone', $phone)->where('password', $password);

        if ($user) {

            return redirect()->route('home');


        } else {

            return "بيانات الدخول  خطا";
        }


    }

    public function contactsvideo()
    {

        $movies = CategoryType::where('type', 'فيديو')->get();

        return $movies;


    }


}
