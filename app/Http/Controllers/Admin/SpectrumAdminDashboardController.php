<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Admin;
use Auth;
class SpectrumAdminDashboardController extends Controller
{


    /**
     * Only guests for "admin" guard are allowed except
     * for logout.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth.custom');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.dashboard');
    }

    
    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect()
            ->route('admin.login')
            ->with('success', 'Admin has been logged out!');
    }

    public function show_access_keys()
    {
        return view('admin.show-access-keys');
    }

    public function audit_logs()
    {
        return view('admin.audit-logs');
    }
}
