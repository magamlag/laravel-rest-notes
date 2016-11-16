<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class GithubApiTest extends TestCase
{
    public function testBadAuth()
    {
        $this->visit('/section/2/github');
        $this->type('SomeBadLogin', 'login');
        $this->type('SomeBadPassword', 'password');
        $this->press('log in');
        $this->seePageIs('/section/2/github');
    }

    public function testGoodAuth()
    {
        $this->visit('/section/2/github');
        $this->type('LaravelTester', 'login');
        $this->type('123123a', 'password');
        $this->press('log in');
        $this->seePageIs('/section/2/github/user_area');
        $this->see('My repositories');
        $this->see('My issues');
    }

    public function testShowMyIssues()
    {
        $this->session([
            'github_credentials'    =>  json_encode([
                'LaravelTester','123123a'
            ])
        ]);

        $this->visitRoute('github.user_area.issues');
        $this->see('Title');
        $this->see('Body');
        $this->see('State');
    }

    public function testShowMyRepositories()
    {
        $this->session([
            'github_credentials'    =>  json_encode([
                'LaravelTester','123123a'
            ])
        ]);

        $this->visitRoute('github.user_area.repos');
        $this->see('Name');
        $this->see('Description');
        $this->see('Stars');
    }

    public function testShowMyIssuesBad()
    {
        $this->session([
            'github_credentials'    =>  json_encode([
                'LaravelTesterBad','123123a'
            ])
        ]);
        $this->visit('/section/2/github/user_area/issues');
        $this->see('log in');
    }

    public function testShowMyRepositoriesBad()
    {
        $this->session([
            'github_credentials'    =>  json_encode([
                'LaravelTesterBad','123123a'
            ])
        ]);
        $this->visit('/section/2/github/user_area/repos');
        $this->see('log in');
    }
}
