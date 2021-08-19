<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\User;
use App\Model\School;
use App\Model\Marks;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    

    public function index(Request $request)
    {
        $max_marks  = DB::table('marks')->max('marks');
        $min_marks  = DB::table('marks')->min('marks');
        $avg_marks  = DB::table('marks')->avg('marks');
        $user_data = DB::table('user')
            ->join('marks', 'user.id', '=', 'marks.user_id')
            ->join('school_info', 'school_info.id', '=', 'marks.school_id')
            ->select('user.id','user.name', 'marks.marks', 'school_info.school_name')
            ->get();
        $marks_data = [
            'max' => $max_marks,
            'min' => $min_marks,
            'avg' => $avg_marks
        ];
        return view('index')
        ->with('users',$user_data)
        ->with('marks',$marks_data);
    }


    public function add(Request $request)
    {
        try{
            if(empty($_POST))
            {
                $school_obj = new School();
                $all_schools = $school_obj->getSchools();
                return view('add')->with('schools',$all_schools);
            }
            else
            {
                $validator = Validator::make($request->all(), [
                    'name'     => 'required|max:255',
                    'school_name'    => 'required|max:255',
                    'marks'    => 'required|integer|gte:0|lte:100',
                ]
                );
                if($validator->fails())
                {
                    $error = '';
                    $count = 1;
                    $errorArr = json_decode($validator->getMessageBag());
                    foreach ($errorArr as $key=>$val)
                    {
                        if(is_array($val))
                        {
                            foreach($val as $v)
                            {
                                $error = $error.strval($count).'. '.$v.PHP_EOL;
                                $count++;
                            }
                            
                        }else{
                            $error = $error.strval($count).'. '.$val[0].PHP_EOL;
                            $count++;
                        }
                        
                        
                    }
                    $request->session()->flash('error', $error);
                    return Redirect::to(route("add"))->withInput();
                }
                $user_data = [
                    "name"          => $request->get("name")
                ];
                $user_obj = new User();
                $user_id = $user_obj->saveUser($user_data);

                if($user_id)
                {
                    $marks_data = [
                        "user_id" => $user_id,
                        "school_id" => $request->get("school_name"),
                        "marks"     => $request->get("marks")
                    ];
                    $marks = new Marks();
                    $user_id = $marks->saveMarks($marks_data);
                
                }

                $request->session()->flash('message', "New USer Added Successfully");
                return Redirect::to(route("index"));
            }

        }catch(\Exception $e){
            $request->session()->flash('error', ["Something Went Wrong"]);
            return Redirect::to(route("add"))->withInput();
        }
        
    }

    public function add_school(Request $request)
    {
        try{
            if(empty($_POST))
            {
                return view('add_school');
            }
            else
            {
                $validator = Validator::make($request->all(), [
                    'school_name'     => 'required|max:255'
                ]
                );
                if($validator->fails())
                {
                    $error = '';
                    $count = 1;
                    $errorArr = json_decode($validator->getMessageBag());
                    foreach ($errorArr as $key=>$val)
                    {
                        if(is_array($val))
                        {
                            foreach($val as $v)
                            {
                                $error = $error.strval($count).'. '.$v.PHP_EOL;
                                $count++;
                            }
                            
                        }else{
                            $error = $error.strval($count).'. '.$val[0].PHP_EOL;
                            $count++;
                        }
                        
                        
                    }
                    $request->session()->flash('error', $error);
                    return Redirect::to(route("add_school"))->withInput();
                }
                $school_data = [
                    "school_name"          => $request->get("school_name")
                ];

                $obj  = new School();
                $school_id = $obj->saveSchool($school_data);
                print_r($school_id);

                $request->session()->flash('message', "New School Added Successfully");
                return Redirect::to(route("index"));
            }

        }catch(\Exception $e){
            $request->session()->flash('error', ["Something Went Wrong"]);
            return Redirect::to(route("add_school"))->withInput();
        }
        
    }

    public function edit(Request $request)
    {
        return view('edit');
    }
}
