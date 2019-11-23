<?php

namespace Tests\Feature\User;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProfileUserTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function see_edit_page()
    {
        $user = factory(User::class)->create([
            'name' => '与太郎',
            'email' => 'aa@aa.net',
        ]);

        $this->loginUser($user);

        $res = $this->get('/user/profile/edit');

        $res->assertOk();
        $res->assertSee('与太郎');
        $res->assertSee('aa@aa.net');
    }

    /** @test */
    public function email_must_be_unique()
    {
        $this->loginUser();

        factory(User::class)->create([
            'email' => 'bar@aa.net',
        ]);

        $res = $this->post('/user/profile/edit', [
            'name' => '与太郎',
            'email' => 'bar@aa.net',
        ]);

        $res->assertSessionHasErrors('email');
    }

    /** @test */
    public function can_update_own_profile()
    {
        $this->loginUser();

        $res = $this->followingRedirects()->post('/user/profile/edit', $updateData = [
            'name' => '与太郎',
            'email' => 'aa@aa.net',
        ]);

        $res->assertSee('与太郎');
        $res->assertSee('aa@aa.net');
        $this->assertDatabaseHas('users', $updateData);
    }
}
