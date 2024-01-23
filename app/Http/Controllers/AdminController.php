<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Traits\AuthUserTrait;
use App\Traits\FIleUploadTrait;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

/**
 * Controller for handling admins.
 * 
 * @author Hridoy
 */
class AdminController extends Controller
{
    use AuthUserTrait, FIleUploadTrait;

    /**
     * Show Admin List
     * 
     * @param Illuminate\Http\Request $request
     * 
     * @return \Illuminate\View\View|Illuminate\Http\RedirectResponse
     */
    public function index(Request $request): View|RedirectResponse
    {
        try {
            $authUser = $this->AuthUser();
            $sql = User::whereRole('Admin');

            if ($request->search)
                $sql->where(function ($query) use ($request) {
                    $query->orWhere('name', 'LIKE', '%' . $request->search . '%')
                        ->orWhere('phone', 'LIKE', '%' . $request->search . '%')
                        ->orWhere('designation', 'LIKE', '%' . $request->search . '%')
                        ->orWhere('certification', 'LIKE', '%' . $request->search . '%')
                        ->orWhere('nid', 'LIKE', '%' . $request->search . '%')
                        ->orWhere('passport', 'LIKE', '%' . $request->search . '%')
                        ->orWhere('address', 'LIKE', '%' . $request->search . '%');
                });

            $admins = $sql->latest()->get();
            return view('admin.index', compact('admins', 'authUser'));
        } catch (\Exception $e) {
            return redirect('/')->with('error', 'Internal Server Error. ' . $e->getMessage());
        }
    }

    /**
     * Create Admin Form View
     * 
     * @return \Illuminate\View\View|Illuminate\Http\RedirectResponse
     */
    public function create(): View|RedirectResponse
    {
        try {
            return view('admin.create', ['authUser' => $this->AuthUser()]);
        } catch (\Exception $e) {
            return redirect('/')->with('error', 'Internal Server Error. ' . $e->getMessage());
        }
    }

    /**
     * Store Admin
     * 
     * @param Illuminate\Http\Request $request
     * 
     * @return Illuminate\Http\RedirectResponse
     */
    public function store(Request $request) : RedirectResponse
    {
        $validatedData = $request->validate([
            'name'          => 'required|max:255',
            'phone'         => ['required', 'regex:/^(\+88|88)?(01[3-9]\d{8})$/'], // Regex for Bangladeshi phone number
            'password'      => 'required|min:6|max:32',
            'designation'   => 'nullable|max:255',
            'avatar'        => 'sometimes|image|mimes:jpeg,png,jpg,gif|max:2048',
            'certification' => 'nullable|max:255',
            'nid'           => 'nullable|max:20',
            'nid_pdf'       => 'sometimes|mimes:pdf|max:10240',
            'passport'      => 'nullable|max:50',
            'passport_pdf'  => 'sometimes|mimes:pdf|max:10240',
            'address'       => 'nullable|max:255'
        ], [
            'phone.regex'   => 'The phone number must be a valid Bangladeshi phone number.',
        ]);

        try {
            $validatedData = array_merge($validatedData, [
                'role'           => 'Admin',
                'account_status' => 'Active',
                'phone_verified' => 1
            ]);
    
            # Create Admin
            $user = User::create($validatedData);
    
            # Upload avatar.
            if ($request->hasFile('avatar')) $user->avatar = $this->FileUpload($validatedData['avatar'], 'avatar', 'profile');
    
            # Upload NID.
            if ($request->hasFile('nid_pdf')) $user->nid_pdf = $this->FileUpload($validatedData['nid_pdf'], 'nid_pdf', 'profile');
    
            # Upload Passport.
            if ($request->hasFile('passport_pdf')) $user->passport_pdf = $this->FileUpload($validatedData['passport_pdf'], 'passport_pdf', 'profile');
    
            $user->save();
    
            return redirect()->route('admins.index')->with('success', 'Admin created successfully.');
        } catch (\Exception $e) {
            return redirect('/')->with('error', 'Internal Server Error. ' . $e->getMessage());
        }
    }
}