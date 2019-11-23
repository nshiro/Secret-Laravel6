<?php

namespace Tests\Feature\Admin;

use App\Message;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserAdminTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function see_users_list_in_order()
    {
        $this->loginAdmin();

        factory(User::class)->create(['name' => 'taro', 'created_at' => '2019-11-22 10:00:00']);
        factory(User::class)->create(['name' => 'jiro', 'created_at' => '2019-11-22 09:00:00']);
        factory(User::class)->create(['name' => 'sabu', 'created_at' => '2019-11-22 11:00:00']);

        $res = $this->get('/admin/user/');

        $res->assertSeeInOrder(['sabu', 'taro', 'jiro']);
    }

    /** @test */
    public function can_delete_user()
    {
        $this->loginAdmin();

        factory(User::class)->create();

        $this->assertCount(1, User::all());

        $res = $this->delete('/admin/user/destroy/1');

        $res->assertExactJson(['success' => true]);
        $this->assertCount(0, User::all());
    }
}
