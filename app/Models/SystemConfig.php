<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class SystemConfig
 * @package App\Models
 */
class SystemConfig extends Model
{
    protected $table = 'system_config';


    protected $fillable = [

        //���q�򥻸��
        'com_name',
        'com_tel',
        'com_fax',
        'com_address',

        //�t�ΰѼ�
        'sys_contact', //�t���p���H
        'sys_contact_email',
        'sys_contact_tel',
        'number_per_page', //�C����ܵ���

        //��P���
        'seo', //����r
        'site_contact_email', //�����p���H WelcomeEmail
        'site_contact_email_backup1', //�����p���H WelcomeEmail
        'site_contact_email_backup2', //�����p���H WelcomeEmail
        'blog_link', //������s��
        'fb_link', //�������s��
        'gPlus_link', //G+�s��

        //���qLogo
        'logo_filename', //���qLogo
        'page_titleIcon_filename', //����icon
        'icon_filename' //����icon
    ];
}
