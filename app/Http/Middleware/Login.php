<?php

namespace App\Http\Middleware;

use Closure;
use Session;
// use App\UserProfile;
// use Illuminate\Http\Request;
// use Session;

class Login
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        // return $next($request);
        // if (session()->get('username') != '') {
        //     return redirect('/page-home');
        // } else {
        //     return $next($request); // คือการให้ทำอะไรต่อ
        // }
        // if (! $request->expectsJson()) {
        //     return route('login');
        // }

        //*! การสร้าง middleware เอง SOURCE : https://medium.com/@titipat/%E0%B9%82%E0%B8%99%E0%B9%89%E0%B8%95-middleware-%E0%B9%83%E0%B8%99-laravel-framework-8c256078e183 **/
        // SOURCE : https://stackoverflow.com/questions/16212937/how-can-i-use-session-variables-to-output-login-username
        // check if session variable is empty SOURCE : https://stackoverflow.com/questions/47228939/laravel-how-to-check-if-session-variable-is-empty
        if(session()->has('user_empn') && session()->get('maintenance_module_status') == 'Disable' || session()->has('user_empn') && session()->get('usertype_S012') == 'A' ) {
            return $next($request); // คือการให้ทำอะไรต่อ ในกรณีนี้คือถ้า Session มีค่า user_empn จะสามารถ access VIEW ต่างๆที่ใช้ PageController ได้
        }elseif(session()->has('user_empn') && session()->get('maintenance_module_status') == 'Enable'){
            return redirect()->route('page-qcc-maintenance');
        }else{
            // return route('user-login');
            // return back(); // SOURCE : https://stackoverflow.com/questions/54643562/laravel-middleware-returning-trying-to-get-property-headers-of-non-object-er , https://stackoverflow.com/questions/49716791/auto-redirect-in-laravel
            $request->session()->flush(); // clear session แต่ยังนับ ID ต่อจากเดิม
            $request->session()->regenerate(); // ล้าง Id ออกจาก session ด้วย (เริ่มนับ Id ใหม่)
            return redirect()->route('user-login');
        }
    }
}
