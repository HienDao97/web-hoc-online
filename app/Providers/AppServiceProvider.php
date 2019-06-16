<?php

namespace App\Providers;

use App\Models\Course;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Routing\Route;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

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
        $courses = Course::whereNull('deleted_at')->get();
        $menus = [
            [
                'name' => 'TRANG CHỦ',
                'route_name' =>  'home.index',
                'sub' => [],
                'scroll' => 0
                //'param' => ""
            ],
            [
                'name' => 'Khoá học',
                'route_name' => '',
                'sub' => [],
                'scroll' => 0
                //'param' => ""
            ],
            [
                'name' => 'Giới thiệu',
                'route_name' => '',
                'sub' => [],
                'scroll' => 1,
                'id' => 'about'
                //'param' => ""
            ],
            [
                'name' => 'Tài liệu',
                'route_name' => 'home.document.index',
                'sub' => [],
                'scroll' => 0
                //'param' => ""
            ],
            [
                'name' => 'Cảm nhận phụ huynh',
                'route_name' => 'home.goc.phu.huynh',
                'sub' => [],
                'scroll' => 0
                //'param' => ""
            ],
            [
                'name' => 'Liên hệ',
                'route_name' => '',
                'sub' => [],
                'scroll' => 1,
                'id' => 'contact'
                //'param' => (!empty(Auth::guard('apartners')->user()->id)) ? Auth::guard('apartners')->user()->id : ""
            ]
        ];
        View::share('course_menus', $courses);
        View::share('backend_menus', $menus);
    }
}
