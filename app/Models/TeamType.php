<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeamType extends Model
{
    use HasFactory;

    public static $array_type = [
        'marketing' => 'Marketing',
        'business_crm' => 'Kinh doanh CRM',
        'small_business' => 'Doanh nghiệp nhỏ',
        'executive' => 'Điều hành',
        'engineering_it' => 'Kỹ thuật-CNTT',
        'human_resources' => 'Nhân sự',
        'other' => 'Khác',
    ];
}
