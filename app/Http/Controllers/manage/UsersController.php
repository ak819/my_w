<?php

namespace App\Http\Controllers\manage;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Models\User;
use App\Mail\UserLoginInfo;

class UsersController extends Controller
{   
     private $insertedUserId;

        public function __construct()
        {
            $this->insertedUserId="";
        }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {  
      
        $users = User::join('userroles as ur', 'u.roleid', '=', 'ur.ID')
                  ->from('users as u')
                  ->where('roleid','!=',1)
                  ->orderBy("ID",'DESC')
                  ->get(['u.*','ur.Role']);
        if(count($users)>0)
        {
            foreach($users as $val)
            {
               $UserPropertyTypeID=DB::table('useragenttype')->select('PropertyAgentID')->where('UserID',$val->id)->get(); 
               $userAgentTypesID = collect($UserPropertyTypeID)->map(function($x){ return (array) $x; })->toArray(); 
               $val->UserPropertyType=array_column($userAgentTypesID,'PropertyAgentID');

            }

        }
        $propetyTypes=getPropertyAgentTypes();
        $cities=getCities();
        return view('users.list-users',compact('users','propetyTypes','cities'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    { 
        $userRoles=getUserRoles();
        $propetyTypes=getPropertyAgentTypes();
        $cities=getCities();
        return view('users.add-user',compact('userRoles','propetyTypes','cities'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        $useType=$request->input('user_type');
       
        if($useType==2||$useType==3)
        {
            $request->validate([
                'name'=>'required',
                'email'=>'required|email|unique:users',
                'password' => 'required|min:7|max:10',
                'confirm_password' => ['required','min:7','max:10','same:password'],
                'user_type'=>'required',
                'Property_Type'=>'required',
                'cities'=>'required',
                'locations'=>'required'
               ]);  
        }else{
            $request->validate([
                'name'=>'required',
                'email'=>'required|email|unique:users',
                'password' => 'required|min:7|max:10',
                'confirm_password' => ['required','min:7','max:10','same:password'],
                'user_type'=>'required'
               ]);  

        }
        $PropertyTypes=$request->input('Property_Type');
        $userData=[
        'guid'=>(string) Str::uuid(),
        'name'=>$request->input('name'),
        'mobile'=>$request->input('mobileno'),
        'email'=>$request->input('email'),
        'password'=>Hash::make($request->input('password')),
        'roleid'=>$request->input('user_type'),
        'created_at'=>date('Y-m-d H:i:s'),
        'IsEnable'=>1
        ];
        $UserPassword=$request->input('password');
        $Cities=$request->input('cities');
        $Locations=$request->input('locations');
        DB::transaction(function() use ($userData,$UserPassword,$PropertyTypes,$Cities,$Locations) {
            $this->insertedUserId=DB::table('users')->insertGetId($userData);
            if($PropertyTypes)
            {
                foreach($PropertyTypes as $val)
                {
                    $data=['Guid'=>(string) Str::uuid(),'PropertyAgentID'=>$val,'UserID'=>$this->insertedUserId,'CreatedBy'=>Auth::user()->id,'IsEnable'=>1];
                    $QuestionID=DB::table('useragenttype')->insertGetId($data);
                }
            }
            if($Cities)
            {
                foreach($Cities as $val)
                {
                    $data=['Guid'=>(string) Str::uuid(),'CityID'=>$val,'UserID'=>$this->insertedUserId,'CreatedBy'=>Auth::user()->id,'IsEnable'=>1];
                    DB::table('usercities')->insertGetId($data);
                }
            }
            if($Locations)
            {
                foreach($Locations as $val)
                {
                    $data=['Guid'=>(string) Str::uuid(),'CommunityID'=>$val,'UserID'=>$this->insertedUserId,'CreatedBy'=>Auth::user()->id,'IsEnable'=>1];
                    DB::table('userlocations')->insertGetId($data);
                }


            }
           
        });
        
        $Maildata=['name'=>$userData['name'],
        'email'=>$userData['email'],
        'password'=>$UserPassword
        ];
      
        Mail::to($userData['email'],'Team Homes')->send(new UserLoginInfo($Maildata));
            if($this->insertedUserId && !Mail::failures())
            {
                return redirect()->route('users.index')
                ->with('success','The user has been added successfully .');
            }
            else if($this->insertedUserId && Mail::failures()) {

                return redirect()->route('users.index')
                      ->with('error','The user has been added successfully but there was error sending mail');
            }else{

                return redirect()->route('users.index')
                ->with('success','An error occured while saving user.');
            }
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
       
        $user=DB::table('users')->where("guid", $id)->first();
        $propetyTypes=getPropertyAgentTypes();
        $userRoles=getUserRoles();
        $cities=getCities();
        if($user)
        {
         $userAgentTypesResult=DB::table('useragenttype')->select('PropertyAgentID')->where("UserID", $user->id)->get();
         $userAgentTypes = collect($userAgentTypesResult)->map(function($x){ return (array) $x; })->toArray(); 
         $userCitiesResult=DB::table('usercities')->select('CityID')->where("UserID", $user->id)->get();
         $userCities = collect($userCitiesResult)->map(function($x){ return (array) $x; })->toArray(); 
         $userLocationsResult=DB::table('userlocations')->select('CommunityID')->where("UserID", $user->id)->get();
         $userLocations = collect($userLocationsResult)->map(function($x){ return (array) $x; })->toArray();
         return view('users.edit-user',compact('user','userAgentTypes','propetyTypes','userRoles','cities','userCities','userLocations'));
        }else{
            return redirect()->route('users.index')
            ->with('success','An error occured no data found.');

        }
      
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
       $user=DB::table('users')->where("guid", $id)->first();
        $useType=$request->input('user_type');
       
        if($useType==2||$useType==3)
        { 
            if($user->email == $request->input('email'))
            {
                $request->validate([
                    'name'=>'required',
                    'email'=>'required|email',
                    'user_type'=>'required',
                    'Property_Type'=>'required',
                    'cities'=>'required',
                    'locations'=>'required',
                   ]);  

            }else{
                $request->validate([
                    'name'=>'required',
                    'email'=>'required|email|unique:users',
                    'user_type'=>'required',
                    'Property_Type'=>'required',
                    'cities'=>'required',
                    'locations'=>'required',
                   ]);  

            }
          
        }else{
            if($user->email == $request->input('email'))
            {
                $request->validate([
                    'name'=>'required',
                    'email'=>'required|email',
                    'user_type'=>'required'
                   ]); 
            }else{
                $request->validate([
                    'name'=>'required',
                    'email'=>'required|email|unique:users',
                    'user_type'=>'required'
                   ]); 
            }

        }

        $PropertyTypes=$request->input('Property_Type');
        $Cities=$request->input('cities');
        $Locations=$request->input('locations');
        $userData=[
        'name'=>$request->input('name'),
        'mobile'=>$request->input('mobileno'),
        'email'=>$request->input('email'),
        'roleid'=>$request->input('user_type'),
        'IsEnable'=>($request->input('IsEnable')) ? 1 : 0
        ];
            
        DB::transaction(function() use ($user,$userData,$PropertyTypes,$Cities,$Locations) {

            DB::table('users')->where('ID',$user->id)->update($userData);
            DB::table('useragenttype')->where('UserID', $user->id)->delete();
            DB::table('usercities')->where('UserID', $user->id)->delete();
            DB::table('userlocations')->where('UserID', $user->id)->delete();
            if($PropertyTypes)
            {
                foreach($PropertyTypes as $val)
                {
                    $data=['Guid'=>(string) Str::uuid(),'PropertyAgentID'=>$val,'UserID'=>$user->id,'CreatedBy'=>Auth::user()->id,'IsEnable'=>1];
                    DB::table('useragenttype')->insertGetId($data);
                }
            }
            if($Cities)
            {
                foreach($Cities as $val)
                {
                    $data=['Guid'=>(string) Str::uuid(),'CityID'=>$val,'UserID'=>$user->id,'CreatedBy'=>Auth::user()->id,'IsEnable'=>1];
                    DB::table('usercities')->insertGetId($data);
                }
            }
            if($Locations)
            {
                foreach($Locations as $val)
                {
                    $data=['Guid'=>(string) Str::uuid(),'CommunityID'=>$val,'UserID'=>$user->id,'CreatedBy'=>Auth::user()->id,'IsEnable'=>1];
                    DB::table('userlocations')->insertGetId($data);
                }
            }
           
        });
        return redirect()->route('users.edit', $id)->withInput()->with('success', 'User has been editted successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user=DB::table('users')->where("guid", $id)->first();
        if($user)
        { 
            DB::transaction(function() use ($user) {

                DB::table('users')->where('ID',$user->id)->delete();
                DB::table('useragenttype')->where('UserID', $user->id)->delete();
               
            });
          
            return redirect()->route('users.index')
            ->with('success','User has been deleted successfully.');

        }else{
            return redirect()->route('users.index')
            ->with('error','An error occured no data found.');

        }
    }

    public function changeUserPassword($id)
    {
      $user=DB::table('users')->where("guid", $id)->first();
      return view('users.changepassword',compact('user'));
    }

    public function updateUserPassword(Request $request)
    {

        $request->validate([
            'new_password' => ['required','min:7','max:10'],
            'confirm_password' => ['required','same:new_password'],
        ]);

        $userid=$request->userid;
        $user=DB::table('users')->where("guid", $userid)->first();
        DB::table('users')->where("guid", $userid)->update(['password'=> Hash::make($request->new_password)]);
        
        $Maildata=['name'=>$user->name,
        'email'=>$user->email,
        'password'=>$request->new_password
        ];
      
        Mail::to($Maildata['email'],'Team Homes')->send(new UserLoginInfo($Maildata));
            if(!Mail::failures())
            {
                return redirect()->route('users.index')
                ->with('success','Password change successfully.');
            }
            else if(Mail::failures()){

                return redirect()->route('users.index')
                      ->with('error','Password change successfully but there was error sending mail');
            }else{

                return redirect()->back()->with('error','An error occured while saving password.');
            }
      
    }
    
}
