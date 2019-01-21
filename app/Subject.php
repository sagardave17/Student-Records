<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Subject
 *
 * @package App
 * @property string $name
 * @property string $semester
*/
class Subject extends Model
{
    use SoftDeletes;

    protected $fillable = ['name', 'semester_id'];
    protected $hidden = [];
    
    

    /**
     * Set to null if empty
     * @param $input
     */
    public function setSemesterIdAttribute($input)
    {
        $this->attributes['semester_id'] = $input ? $input : null;
    }
    
    public function semester()
    {
        return $this->belongsTo(Semester::class, 'semester_id')->withTrashed();
    }
    
}
