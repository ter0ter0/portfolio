<?php

use Illuminate\Database\Seeder;

class RepliesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($userId = 1; $userId <= 5; $userId++){ // ユーザー
            for($postId = 1; $postId <=15; $postId++){
                for($i = 1; $i <= 3; $i++){
                DB::table('replies')->insert([
                    'content' => '私はユーザー'. $userId. 'です。'. 'テスト投稿'. $postId. 'への'. $i. '回目の返信です。',
                    'user_id' => $userId,
                    'post_id' => $postId,
                ]);
                }
            }
        }
    }
}
