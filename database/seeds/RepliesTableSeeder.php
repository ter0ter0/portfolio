<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RepliesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $userIds = range(1, 5);
        $postIds = range(1,15);

        foreach ($postIds as $postId) {
            $post = DB::table('posts')->where('id', $postId)->first();

            if ($post) {
                foreach ($userIds as $userId) {
                    for ($i = 1; $i <=3; $i++) {
                        DB::table('replies')->insert([
                            'content' => '私はユーザー' . $userId . 'です。これは「' . $post->content . '」に対する返信' . $i . '回目です。',
                            'post_id' => $postId,
                            'user_id' => $userId,
                        ]);
                    }
                }
            }
        }
    }
}
