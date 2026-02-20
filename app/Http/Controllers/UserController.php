<?php

    namespace App\Http\Controllers;

    use App\Models\User;
    use App\Models\Office;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Hash;
    use Spatie\Permission\Models\Role;

    class UserController extends Controller
    {
        public function index()
        {
            $users = User::with('office')->latest()->get();
            return view('users.index', compact('users'));
        }

        public function create()
        {
            $roles = Role::all();
            $offices = Office::all();
            return view('users.create', compact('roles', 'offices'));
        }

        public function store(Request $request)
        {
            $request->validate([
                'name' => 'required',
                'email' => 'required|email|unique:users',
                'password' => 'required|min:6',
                'role' => 'required',
                'office_id' => 'nullable'
            ]);

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'office_id' => $request->office_id
            ]);

            $user->assignRole($request->role);

            return redirect()->route('users.index')
                ->with('success', 'User berhasil dibuat');
        }

        public function edit(User $user)
        {
            $roles = Role::all();
            $offices = Office::all();
            return view('users.edit', compact('user', 'roles', 'offices'));
        }

        public function update(Request $request, User $user)
        {
            $request->validate([
                'name' => 'required',
                'email' => 'required|email',
                'role' => 'required',
            ]);

            $user->update([
                'name' => $request->name,
                'email' => $request->email,
                'office_id' => $request->office_id
            ]);

            if ($request->password) {
                $user->update([
                    'password' => Hash::make($request->password)
                ]);
            }

            $user->syncRoles([$request->role]);

            return redirect()->route('users.index')
                ->with('success', 'User berhasil diupdate');
        }

        public function destroy(User $user)
        {
            $user->delete();

            return redirect()->route('users.index')
                ->with('success', 'User berhasil dihapus');
        }
    }
?>
