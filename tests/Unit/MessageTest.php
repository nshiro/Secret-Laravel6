<?php

namespace Tests\Unit;

use App\Message;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class MessageTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
     public function message_belongs_to_a_user()
    {
        $message = factory(Message::class)->create();

        $this->assertInstanceOf(User::class, $message->user);
    }
}
