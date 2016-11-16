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
    
    public function __construct(GithubService $service)
    {
        $this->service = $service;
    }
    

    public function index()
    {
        return view('github.index');
    }
    
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

        Session::put('github_credentials',json_encode(
            [$request->login,$request->password]
        ));

        return redirect()->route('github.user_area');
    }
}
