<?php

namespace Responsive\Http\Controllers\Auth;

use Responsive\Http\Controllers\Controller;

use Illuminate\Foundation\Auth\AuthenticatesUsers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

use Socialite;
use Responsive\User;
use Auth;
use Illuminate\Support\Facades\Validator;
use Input;
use Redirect;


class LoginController extends Controller
{
/*
|--------------------------------------------------------------------------
| Login Controller
|--------------------------------------------------------------------------
|
| This controller handles authenticating users for the application and
| redirecting them to your home screen. The controller uses a trait
| to conveniently provide its functionality to your applications.
|
*/

use AuthenticatesUsers;


protected function authenticated(Request $request, $user)
{
if(auth()->check() && auth()->user()->id == 1){
            
			return redirect('/admin');
        }
		else
		{
			return redirect('/dashboard');
		}

        
}

/********* SOCIAL LOGIN ********/
public function redirectToProvider($provider)
{
       return Socialite::driver($provider)->scopes(['email'])->redirect(); 
         /*return Socialite::driver('google')->scopes(['profile','email'])->redirect();*/
}


public function clean($string) 
	{
    
     $string = preg_replace("/[^\p{L}\/_|+ -]/ui","",$string);

    
    $string = preg_replace("/[\/_|+ -]+/", '-', $string);

    
    $string =  trim($string,'-');

    return mb_strtolower($string);
	}  
   
   
 public function handleProviderCallback($provider)
    {
        $user = Socialite::driver($provider)->user();
        $authUser = $this->findOrCreateUser($user, $provider);
        Auth::login($authUser, true);
        /*return redirect($this->redirectToProvider);*/
       /* return redirect()->action('IndexController@index');*/
       return redirect('dashboard');

    }
	
	
	
	
	
 public function findOrCreateUser($user, $provider)
    {
        $authUser = User::where('provider_id', $user->id)->first();
        if ($authUser) {
            return $authUser;
        }
        return User::create([
            'name'     => $user->name,
			'post_slug' => $this->clean($user->name),
            'email'    => $user->email,
			'admin' => 2,
            'provider' => $provider,
            'provider_id' => $user->id
        ]);
    }	

/**************** SOCIAL LOGIN **********/




public function username()
{
    return 'username';
}


protected function credentials(Request $request)
{
    $usernameInput = trim($request->{$this->username()});
    $usernameColumn = filter_var($usernameInput, FILTER_VALIDATE_EMAIL) ? 'email' : 'name';

    return [$usernameColumn => $usernameInput, 'password' => $request->password];
	
	/* return [$usernameColumn => $usernameInput, 'password' => $request->password, 'active' => 1]; */
}




protected function login(Request $request)
{
	
	
	
	
	
	
	
	
	$validator = Validator::make($request->all(), [
            'username' => 'required|max:255',
            'password' => 'required',
			
			
			
			
        ]);

        $input = $request->all();
		 
        
   if ($validator->passes()) 
   {
	
		   
		   $auth = false;
    
	
	
		$usernameInput = trim(Input::get('username'));
		$usernameColumn = filter_var($usernameInput, FILTER_VALIDATE_EMAIL) ? 'email' : 'name';

		if (Auth::attempt(array($usernameColumn => $usernameInput, 'password' => Input::get('password') ))) 
		{
			$auth = true; // Success
			
			$editprofile = DB::table('users')
		               ->where('id', '=', auth()->user()->id)
	                   ->get();
    
		   if (auth()->user()->confirmation == 0 && auth()->user()->admin!=1) 
		   {
            auth()->logout();
			
			return back()->with('get_error', $editprofile[0]->email);

            
           } 
		   else
           {
		       if(Auth::user()->admin == 1)
				{
					
					return redirect('/admin');
					
				}
                else
				{					
				return redirect('/dashboard');
				}
					
				
		   }		
				
				
		}
		
		else
		{
			   
			   return back()->with('error', 'Invalid Login Details');
		}
		
		   
		
		}
		else
		{
			return back()->with('error', 'Invalid Login Details');
		}
		
		
		

        
}








 protected function sendFailedLoginResponse(Request $request)
    {
        $errors = [$this->username() => trans('auth.failed')];
        // Load user from database
        $user = DB::table('users')
				->where('name', $request->{$this->username()})->first();
        
        if ($user && \Hash::check($request->password, $user->password) && $user->admin != 1) {
            $errors = [$this->username() => 'Your account is not active.'];
        }
        if ($request->expectsJson()) {
            return response()->json($errors, 422);
        }
        /*return redirect()->back()
            ->withInput($request->only($this->username(), 'remember'))
            ->withErrors($errors);*/
			return back()->with('error', 'Invalid login details');
    }



/**
 * Where to redirect users after login.
 *
 * @var string
 */
//protected $redirectTo = '/admin';

/**
 * Create a new controller instance.
 *
 * @return void
 */
public function __construct()
{
    $this->middleware('guest', ['except' => 'logout']);
}
}


