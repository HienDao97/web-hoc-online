<?php

namespace App\Providers;

use App\Models\Course;
use App\Models\Slide;
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
                'root_route' => 'home.index',
                'route_name' =>  ['home.index'],
                'sub' => [],
                'scroll' => 0
                //'param' => ""
            ],
            [
                'name' => 'Khoá học',
                'root_route' => 'home.classroom.index',
                'route_name' => ['home.classroom.index', 'home.classroom.detail', 'student.classroom.exercise', 'student.classroom'],
                'sub' => [],
                'scroll' => 0
                //'param' => ""
            ],
            [
                'name' => 'Giới thiệu',
                'root_route' => 'home.introduce.index',
                'route_name' => ['home.introduce.index'],
                'sub' => [],
                'scroll' => 0,
                'id' => 'about'
                //'param' => ""
            ],
            [
                'name' => 'Tài liệu',
                'root_route' => 'home.document.index',
                'route_name' => ['home.document.index', 'home.document.course'],
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
        $slides = Slide::whereNull('deleted_at')->get();
        View::share('course_menus', $courses);
        View::share('backend_menus', $menus);
        View::share('slides', $slides);
    }
}
