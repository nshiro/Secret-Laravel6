<?php

namespace Tests\Feature\Admin;

use App\Message;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class MessageAdminTest extends TestCase
{
    use RefreshDatabase;

    private function validData($params = [])
    {
        return array_merge([
            'user_id' => 1,
            'title' => 'aiueo',
            'content' => 'hoge bar',
        ], $params);
    }

    /** @test */
    public function can_see_message_list_in_order()
    {
        factory(User::class)->create(['name' => 'taro']);
        factory(User::class)->create(['name' => 'jiro']);
        factory(User::class)->create(['name' => 'sabu']);

        factory(Message::class)->create(['title' => 'subject1', 'created_at' => '2019-11-22 10:00:00', 'user_id' => 1]);
        factory(Message::class)->create(['title' => 'subject2', 'created_at' => '2019-11-22 09:00:00', 'user_id' => 2]);
        factory(Message::class)->create(['title' => 'subject3', 'created_at' => '2019-11-22 11:00:00', 'user_id' => 3]);

        $this->loginAdmin();

        $res = $this->get('/admin/message');

        $res->assertSeeInOrder(['subject3', 'subject1', 'subject2']);
        $res->assertSeeInOrder(['sabu', 'taro', 'jiro']);
    }

    /** @test */
    public function can_see_create_screen()
    {
        $this->loginAdmin();

        $this->get('/admin/message/create')->assertOk();
    }

    /** @test */
    public function can_store_valid_message()
    {
        $this->loginAdmin();

        factory(User::class)->create();

        $res = $this->from('/admin/message/create')->post('/admin/message/create', $this->validData());

        $message = Message::first();

        $res->assertRedirect('/admin/message/edit/1');
        $this->assertEquals(1, $message->id);
        $this->assertEquals('aiueo', $message->title);
        $this->assertEquals('hoge bar', $message->content);
    }

    /** @test */
    public function user_id_must_exist()
    {
        $this->loginAdmin();

        $res = $this->from('/admin/message/create')->post('/admin/message/create', $this->validData([
            'user_id' => 100
        ]));

        $res->assertRedirect('/admin/message/create');
        $res->assertSessionHasErrors('user_id');
    }

    /** @test */
    public function user_id_required()
    {
        $this->loginAdmin();

        factory(User::class)->create();

        $res = $this->from('/admin/message/create')->post('/admin/message/create', $this->validData([
            'user_id' => ''
        ]));

        $res->assertRedirect('/admin/message/create');
        $res->assertSessionHasErrors('user_id');
    }

    /** @test */
    public function title_required()
    {
        $this->loginAdmin();

        factory(User::class)->create();

        $res = $this->from('/admin/message/create')->post('/admin/message/create', $this->validData([
            'title' => ''
        ]));

        $res->assertRedirect('/admin/message/create');
        $res->assertSessionHasErrors('title');
    }

    /** @test */
    public function content_required()
    {
        $this->loginAdmin();

        factory(User::class)->create();

        $res = $this->from('/admin/message/create')->post('/admin/message/create', $this->validData([
            'content' => ''
        ]));

        $res->assertRedirect('/admin/message/create');
        $res->assertSessionHasErrors('content');
    }

    /** @test */
    public function can_see_edit_page()
    {
        $this->loginAdmin();

        factory(Message::class)->create();

        $this->get('/admin/message/edit/1')->assertOk();
    }

    /** @test */
    public function can_update_valid_data()
    {
        $this->loginAdmin();

        factory(User::class)->create();

        $message = factory(Message::class)->create([
            'title' => 'dummy title',
            'content' => 'dummy content'
        ]);

        $res = $this->post('/admin/message/edit/1', $validData = $this->validData());

        $message->refresh();

        $res->assertRedirect('/admin/message/edit/1');
        $this->assertCount(1, Message::all());
        $this->assertDatabaseHas('messages', $validData);
        $this->assertEquals('aiueo', $message->title);
    }
}
