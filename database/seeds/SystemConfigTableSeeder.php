<?php

use Illuminate\Database\Seeder;

class SystemConfigTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\SystemConfig::create([
            'com_name' => env('COMPANY_NAME', 'xx公司名稱'),
            'com_tel' => '04-8888 8888',
            'com_fax' => '04-2222 8888',
            'com_address' =>  '台中市',
            'sys_contact'=> env('SYSTEM_CONTACT', 'ContactName'),
            'sys_contact_email'=> env('SYSTEM_CONTACT_EMAIL','contact@com'),
            'sys_contact_tel'=> '0912-233917',
            'site_contact_email' => 'fishertsau2live@gmail.com',
            'number_per_page'=> 15,
            'site_contact_email_backup1'=> '',
            'site_contact_email_backup2'=> '' ,
            'seo'=> '',
            'blog_link'=> '',
            'fb_link'=> '',
            'gPlus_link'=> '',
            'logo_filename'=>'' ,
            'page_titleIcon_filename'=> '',
            'icon_filename'=>'' ,
        ]);
    }
}