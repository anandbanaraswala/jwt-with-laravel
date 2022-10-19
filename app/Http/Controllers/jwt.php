<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\users_model;
use App\Models\courses_model;
use Illuminate\Support\Facades\Validator;

class jwt extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'name' => 'required|min:1|max:150',
            'email' => 'required|min:1|max:150|email',
            'phone' => 'required|min:1|max:15',
            'password' => 'required'
        ]);

        if($validator->fails())
        {
            return response()->json([
                'messages' => 'All input field are required'
            ],500);
        }

        else
        {
            try
            {
                $user_register = new users_model(); // this is midel class name
                $user_register->name = $request->name;
                $user_register->email = $request->email;
                $user_register->phone = $request->phone;
                $user_register->password = bcrypt($request->password);
                $user_register->save();
                return response(array("message"=>"Success !"),200)->header("Content-Type","application/json");
            }

            catch(\Exception $e)
            {
                return response(array("message"=>"Duplicate Entry"),409)->header("Content-Type","application/json");
            }
        }
    }

    public function course_insert(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'user_id' => 'required',
            'title' => 'required|min:1',
            'description' => 'required|min:1',
            'total_videos' => 'required|min:1'
        ]);

        if($validator->fails())
        {
            return response()->json([
                'messages' => 'All input fields are required'
            ],500);
        }

        else
        {
            try
            {
                $user_course_insert = new courses_model(); // this is model class name
                $user_course_insert->user_id = $request->user_id;
                $user_course_insert->title = $request->title;
                $user_course_insert->description = $request->description;
                $user_course_insert->total_videos = $request->total_videos;
                $user_course_insert->save();
                return response(array("message"=>"Success !"),200)->header("Content-Type","application/json");
            }

            catch(\Exception $e)
            {
                return response(array("message"=>"Duplicate Entry"),409)->header("Content-Type","application/json");
            }
        }
    }

    public function get_users()
    {
        $user_data = auth()->user();
        return response()->json([
            "status" => 1,
            "message" => "User profile data",
            "data" => $user_data
        ]);
    }

    public function get_courses()
    {
        $fetch_data = courses_model::all();
        return $fetch_data;
    }

    public function delete_courses($id)
    {
        $delete_courses = courses_model::find($id);
        $delete_courses->delete();
        return response(array("message"=>"Delete Success !"),200)->header("Content-Type","application/json");
    }

    public function login(Request $request)
    {
        $request->validate([
            "email" => "required|email",
            "password" => "required"
        ]);

        if(!$token = auth()->attempt(["email" => $request->email, "password" => $request->password]))
        {
            return response()->json([
                "status" => 0,
                "message" => "Invalid credentials"
            ]);
        }

        return response()->json([
            "status" => 1,
            "message" => "Logged in successfully",
            "access_token" => $token
        ]);
    }

    // USER LOGOUT API - GET
    public function logout()
    {
        auth()->logout();
        return response()->json([
            "status" => 1,
            "message" => "User logged out"
        ]);
    }
}
