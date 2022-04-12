<?php

use App\Models\Post;
use App\Models\PreApprovalRequest;
use App\Models\User;

return [
    'user_mangment' => 'إدارة المستخدمين',
    'user_type' => 'نوع المستخدم',
    'user_types' => [
        User::TYPE_AUTHOR => 'Author',
        User::TYPE_ADMIN => 'Admin',
    ],
    'phone' => 'الهاتف',
    'status' => 'الحالة',
    'statuses' => [
        Post::STATUS_TYPE_PENDING => 'الطلب تحت المراجعة',
        Post::STATUS_TYPE_ACCEPTED => 'تم الموافقة علي الطلب',
        Post::STATUS_TYPE_REJECTED => 'تم رفض الطلب',
    ],
    'status_name' => 'الحالة',
    'active' => 'تفعيل',

    'fields' => [
        'name' => 'الاسم',
        'card_number' => 'رقم بطاقة الاستيراد',
        'company_name' => 'اسم الشركة',
        'email' => 'البريد الإلكتروني',
        'phone' => 'الهاتف',
        'address' => 'العنوان',
        'password' => 'كلمة المرور',
    ],
    'created_at' => 'تاريخ الإنشاء',
    'updated_at' => 'تاريخ اخر تحديث',
];