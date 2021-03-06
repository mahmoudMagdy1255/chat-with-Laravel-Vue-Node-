<?php

namespace App\Http\Controllers\Admin;

use App\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Mail\AdminResetPassword;
use Auth;
use DB;
use Mail;
use Carbon\Carbon;

class AdminAuth extends Controller
{
    

    public function login()
    {
        return view('admin.login' , ['title' => trans('admin.login') , 'site_name' =>trans('admin.site_name') ]);
    }

    public function loginPost(Request $request)
    {
        $this->validate( $request , [
            'email' => 'required|string|email',
            'password' => 'required|string|min:4',
        ] , [] , [
            'email' => trans('admin.email'),
            'password' => trans('admin.password'),
        ]);

        $email = $request->email;
        $password = $request->password;
        $remember = $request->remember ? true : false;

        if( auth()->guard('admin')->attempt(['email' => $email , 'password' => $password] , $remember) ){
            return redirect( aurl('home') );
        }else {
            session()->flash('error' , 'Email or Password Incorrect');
            return redirect( aurl('login') );
        }

    }

    public function home()
    {
        return view('admin.home' , ['title' => '' ]);
    }

    
    public function logout()
    {
        Auth::guard('admin')->logout();

        return redirect( aurl('login') );
    }

   
    public function forget_password()
    {
        return view('admin.forget_password' , ['title' => trans('admin.forget_password') , 'site_name' => trans('admin.site_name') ] );
    }

    public function forget_password_post(Request $request)
    {
        

        $email = $request->email;

        $admin = Admin::where('email' , $email)->first();

        

        if ( !empty($admin) ) {

            $token = app('auth.password.broker')->createToken($admin);

            

            $data = Db::table('password_resets')->insert(['email' => $email , 'token' => $token , 'created_at' =>Carbon::now() ]);

            Mail::to( $email )->send( new AdminResetPassword(['admin' => $admin , 'token' => $token]) );

            session()->flash('success' , trans('admin.the_link_reset_send') );

            return back();

        }else {
            session()->flash('success' , trans('admin.email_no_found') );

            return back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    
    public function reset_password($token)
    {
        

        $data = DB::table('password_resets')->where('token' , $token)->where('created_at' , '>' , Carbon::now()->subHours(2))->first();

        if( !empty($data) )
        {
            return view('admin.reset_password' , ['data' => $data , 'title' => trans('admin.reset_password')]);
        }else {
            
            DB::table('password_resets')->where('token' , $token)->delete();

            session()->flash('error' , trans('admin.token_expired') );

            return redirect( aurl('forget_password') );
        }
    }

    public function reset_password_post(Request $request , $token)
    {
        $data = DB::table('password_resets')->where('token' , $token)->where('created_at' , '>' , Carbon::now()->subHours(2))->first();

        if( !empty($data) )
        {
            $this->validate( $request , [
                'email' => 'required|string|email',
                'password' => 'required|string|min:4',
                'confirmed_password' => 'same:password',
            ] , [] , [
                'email' => trans('admin.email'),
                'password' => trans('admin.password'),
                'confirmed_password' => trans('admin.confirmed_password'),
            ]);

            $array['email'] = $request->email;
            $array['password']  = bcrypt($request->password);

            Admin::where('email' , $array['email'])->update($array);

            DB::table('password_resets')->where('token' , $token)->delete();
            
            session()->flash('success' , trans('admin.password_resets_successfully') );
            return redirect( aurl('login') );
        }else {

            DB::table('password_resets')->where('token' , $token)->delete();

            session()->flash('error' , trans('admin.token_expired') );
            
            return redirect( aurl('forget_password') );
        }

        


    }
}
