<?php
namespace App\Http\Controllers;
use Excel;
use App\Imports\ImportUsers;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Requests\UserRequest;
use App\Http\Controllers\DB;

class UsersController extends Controller
{
    public function index()
    {
        $users = User::orderBy('id', 'desc')->paginate(12);
        return view('users.index', ['users' => $users]);
    }

    public function create()
    {
        $roles = Role::all();
        return view('users.create')->with(['roles' => $roles]);
    }

    public function store(User $user, Request $request) 
    {
        $request->validate([
            'name' => 'required',
            'role' => 'required',
            'email' => 'required',
            'password' => 'required',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'active' =>true,
        ]);  
        $user->syncRoles($request->get('role'));
        $request->session()->flash('success', 'User saved successfully!');

        return redirect()->route('users.index');

    }
  
    public function edit(User $user)
    {
        return view('users.edit')->with([
            'user'  => $user,
            'userRole' => $user->roles->pluck('name')->toArray(),
            'roles' => Role::latest()->get()
        ]);
    }

    public function update(User $user, UserRequest $request) 
    {
        $user->update($request->all());
        $user->syncRoles($request->get('role'));
        $request->session()->flash('success', 'User updated successfully!');
        return redirect()->route('users.index');
    }
  
    public function destroy(Request $request, User $user)
    {
        $user->delete();
        $request->session()->flash('success', 'User deleted successfully!');
        return redirect()->route('users.index');
    }

    public function import()
    {
        return view('users.import');
    }

    public function importUsersExcel(Request $request)
    {      
        try {
            Excel::import(new ImportUsers, $request->file);
            $request->session()->flash('success', 'Excel imported successfully!');
            return redirect()->route('users.index');
        } catch (\Throwable $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
