<?php

use App\Models\Post;
use App\Models\User;
use App\Models\PreApprovalRequest;


return [
    'user_mangment' => 'User Management',
    'user_type' => 'User Type',
    'user_types' => [
        User::TYPE_AUTHOR => 'Author',
        User::TYPE_ADMIN => 'Admin',
    ],
    'statuses' => [
        Post::STATUS_TYPE_PENDING => ' Pending',
        Post::STATUS_TYPE_ACCEPTED => 'Accepted',
        Post::STATUS_TYPE_REJECTED => ' Rejected',

    ],
    'fields' => [
        'name' => 'Name',
        'card_number' => 'Importer Card Number',
        'company_name' => 'Company Name',
        'email' => 'Email',
        'phone' => 'Phone',
        'address' => 'Address',
        'password' => 'Password',
        'attachments' => 'Attachments',
    ],
    'created_at' => 'Creation Date',
    'updated_at' => 'Update Date',
];
