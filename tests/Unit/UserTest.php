<?php

namespace Tests\Unit;

use App\Message;
use App\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_user_has_messages()
    {
        $user = factory(User::class)->create();

        $this->assertInstanceOf(Collection::class, $user->messages);
    }

    /** @test */
    public function delete_messages_when_user_is_deleted()
    {
        $user = factory(User::class)->create();
        factory(Message::class, 3)->create(['user_id' => $user->id]);

        $user->delete();

        $this->assertCount(0, Message::all());
    }

    /** @test */
    public function get_latest_user_name_id_list()
    {
        factory(User::class)->create(['name' => 'taro', 'created_at' => '2019-11-22 10:00:00']);
        factory(User::class)->create(['name' => 'jiro', 'created_at' => '2019-11-22 09:00:00']);
        factory(User::class)->create(['name' => 'sabu', 'created_at' => '2019-11-22 11:00:00']);

        $lists = User::getUserList();

        $this->assertSame($lists->toArray(), [
            '3' => 'sabu',
            '1' => 'taro',
            '2' => 'jiro',
        ]);
    }
}
