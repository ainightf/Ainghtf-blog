<?php

use Illuminate\Database\Seeder;

class LinksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'link_name' => 'Laravel',
                'link_title' => 'Laravel官网',
                'link_url' => 'https://laravel.com/',
                'link_order' => '1',
        ],
            [   'link_name' => 'Node.js',
                'link_title' => 'Node.js官网',
                'link_url' => 'https://nodejs.org/en/',
                'link_order' => '2',
        ],
            [   'link_name' => 'Vue.js',
                'link_title' => 'Vue.js官网',
                'link_url' => 'https://cn.vuejs.org/',
                'link_order' => '3',
            ],
            [   'link_name' => 'React.js',
                'link_title' => 'React.js官网',
                'link_url' => 'http://reactjs.cn/react/index.html',
                'link_order' => '4',
            ]
        ];
        DB::table('links')->insert($data);
    }
}
