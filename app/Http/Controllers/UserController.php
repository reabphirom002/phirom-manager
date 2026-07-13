<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        if (!in_array(auth()->user()->role, ['admin', 'owner'])) {
            abort(403);
        }

        $users = User::where('id', '!=', auth()->id())->latest()->get();

        // បញ្ជីសិទ្ធិប្រើប្រាស់ជាក់ស្ដែងសម្រាប់ប្រព័ន្ធ PHIROM MANAGER
        $permissions = [
            'view_dashboard' => 'View Dashboard (មើលផ្ទាំងគ្រប់គ្រង)',
            'manage_lessons' => 'Manage Lessons (គ្រប់គ្រងឯកសារ និងមេរៀន)',
            'manage_school' => 'Manage School (គ្រប់គ្រងសិស្ស ថ្នាក់ និងវគ្គសិក្សា)',
            'manage_products' => 'Manage PC Shop Stock (គ្រប់គ្រងឃ្លាំងស្តុកកុំព្យូទ័រ)',
            'manage_beverages' => 'Manage Coffee Shop (គ្រប់គ្រងហាងកាហ្វេ និងភេសជ្ជៈ)',
            'view_billing' => 'View Billing & Revenue (មើលរបាយការណ៍ហិរញ្ញវត្ថុ និងចំណូល)',
            'manage_users' => 'Manage Users & Roles (គ្រប់គ្រងសិទ្ធិបុគ្គលិក និងសមាជិក)',
        ];

        return view('users.index', compact('users', 'permissions'));
    }

    public function create()
    {
        return view('users.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email',
            'role' => 'required|in:admin,manager,staff,client',
            'password' => 'required|string|min:8',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('users.index')->with('success', 'គណនីសមាជិកថ្មីត្រូវបានបង្កើតដោយជោគជ័យ។');
    }

    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'role' => 'required|in:admin,manager,staff,client',
            'password' => 'nullable|string|min:8',
        ]);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->role = $request->role;

        if ($request->password) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return redirect()->route('users.index')->with('success', 'ព័ត៌មានគណនីត្រូវបានធ្វើបច្ចុប្បន្នភាពជោគជ័យ។');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('users.index')->with('success', 'គណនីសមាជិកត្រូវបានលុបជោគជ័យ។');
    }

    public function updateSettings(Request $request)
    {
        if (!in_array(auth()->user()->role, ['admin', 'owner'])) {
            abort(403);
        }

        $roles = ['manager', 'staff', 'client'];
        $permissions = [
            'view_dashboard', 'manage_lessons', 'manage_school', 
            'manage_products', 'manage_beverages', 'view_billing', 'manage_users'
        ];

        foreach ($roles as $role) {
            foreach ($permissions as $perm) {
                $key = "perm_{$role}_{$perm}";
                $value = $request->has($key) ? 1 : 0;
                Setting::updateOrCreate(['key' => $key], ['value' => $value]);
            }
        }

        return back()->with('success', 'តារាងសិទ្ធិប្រើប្រាស់ (PHIROM RBAC Matrix) ត្រូវបានធ្វើបច្ចុប្បន្នភាពជោគជ័យបាទ។');
    }
}