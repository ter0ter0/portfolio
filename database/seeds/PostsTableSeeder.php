<?php

use Illuminate\Database\Seeder;
use App\Post;

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
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
        $postIds = range(15,1);
        foreach ($postIds as $postId) {
        $post = Post::where('id', $postId)->first();
            for($id = 1; $id <= 5; $id++){ // ユーザー
                DB::table('posts')->insert([
                    'content' => 'User'. $post->user_id. 'の投稿をリポスト'. PHP_EOL. '「' .$post->content. '」', 
                    'user_id' => $id,
                    'repost_id' => $post->id,
                    'original_post_user_id' => $post->user_id,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
