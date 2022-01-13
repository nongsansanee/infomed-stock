<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Inertia\Middleware;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that is loaded on the first page visit.
     *
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determine the current asset version.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    public function version(Request $request)
    {
        return parent::version($request);
    }

    /**
     * Define the props that are shared by default.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function share(Request $request)
    {

       // $user = Auth::user();
    //    Log::info('HandleInertiaRequest share()');
    //    Log::info($request->user());

        return array_merge(parent::share($request), [
            'auth' => $request->user() ?[
                'user' => $request->user(),
                'abilities'=> $request->user()->abilities,
            ]:null,
            'flash' => [
                'status' => fn () => $request->session()->pull('status'),
                'msg' => fn () => $request->session()->pull('msg'),
                'mainMenuLinks' => fn () => $request->session()->pull('mainMenuLinks',[]),
                // 'actionMenu' => fn () => $request->session()->pull('action-menu', []),
            ],
        ]);
    }
}
