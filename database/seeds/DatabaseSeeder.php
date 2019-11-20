<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // 自分用のユーザーを作成
        factory(App\User::class)->create(
            ['name' => '自分', 'email' => 'aa@bb.net']
        );

        // 他のユーザーを作成
        factory(App\User::class, 9)->create();

        // 作成したユーザーにメッセージを登録する
        App\User::all()->each(function ($user) {
            factory(App\Message::class, $user->id % 4)->create(['user_id' => $user->id]);
        });

        // 管理者を作成
        factory(App\Admin::class)->create(
            ['username' => 'taro', 'password' => bcrypt('jiro')]
        );
    }
}
