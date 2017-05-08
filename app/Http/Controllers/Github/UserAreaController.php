<?php

namespace App\Http\Controllers\Github;

use App\Http\Controllers\Controller;
use App\Services\GithubService;
use Illuminate\Http\Request;

class UserAreaController extends Controller
{
    /**
     * @var GithubService
     */
    private $service;

    public function __construct(GithubService $service)
    {
        $this->service = $service;

        $this->middleware(function (Request $request, \Closure $next) {
            if ($request->session()->has('github_credentials')) {
                $credentials = json_decode($request->session()->get('github_credentials'));


                $check = $this->service->checkAuth(
                    $credentials[0], $credentials[1]
                );

                if ($check['success'] == true) {
                    $this->service->setCredentials($credentials[0], $credentials[1]);
                    return $next($request);
                }

                return redirect()->route('github.index');
            }
        });
    }

    public function area()
    {
        return view('github.dashboard')->withRepos($this->getRepositories());
    }

    public function repositories()
    {
        return view('github.repos')->withRepos($this->getRepositories());
    }

    public function getRepositories()
    {
        $data = $this->service->getRepositories();
        return json_decode($data->getContents());
    }
    
    public function issues()
    {
        $data = $this->service->getIssues();
        $issues = json_decode($data->getContents());

        return view('github.issues')->withIssues($issues);
    }
}
