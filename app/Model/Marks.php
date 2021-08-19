<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Marks extends Model
{
    //
    protected $table = 'marks';
    protected $primaryKey = 'id';
    protected $fillable = [
        'user_id','school_id'
    ];


    public static function getMarks()
    {
        $marks = Marks::all();
        return $marks;
    }



    public function saveMarks($data)
    {
        foreach($data as $key => $value)
        {
            $this->$key = $value;
        }
        $this->save();

        return $this->id;
    }
}
