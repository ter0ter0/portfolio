<?php

use Illuminate\Database\Seeder;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($id = 1; $id <= 5; $id++){ // ユーザー
            for($i = 1; $i <= 3; $i++){ // 投稿
                DB::table('posts')->insert([
                    'content' => 'ユーザー'. $id. 'の'. 'テスト投稿'. $i. '回目',
                    'user_id' => $id,
                ]);
            }
        }
    }
}
