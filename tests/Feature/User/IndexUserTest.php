<?php

namespace Tests\Feature\User;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class IndexUserTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function need_user_login()
    {
        $res = $this->get('/user');

        $res->assertRedirect('/user/login');
    }

    /** @test */
    public function can_see_page_when_user_loggedin()
    {
        $this->loginUser();

        $res = $this->get('/user');

        $res->assertOk();
    }

    /** @test */
    public function cannot_see_page_when_admin_loggedin()
    {
        $this->loginAdmin();

        $res = $this->get('/user');

        $res->assertRedirect('/user/login');
    }
}
