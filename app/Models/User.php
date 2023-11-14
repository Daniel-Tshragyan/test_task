<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * This is the model class for table "plans".
 *
 * @property int $id
 * @property string $first_name
 * @property string $last_name
 * @property string $email
 * @property int $age

 */

class User extends Model
{
    use HasFactory;

    protected $fillable = ['first_name', 'last_name','email','age',];

}
