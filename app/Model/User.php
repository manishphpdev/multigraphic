<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    //
    protected $table = 'user';
    protected $fillable = [
        'name'
    ];


    public static function getUsers()
    {
        $users = User::all();
        return $users;
    }
    


    public function saveUser($data)
    {
        foreach($data as $key => $value)
        {
            $this->$key = $value;
        }
        $this->save();

        return $this->id;
    }

    public function updateUser($data)
    {
        foreach($data as $key => $value)
        {
            $this->$key = $value;
        }
        $this->update();
    }


    public static function deleteUser($id)
    {
        User::where('id',$id)->delete();
    }
}
