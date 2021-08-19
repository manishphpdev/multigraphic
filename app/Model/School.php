<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class School extends Model
{
    //
    protected $table = 'school_info';
    protected $primaryKey = 'id';
    protected $fillable = [
        'school_name'
    ];


    public static function getSchools()
    {
        $schools = School::all();
        return $schools;
    }



    public function saveSchool($data)
    {
        foreach($data as $key => $value)
        {
            $this->$key = $value;
        }
        $this->save();

        return $this->id;
    }

    public function updateSchool($data)
    {
        foreach($data as $key => $value)
        {
            $this->$key = $value;
        }
        $this->update();
    }


    public static function deleteSchool($id)
    {
        User::where('id',$id)->delete();
    }
}
