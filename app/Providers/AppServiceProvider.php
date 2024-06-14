<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use App\CentralLogics\Helpers;
use App\Models\BusinessSetting;
use Config;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $mailsetting=[];
         $item = BusinessSetting::where(['key' => 'mail_config'])->first();
        $data = $item?json_decode($item->value, true): null;
        if (isset($data)) {

            
               $mailsetting = [
                    'driver'            =>  $data['driver'],
                    'host'              =>  $data['host'],
                    'port'              =>  $data['port'],
                    'encryption'        =>  $data['encryption'],
                    'username'          =>  $data['username'],
                    'password'          =>  $data['password'],
                    'from'              =>  [
                        'address'       =>  $data['username'],
                        'name'          =>  $data['name']
                                ]
                               ];  

        Config::set('mail',$mailsetting);                                   
                
            
            }
        try
        {
            Paginator::useBootstrap();
            foreach(Helpers::get_view_keys() as $key=>$value)
            {
                view()->share($key, $value);
            }
        }
        catch(\Exception $e)
        {

        }
        
    }
}
