<?php

namespace App\Http\Controllers\Github;

use App\Services\GithubService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class IndexController extends Controller
{
    /**
     * @var GithubService
     */
    private $service;
    private static $session_github = 'github_credentials';

    public function __construct(GithubService $service)
    {
        $this->service = $service;
    }

    /**
     * Show sign page
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getSignIn()
    {
        return view('github.signin');
    }

    /**
     * Show home page
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('github.index');
    }

    /**
     * Check if user logged in
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     */
    public function checkUser(Request $request)
    {
        $this->validate($request,[
            'login' =>  'required',
            'password'  =>  'required'
        ]);

        $check = $this->service->checkAuth($request->login,$request->password);


        if ($check['success'] == false) {
            return redirect()->back();
        }

        Session::put(self::$session_github,json_encode(
            [$request->login,$request->password]
        ));

        if ($request->ajax()) {
            $data['username'] = 'UserBoom';
            return response()->json([
                'data' => $data
            ]);
        }
        return redirect()->route('github.user_area');
    }

    /**
     * Log out user from Github Dashboard
     *
     * @param Request $request
     */
    public function loginOut(Request $request)
    {
        $request->session()->forget(self::$session_github);

        return redirect()->route('github.index');
    }
}
