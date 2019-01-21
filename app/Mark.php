<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Mark
 *
 * @package App
 * @property string $user
 * @property string $semester
 * @property string $subject
 * @property integer $mark
*/
class Mark extends Model
{
    use SoftDeletes;

    protected $fillable = ['mark', 'user_id', 'semester_id', 'subject_id'];
    protected $hidden = [];
    
    

    /**
     * Set to null if empty
     * @param $input
     */
    public function setUserIdAttribute($input)
    {
        $this->attributes['user_id'] = $input ? $input : null;
    }

    /**
     * Set to null if empty
     * @param $input
     */
    public function setSemesterIdAttribute($input)
    {
        $this->attributes['semester_id'] = $input ? $input : null;
    }

    /**
     * Set to null if empty
     * @param $input
     */
    public function setSubjectIdAttribute($input)
    {
        $this->attributes['subject_id'] = $input ? $input : null;
    }

    /**
     * Set attribute to money format
     * @param $input
     */
    public function setMarkAttribute($input)
    {
        $this->attributes['mark'] = $input ? $input : null;
    }
    
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    
    public function semester()
    {
        return $this->belongsTo(Semester::class, 'semester_id')->withTrashed();
    }
    
    public function subject()
    {
        return $this->belongsTo(Subject::class, 'subject_id')->withTrashed();
    }
    
}
