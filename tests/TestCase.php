<?php

namespace Tests;

use App\Admin;
use App\User;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    /**
     * 一般ユーザーでログイン
     */
    protected function loginUser($user = null)
    {
        $user = $user ?? factory(User::class)->create();

        $this->actingAs($user, 'user');

        return $user;
    }

    /**
     * 管理者でログイン
     */
    protected function loginAdmin($admin = null)
    {
        $admin = $admin ?? factory(Admin::class)->create();

        $this->actingAs($admin, 'admin');

        return $admin;
    }
}
