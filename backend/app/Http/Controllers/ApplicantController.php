<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\User_profile;
use App\Models\Applicant_data;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class ApplicantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        
        $user = $request->id;
        if($request->id){
            $users = User_profile::
            join('applicant_datas', 'applicant_datas.user_id', '=', 'user_profiles.id')
            ->join('job_vacancies', 'job_vacancies.id', '=', 'applicant_datas.position_applied')
            ->where('user_id','=',$user)
            ->get(); 
        }else{
            $users = User_profile::
            join('applicant_datas', 'applicant_datas.user_id', '=', 'user_profiles.id')
            ->join('job_vacancies', 'job_vacancies.id', '=', 'applicant_datas.position_applied')
            ->where('applicant_datas.status','!=',2)
            ->where('applicant_datas.status','!=',3)
            ->get();    
        }


        $data = [
            'response_time' => LARAVEL_START,
            'count' => count($users),
            'data' => $users,
        ];

        return response()->json($data);
    }
    
    public function user(Request $request){

        //return $request->user()->id;
        return Applicant_data::where('user_id',$request->user()->id)->get();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


        $validated_user = $request->validate([
            'username' => 'unique:users,username|required|max:60',
            'password' => 'required|confirmed|max:60',
            'password_confirmation' => 'required',
            'fname' => 'required|max:60',
            'mname' => 'nullable|max:60',
            'lname' => 'required|max:60',
            'age' => 'required|integer',
            'address' => 'required',
            'gender' => 'required|max:1',
            'birthday' => 'required',
            'email' => 'required|email|max:60',
            'mobile_number' => 'required|numeric',
        ]);


        $merge_data = array();

        $request_user = User::create([
            'username' => $validated_user['username'],
            'password' => Hash::make($validated_user['password']),
        ]);

        $user_id = $request_user->id;
    
        $request_profile = User_profile::create([
            'id' => $user_id,
            'fname' => $validated_user['fname'],
            'mname' => $validated_user['mname'],
            'lname' => $validated_user['lname'],
            'age' => $validated_user['age'],
            'gender' => $validated_user['gender'],
            'birthday' => $validated_user['birthday'],
            'address' => $validated_user['address'],
            'mobile_number' => $validated_user['mobile_number'],
            'email' => $validated_user['email'],
        ]);


        $request_applicant = Applicant_data::create([
            'user_id' => $request_profile->id,
        ]);

        $merge_data = [
            'user' => $request_user,
            'user_profile' => $request_profile,
            'applicant_data' => $request_applicant
        ];

        $data = [
            'data' => $merge_data,
            'message' => 'User Created Successfully!'
        ];

        return response()->json($data);
        

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

    }

    public function applicantDetails(Request $request)
    {

        $user_id = $request->user()->id;

        $validated_request = $request->validate([
            'position' => 'required',
            'about_self' => 'required',
            'resume_file' => 'required',
        ]);

        if(isset($_FILES['resume_file']['name'])){
            
            /* Getting file name */
            $filename = $_FILES['resume_file']['name'];

            /* Location */
            $location = "upload/resume/".$filename;
            $imageFileType = pathinfo($location,PATHINFO_EXTENSION);
            $imageFileType = strtolower($imageFileType);
         
            /* Valid extensions */
            $valid_extensions = array("pdf");
         
            $response = 0;
            /* Check file extension */
            if(in_array(strtolower($imageFileType), $valid_extensions)) {
               /* Upload file */
               if(move_uploaded_file($_FILES['resume_file']['tmp_name'],$location)){
                $user = $request->user()->id;
                //$qry = Applicant_data::where('user_id',$user)->update(['resume_link'=>$filename]);
                  $response = $location;
               }
            }
            

            $qry = Applicant_data::where('user_id',$user_id)->update([
                'position_applied' => $validated_request['position'],
                'about_self' => $validated_request['about_self'],
                'resume_link' => $filename
            ]);

            /*$qry = Applicant_data::create(
                [
                    'user_id' => $user_id,
                    'position_applied' => $validated_request['position'],
                    'about_self' => $validated_request['about_self'],
                    'resume_link' => $filename
                ]
            );*/
    

        if($qry){
            $data = [
                'data' => $request,
                'message' => 'Application details created successfully!'
            ];
    
            return response()->json($data);
        }
            
        }


    }
}
