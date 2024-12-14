<?php

use Illuminate\Database\Seeder;

class AreasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('areas')->insert([
            ['area' => '北海道'],
            ['area' => '青森県'],
            ['area' => '岩手県'],
            ['area' => '宮城県'],
            ['area' => '秋田県'],
            ['area' => '山形県'],
            ['area' => '福島県'],
            ['area' => '茨城県'],
            ['area' => '栃木県'],
            ['area' => '群馬県'],
            ['area' => '埼玉県'],
            ['area' => '千葉県'],
            ['area' => '東京都'],
            ['area' => '神奈川県'],
            ['area' => '山梨県'],
            ['area' => '長野県'],
            ['area' => '新潟県'],
            ['area' => '富山県'],
            ['area' => '石川県'],
            ['area' => '福井県'],
            ['area' => '岐阜県'],
            ['area' => '静岡県'],
            ['area' => '愛知県'],
            ['area' => '三重県'],
            ['area' => '滋賀県'],
            ['area' => '京都府'],
            ['area' => '大阪府'],
            ['area' => '兵庫県'],
            ['area' => '奈良県'],
            ['area' => '和歌山県'],
            ['area' => '鳥取県'],
            ['area' => '島根県'],
            ['area' => '岡山県'],
            ['area' => '広島県'],
            ['area' => '山口県'],
            ['area' => '徳島県'],
            ['area' => '香川県'],
            ['area' => '愛媛県'],
            ['area' => '高知県'],
            ['area' => '福岡県'],
            ['area' => '佐賀県'],
            ['area' => '長崎県'],
            ['area' => '熊本県'],
            ['area' => '大分県'],
            ['area' => '宮城県'],
            ['area' => '鹿児島県'],
            ['area' => '沖縄県'],
        ]);
    }
}
