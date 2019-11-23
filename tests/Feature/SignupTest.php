<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SignupTest extends TestCase
{
    use RefreshDatabase;

    private function validData($params = [])
    {
        return array_merge([
            'name' => 'taro',
            'email' => 'aa@bb.net',
            'password' => 'password',
            'password_confirmation' => 'password',
            'reason' => '',
        ], $params);
    }

    /** @test */
    public function see_create_page()
    {
        $this->get('/signup')->assertOk();
    }

    /** @test */
    public function redirect_to_confirm_page_with_valid_data()
    {
        $res = $this->post('/signup', $this->validData());

        $res->assertRedirect('/signup/confirm');
    }

    /** @test */
    public function email_must_be_old_format()
    {
        $res = $this->post('/signup', $this->validData([
            'email' => 'ああ@ああ.net'
        ]));

        $res->assertSessionHasErrors('email');
    }

    /** @test */
    public function email_must_be_unique()
    {
        factory(User::class)->create([
            'email' => 'aa@bb.net'
        ]);

        $res = $this->post('/signup', $this->validData());

        $res->assertSessionHasErrors('email');
    }

    /** @test */
    public function reason_required_when_bad_guy()
    {
        $res = $this->post('/signup', $this->validData([
            'email' => 'aa@bad.guy'
        ]));

        $res->assertSessionHasErrors('reason');
    }

    /** @test */
    public function reason_must_present_when_bad_guy()
    {
        $data = $this->validData();

        unset($data['reason']);

        $res = $this->post('/signup', $this->validData([
            'email' => 'aa@bad.guy'
        ]));

        $res->assertSessionHasErrors('reason');
    }

    /** @test */
    public function cannot_see_confirm_page_without_sessoin()
    {
        $this->get('/signup/confirm')
            ->assertRedirect('/signup');
    }

    /** @test */
    public function can_see_confirm_page_with_session()
    {
        $this->withSession(['SignupData' => $this->validData()])
            ->get('/signup/confirm')
            ->assertOk();
    }

    /** @test */
    public function cannot_store_without_session()
    {
        $this->post('/signup/confirm')
            ->assertRedirect('/signup');
    }

    /** @test */
    public function can_store_valid_data()
    {
        $validData = $this->validData();

        $validData['password'] = '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi';
        unset($validData['password_confirmation']);

        $res = $this->withSession(['SignupData' => $validData])
            ->post('/signup/confirm');

        $user = User::first();

        $this->assertAuthenticatedAs($user, 'user');
        $this->assertDatabaseHas('users', $validData);
        $res->assertSessionMissing('SignupData');
        $res->assertRedirect('/signup/thanks');
    }

    /** @test */
    public function can_see_thanks_page()
    {
        $this->get('/signup/thanks')->assertOk();
    }
}
