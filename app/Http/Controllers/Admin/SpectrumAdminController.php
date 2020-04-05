<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Admin;
use Illuminate\Support\Facades\Hash;
use Auth;
use Illuminate\Validation\ValidationException;


class SpectrumAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.dashboard');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // return admin registration page
        return view('admin.register');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //

        $this->validate($request, [
            'name' => 'required|max:100',
            'username' => 'required|max:50|unique:admins',
            'phone' => 'required|numeric|unique:admins',
            'email' => 'required|email|unique:admins',
            'password' => 'required|confirmed|min:6'
        ]);

        $admin = new Admin();
        $admin->name = $request->name;
        $admin->email = $request->email;
        $admin->phone = $request->phone;
        $admin->username = $request->username;
        $admin->password = Hash::make($request->password);
        $admin->remember_token = $request->_token;
        $admin->status = 0;

        // dd($admin);
        if ($admin->save()) {
            $request
                ->session()
                ->flash('success', 'New Admin Profile Created Successfully.');

            return redirect('admin/login');
        } else {
            $request
                ->session()
                ->flash('fail', 'Failure Creating Account. Please try again.');

            return back()->withInput();
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
        //
    }

    public function show_login_page()
    {
        return view('admin.login');
    }

    protected function sendFailedLoginResponse(Request $request)
    {
        throw ValidationException::withMessages([
            'username' => [trans('auth.failed')],
        ]);
    }
    protected function validateLogin(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);
    }

    public function login(Request $request)
    {
        $this->validateLogin($request);

        if(Auth::guard('admin')->attempt($request->only('username','password'),$request->filled('remember'))){

            // dd(Auth::guard('admin')->user()->status);

            if(Auth::guard('admin')->user()->status == 0) {

                return redirect()
                ->back()
                ->withInput()
                ->with('fail','Your account has not been activated yet.!');

            } else {
                $request->session()->regenerate();
                return $this->authenticated($request, Auth::guard('admin')->user())
                ?: redirect('admin/dashboard');
            }

        }

        return $this->sendFailedLoginResponse($request);
    }

    protected function authenticated(Request $request, $user)
    {
        //
    }
}
