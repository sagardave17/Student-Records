<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Semester
 *
 * @package App
 * @property string $name
*/
class Semester extends Model
{
    use SoftDeletes;

    protected $fillable = ['name'];
    protected $hidden = [];



}
