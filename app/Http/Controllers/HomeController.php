<?php

namespace App\Http\Controllers;

use App\CentralLogics\Helpers;
use App\Models\BusinessSetting;
use App\Models\ContactUs;
use Illuminate\Http\Request;
use DB, Session;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        /*$this->middleware('auth');*/
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function terms_and_conditions()
    {
        $data = self::get_settings('terms_and_conditions');
        return view('terms-and-conditions',compact('data'));
    }

    public function about_us()
    {
        $data = self::get_settings('about_us');
        return view('about-us',compact('data'));
    }

    public function ribbon_view($key)
    {
        $data = self::get_ribbon($key);
        return view('ribbon-view',compact('data'));


    }

    public function contact_us()
    {
        return view('contact-us');
    }

    public function store_contact_us(Request $request) 
    {
        DB::beginTransaction();
            try {
                    $Records                            = new ContactUs;
                    $Records->name                      = $request->name;                    
                    $Records->phone                     = $request->phone;
                    $Records->email                     = $request->email;
                    $Records->message                   = $request->message;                    
                    $Records->save();
                    DB::commit();
                    $request->session()->flash('message', 'Thank You. We will conatact you soon');
                } 
            catch (\Exception $e) {
                DB::rollback();
                $request->session()->flash('message',$e->getMessage());
            }
            return redirect()->route('contact-us');
    }

    public function privacy_policy()
    {
        $data = self::get_settings('privacy_policy');
        return view('privacy-policy',compact('data'));
    }

    public static function get_settings($name)
    {
        $config = null;
        $data = BusinessSetting::where(['key' => $name])->first();
        if (isset($data)) {
            $config = json_decode($data['value'], true);
            if (is_null($config)) {
                $config = $data['value'];
            }
        }
        return $config;
    }

    public static function get_ribbon($name)
    {
        $config = null;
        $item = BusinessSetting::where(['key' => 'ribboncms'])->first();
        $data = $item?json_decode($item->value, true): null;
        if (isset($data)) {

            if($data && array_key_exists($name, $data))
            {
                $config['img'] = $data[$name]['img'];
                $config['title'] = $data[$name]['title'];
                $config['desc'] = $data[$name]['desc'];
                if (is_null($config)) {
                $config = $data['value'];
            }
            }
            
        }
        return $config;
        //print_r($config);die;
    }
}
