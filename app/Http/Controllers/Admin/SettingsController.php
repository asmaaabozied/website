<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroySettingRequest;
use App\Http\Requests\StoreSettingRequest;
use App\Http\Requests\UpdateSettingRequest;
use App\Setting;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\SubDomian;
use App\Seo;

class SettingsController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('setting_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $settings = Setting::all();
        $settings_collection = collect();
        foreach ($settings as $p1) {
            $settings_collection->put($p1->keyEn, [$p1->keyAr,$p1->value]);
        }
        $subDomians = SubDomian::get();
        $seos = Seo::get();
        return view('admin.settings.index', compact('settings','settings_collection'
        ,'subDomians','seos'));
    }

    public function create()
    {
        abort_if(Gate::denies('setting_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.settings.create');
    }

    public function store(StoreSettingRequest $request)
    {
        $setting = Setting::create($request->all());

        return redirect()->route('admin.settings.index');
    }

    public function edit(Setting $setting)
    {
        abort_if(Gate::denies('setting_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.settings.edit', compact('setting'));
    }

    public function update(UpdateSettingRequest $request, Setting $setting)
    {
        $setting->update($request->all());

        return redirect()->route('admin.settings.index');
    }

    public function show(Setting $setting)
    {
        abort_if(Gate::denies('setting_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.settings.show', compact('setting'));
    }

    public function destroy(Setting $setting)
    {
        abort_if(Gate::denies('setting_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $setting->delete();

        return back();
    }

    public function massDestroy(MassDestroySettingRequest $request)
    {
        Setting::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }



        public function general(Request $request){
            $this->validate($request, [
                'siteNameAr' => 'required',
                'siteNameEn' => 'required',
                'siteurl' => 'required',
                'adsExpireDays' => 'required|numeric',
                'app_store_link' => 'required',
                'google_play_link' => 'required'
            ],
            [
                'siteNameAr.required' => 'تأكد من إدخال أسم الموقع بالعربية  !',
                'siteNameEn.required' => 'تأكد من إدخال أسم الموقع بالانجليزية !',
                'siteurl.required' => 'تأكد من إدخال رابط الموقع !',
                'adsExpireDays.required' => 'تأكد من إدخال Ads Period in Days !',
                'adsExpireDays.numeric' => 'Ads Period in Days يجب أن يكون رقم !',
                'app_store_link.required' => 'تأكد من إدخال app store link !',
                'google_play_link.required' => 'تأكد من إدخال google play link !'
            ]);

            $input = $request->all();

            Setting::where('keyEn', 'siteNameAr')->update(['value' => $input['siteNameAr']]);
            Setting::where('keyEn', 'siteNameEn')->update(['value' => $input['siteNameEn']]);
            Setting::where('keyEn', 'siteurl')->update(['value' => $input['siteurl']]);
            Setting::where('keyEn', 'adsExpireDays')->update(['value' => $input['adsExpireDays']]);
            Setting::where('keyEn', 'app_store_link')->update(['value' => $input['app_store_link']]);
            Setting::where('keyEn', 'google_play_link')->update(['value' => $input['google_play_link']]);
            return redirect()->back();
        }

        public function mail_settings(Request $request){
            $this->validate($request, [
                'email_id' => 'required',
                'smtp_host' => 'required',
                'smtp_user' => 'required',
                'smtp_pass' => 'required',
                'smtp_port' => 'required|numeric'
            ],
            [
                'email_id.required' => 'تأكد من إدخال ايميل الموقع  !',
                'smtp_host.required' => 'تأكد من إدخال خادم البريد !',
                'smtp_user.required' => 'تأكد من إدخال اسم مستخدم الايميل !',
                'smtp_pass.required' => 'تأكد من إدخال كلمة المرور  !',
                'smtp_port.required' => 'تأكد من إدخال منفذ البريد  !',
                'smtp_port.numeric' => 'منفذ البريد يجب أن يكون رقم  !'
            ]);


            $input = $request->all();

            Setting::where('keyEn', 'email_id')->update(['value' => $input['email_id']]);
            Setting::where('keyEn', 'smtp_host')->update(['value' => $input['smtp_host']]);
            Setting::where('keyEn', 'smtp_user')->update(['value' => $input['smtp_user']]);
            Setting::where('keyEn', 'smtp_pass')->update(['value' => $input['smtp_pass']]);
            Setting::where('keyEn', 'smtp_port')->update(['value' => $input['smtp_port']]);

            if (isset($input['smtp']))
                Setting::where('keyEn', 'smtp')->update(['value' => '1']);
            else
                Setting::where('keyEn', 'smtp')->update(['value' => '0']);


            if (isset($input['smtp_auth']))
                Setting::where('keyEn', 'smtp_auth')->update(['value' => '1']);
            else
                Setting::where('keyEn', 'smtp_auth')->update(['value' => '0']);

            return redirect()->back();

        }

        public function social(Request $request)
        {
            $this->validate($request, [
                'socialInstagram' => 'required',
                'socialFacebook' => 'required',
                'socialTwitter' => 'required',
                'socialGoogle' => 'required',
                'socialLinkedin' => 'required',
                'socialYoutube' => 'required',
                'forumsLink' => 'required'
            ],
            [
                'socialInstagram.required' => 'تأكد من إدخال حساب الانستجرام  !',
                'socialFacebook.required' => 'تأكد من إدخال حساب الفيس بوك !',
                'socialTwitter.required' => 'تأكد من إدخال حساب التويتر !',
                'socialGoogle.required' => 'تأكد من إدخال رابط جوجل + !',
                'socialLinkedin.required' => 'تأكد من إدخال رابط حساب الـLinkedIn !',
                'socialYoutube.required' => 'تأكد من إدخال حساب ال youtube !',
                'forumsLink.required' => 'تأكد من إدخال رابط المنتديات !'
            ]);


            $input = $request->all();

            Setting::where('keyEn', 'socialInstagram')->update(['value' => $input['socialInstagram']]);
            Setting::where('keyEn', 'socialFacebook')->update(['value' => $input['socialFacebook']]);
            Setting::where('keyEn', 'socialTwitter')->update(['value' => $input['socialTwitter']]);
            Setting::where('keyEn', 'socialGoogle')->update(['value' => $input['socialGoogle']]);
            Setting::where('keyEn', 'socialLinkedin')->update(['value' => $input['socialLinkedin']]);
            Setting::where('keyEn', 'socialYoutube')->update(['value' => $input['socialYoutube']]);
            Setting::where('keyEn', 'forumsLink')->update(['value' => $input['forumsLink']]);

            return redirect()->back();
        }

        public function seo_setting(Request $request)
        {

            $this->validate($request, [
                'metakeysAr' => 'required',
                'metakeysEn' => 'required',
                'metadescrbAr' => 'required',
                'metadescrbEn' => 'required'
            ],
                [
                    'metakeysAr.required' => 'تأكد من إدخال كلمات الموقع العربية  !',
                    'metakeysEn.required' => 'تأكد من إدخال كلمات الموقع بالانجليزية !',
                    'metadescrbAr.required' => 'تأكد من إدخال وصف الموقع بالعربية !',
                    'metadescrbEn.required' => 'تأكد من إدخال وصف الموقع بالانجليزية  !'
                ]);


            $input = $request->all();

            Setting::where('keyEn', 'metakeysAr')->update(['value' => $input['metakeysAr']]);
            Setting::where('keyEn', 'metakeysEn')->update(['value' => $input['metakeysEn']]);
            Setting::where('keyEn', 'metadescrbAr')->update(['value' => $input['metadescrbAr']]);
            Setting::where('keyEn', 'metadescrbEn')->update(['value' => $input['metadescrbEn']]);

            return redirect()->back();
        }



}
