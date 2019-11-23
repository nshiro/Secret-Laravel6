<?php

namespace Tests\Feature\User;

use App\Message;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class MessageUserTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function only_see_own_messages()
    {
        $user = $this->loginUser();

        $user->messages()->saveMany([
            factory(Message::class)->create(['title' => 'aaa']),
            factory(Message::class)->create(['title' => 'bbb']),
        ]);

        factory(Message::class)->create(['title' => 'ccc']);

        $res = $this->get('/user/message');

        $res->assertSee('aaa');
        $res->assertSee('bbb');
        $res->assertDontSee('ccc');
    }

    /** @test */
    public function can_see_own_message_but_not_others()
    {
        $user = $this->loginUser();

        $user->messages()->saveMany([
            factory(Message::class)->create(['title' => 'aaa']),
            factory(Message::class)->create(['title' => 'bbb']),
        ]);

        factory(Message::class)->create(['title' => 'ccc']);

        $this->get('/user/message/show/1')->assertOk();
        $this->get('/user/message/show/3')->assertForbidden();
    }
}
