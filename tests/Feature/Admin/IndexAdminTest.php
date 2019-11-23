<?php

namespace Tests\Feature\Admin;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class IndexAdminTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function need_admin_login()
    {
        $res = $this->get('/admin');

        $res->assertRedirect('/admin/login');
    }

    /** @test */
    public function can_see_page_when_admin_loggedin()
    {
        $this->loginAdmin();

        $res = $this->get('/admin');

        $res->assertOk();
    }

    /** @test */
    public function cannot_see_page_when_user_loggedin()
    {
        $this->loginUser();

        $res = $this->get('/admin');

        $res->assertRedirect('/admin/login');
    }
}
