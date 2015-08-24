<?php
use Illuminate\Support\MessageBag;
class UserController extends BaseController {
  
	/*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@showWelcome');
	|
	*/  
public function __construct()
    {
        //this is a method of BaseController, if I comment out the line, it works fine
        //$this->getDays();
    }

public function view(){
	return View::make('user/login');
}
//create the view for register page
public function register(){
  return View::make('user/register');
}
public function registerForm(){

  $fname = Input::get('fname');
  $lname =  Input::get('lname');
  $email = Input::get('email');
  $company = Input::get('company');
  $phone = Input::get('phone');
  
  

  $data = array(
      "fname" => $fname,
      "lname" => $lname,
      "email" => $email,
      "company" => $company,
      "phone" => $phone
     
  );
  $user = User::where('user_access','=','Admin')->get();
    $userTo = array();
      foreach ($user as $key => $value) {
          $userTo[] = $value->email;
      }



  Mail::send('emails.newUserRequest', $data, function($message) use ($userTo){
    $message->to($userTo);
    $message->subject('Hi, someone you may know has applied for user access');
  });
  //return $password;
  return Redirect::to('/login');
}

public function loginForm() {
    $errors = new MessageBag();
    if ($old = Input::old("errors")) {
      $errors = $old;
   }
    $data = ["errors" => $errors];
    if (Input::server("REQUEST_METHOD") == "POST") {
      $validator = Validator::make(Input::all(), ["email" => "required", "password" => "required"]);
      if ($validator->passes()) {
        $credentials = ["email" => Input::get("email"), "password" => Input::get("password")];
        if (Auth::attempt($credentials)) {
           $user = Auth::user();
        
          //keen data is what object of json we will encode to keen
          //keen event is the name of the event type we will track
          $keenEvent = "login";
          $keenData = $user;
          $this->keenCurl($keenData,$keenEvent);
          
           //$beacons = Beacon::where('companyID','=',$user->companyID)->get();
          return Redirect::to("/dashboard");
        }
      }
      $data["errors"] = new MessageBag(["password" => ["Email and/or password invalid."]]);
      $data["email"] = Input::get("email");
      return Redirect::to("/login")->withInput($data);
    }
     return Redirect::to("/login");
  }

//handle add user/company from form.
public function autoAddUser($fname,$lname,$email,$company){
      $company = new Company;
      $company->name = Input::get('company');
      $company->save();
      $companyID = $company->_id;

      //check user accounts


      $newUser = new User;
      $newUser->fname = $fname;
      $newUser->lname = $lname;
      $newUser->email = $email;
      $newUser->user_access = "Staff";
      $newUser->companyID = $companyID;
    
   

  
  //return $response;
      $length = 8;
      $password = "";
        // define possible characters
        $possible = "0123456789abcdfghjkmnpqrstvwxyz";
        $i = 0;
        // add random characters to $password until $length is reached
        while ($i < $length) {
          // pick a random character from the possible ones
          $char = substr($possible, mt_rand(0, strlen($possible)-1), 1);
          // we don't want this character if it's already in the password
          if (!strstr($password, $char)) {
            $password .= $char;
            $i++;
          }
       }
      $data = array(
        "company" => $company->name,
        "access" => $newUser->user_access,
        "email" => $email,
        "fname" => $newUser->fname,
        "lname" => $newUser->lname,
        "tempPass" => $password

      );
      $userData = array(
        "email" => $email,
        "fname" => $newUser->fname
      );

      $newUser->password = Hash::make($password);
      $newUser->save();

      Mail::send('emails.requestedUser', $data, function($message) use($userData){
          $message->to($userData['email'], "candidate")->subject('Hi '.$userData['fname'].', you have been granted user access');
      });

      return Redirect::to('/dashboard');
  }
  public function updateCompany(){
      $user = Auth::user();
      $company = Company::where('_id','=',$user->companyID)->get()->first();
      $company->setImage = Input::get('image');
      $company->save();
      return Redirect::to('/profile');
  }

  public function importCompany(){
     
      $email = Input::get("email");
      $company = new Company;
      $company->name =Input::get("company");
      $company->save();

       //get the location data on creation
     
      
    

      $newUser = new User;
      $newUser->fname = Input::get("fname");
      $newUser->lname =Input::get("lname");
      $newUser->email = Input::get("email");
      $newUser->user_access = "Staff";
      $newUser->companyID = $company->_id;
     

      $length = 8;
      $password = "";
        // define possible characters
        $possible = "0123456789abcdfghjkmnpqrstvwxyz";
        $i = 0;
        // add random characters to $password until $length is reached
        while ($i < $length) {
          // pick a random character from the possible ones
          $char = substr($possible, mt_rand(0, strlen($possible)-1), 1);
          // we don't want this character if it's already in the password
          if (!strstr($password, $char)) {
            $password .= $char;
            $i++;
          }
       }
      $data = array(
        "company" => $company->name,
        "access" => $newUser->user_access,
        "email" => $email,
        "fname" => $newUser->fname,
        "lname" => $newUser->lname,
        "tempPass" => $password

      );
      $userData = array(
        "email" => $email,
        "fname" => $newUser->fname
      );

      $newUser->password = Hash::make($password);
      $newUser->save();

      Mail::send('emails.requestedUser', $data, function($message) use($userData){
          $message->to($userData['email'], "candidate")->subject('Hi '.$userData['fname'].', you have been granted user access');
      });

      return Redirect::to('/dashboard');
  }

  public function logoutAction() {
    $user = Auth::user();
    Auth::logout();
    return Redirect::to("/login");
  }
  //view for profile
  public function profileView() {

    $user = Auth::user();
    $company = Company::where("_id","=",$user->companyID)->get()->first();
    $location = Location::where('branchID','=',$user->locationID)->get()->first();
    return View::make("user/profile")->with('company',$company)->with('location',$location);
  }
   public function updateProfile() {
    $user = Auth::user();
    $oldpassword = Input::get('oldpassword');
    $password = Input::get('password');
    $password2 = Input::get('password2');
    $check = Hash::check($oldpassword, $user->password);

    if($check == true){
         $user->password = Hash::make($password);
         $user->save();
        return Redirect::to("profile");
    }
    return "no password match";
      exit;
 
  }

  public function forgotPassword(){
    $id=0;
    $myUser = User::where('email','=',Input::get("email"))->get();
  
    foreach ($myUser as $key => $value) {
      $id    = $value->_id;
      $fname = $value->fname;
      $lname = $value->lname;
      $email = $value->email;
    }
    if( $id==0 ){
      return View::make( 'user/login',array('ttl' => 'Error' , 'msg' => 'user not found' , 'mail' => Input::get("email") ) );
//      return View::make('pwreset/error',array('error' => 'user not found<br/>'));
    }else{
      $code=md5(rand(10000,99999).$id);
      $expDate=date("Y-m-d",strtotime('+1 week'));
      $myCount = ResetUser::where('user_id','=',$id)->count();
      if($myCount==0){
            $resetUser = new ResetUser;
            $resetUser->user_id  = $id;
            $resetUser->code     = $code;
            $resetUser->exp_date = $expDate;
            $resetUser->save();
      }else{
        $myUser = ResetUser::where('user_id','=',$id)->update(array('code'=>$code , "exp_date"=>$expDate));
      }
      $data = array(
        "fname"   => $fname,
        "lname"   => $lname,
        "expDate" => $expDate,
        "code"    => $code
      );
      $userData = array(
        "email" => $email,
        "fname" => $lname.','.$fname
      );
      Mail::send('emails.passwordReset', $data, function($message) use($userData){
        $message->to($userData['email'], "candidate")->subject('Hi '.$userData['fname'].', have you forgotten your password?');
      });
//      return View::make('pwreset/reset',array('user' => $userData));
      return View::make( 'user/login',array('ttl' => 'Response' , 'user' => $userData) );
    }
//    return Redirect::to("/resetpassword");
  }
//---------------------------------------------------------------------
  public function resetPassword($code){
    try{
      $id=0;
      $code=( trim($code)=='' )?'0':trim($code);
      $myResetObj = ResetUser::where('code','=',$code)->get();
      foreach ($myResetObj as $key => $value) {
        $id       = $value->user_id;
        $exp_date = $value->exp_date;
      }
      if($id==0){
        $pageData=array(
          'msg' => "Sorry! The code is invalid."
        );
      }else{
        $exDate=strtotime($exp_date);
        if( $exDate<time() ){
          $pageData=array( 'msg' => "This code has been expired." );
        }else{
          $myUser = User::where('_id','=',$id)->get();
          $pageData=array();
          foreach ($myUser as $key => $value) {
            $pageData['_id'  ] = $value->_id;
            $pageData['fName'] = $value->fname;
            $pageData['lName'] = $value->lname;
            $pageData['eMail'] = $value->email;
          }
        }
      }
      return View::make('pwreset/reset',$pageData);
    }catch(Exception $e){
      $pageData=array(
        'msg' => "Sorry! The code is invalid."
      );
      return View::make('pwreset/reset',$pageData);
    }
  }
//---------------------------------------------------------------------
  public function doResetPassword(){
    $user_id=Input::get("user_id");
    $user_ps=Input::get("password");
    $user_ps=Hash::make($user_ps);

    $myUser = User::where('_id','=',$user_id)->update(array('password'=>$user_ps));
    if($myUser!=0){
      ResetUser::where('user_id','=',$user_id)->delete();
    }
//
    return View::make('pwreset/reset',array('msg'=>'Your new password has been set'));
  }


}
