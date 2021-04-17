<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Profile;
use App\Models\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $profiles = Profile::select('id', 'name')->orderBy('id', 'ASC')->get()->toArray();
        return view('dashboard.users.index', compact('profiles'));
    }

    public function list(Request $request) {
        $items_per_page = 25;
        $s = ($request->get('s')) ? trim($request->get('s')) : null;
        $page = ($request->get('page')) ? (int) ($request->get('page')) - 1 : 0;
        $offset = (int) $page * $items_per_page;
        $items = User::select('id', 'first_name', 'last_name', 'email', 'profile_id', 'created_at')
            ->orderBy('id', 'ASC')
            ->with('profile');

        if($s) {
            $items = $items->whereRaw("LOWER(name) like LOWER('%{$s}%')")->orWhereRaw("LOWER(email) like LOWER('%{$s}%')");
        }

        $total_count = $items->get()->count();
        $items = $items->offset($offset)->limit($items_per_page)->get();

        return response()->json(compact('total_count', 'items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'first_name' => 'required|min:5',
            'last_name' => 'required|min:5',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'profile_id' => 'required|exists:profiles,id',
        ];
        $messages = [
            'first_name.required' => 'El nombre del usuario es requerido.',
            'first_name.min' => 'El nombre del usuario debe tener al menos 5 caracteres.',
            'last_name.required' => 'El apellido del usuario es requerido.',
            'last_name.min' => 'El apellido del usuario debe tener al menos 5 caracteres.',
            'email.required' => 'El correo electrónico del usuario es requerido.',
            'email.email' => 'El correo electrónico tiene un formato inválido',
            'email.unique' => 'Ese correo electrónico ya está registrado',
            'password.required' => 'La contraseña es requerida.',
            'password.string' => 'La contraseña debe ser una cadena de texto.',
            'password.min' => 'La contraseña debe tener al menos 8 caracteres.',
            'password.confirmed' => 'La validación de contraseña no coincide.',
            'profile_id.required' => 'El perfil es requerido.',
            'profile_id.exists' => 'El perfil proporcionado no es válido.',
        ];
        $request->validate($rules, $messages);
        $first_name = trim($request->get('first_name'));
        $last_name = trim($request->get('last_name'));
        $email = trim($request->get('email'));
        $password = $request->get('password');

        $user = User::create([
            'first_name' => $first_name,
            'last_name' => $last_name,
            'email' => $email,
            'password' => bcrypt($password),
            'profile_id' => (int) $request->get('profile_id'),
        ]);

        return response()->json(['error' => false, 'user' => $user]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
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
    public function update(Request $request, User $user)
    {
        $rules = [
            'first_name' => 'required|min:5',
            'last_name' => 'required|min:5',
            'profile_id' => 'required|exists:profiles,id',
        ];
        $messages = [
            'first_name.required' => 'El nombre del usuario es requerido.',
            'first_name.min' => 'El nombre del usuario debe tener al menos 5 caracteres.',
            'last_name.required' => 'El apellido del usuario es requerido.',
            'last_name.min' => 'El apellido del usuario debe tener al menos 5 caracteres.',
            'profile_id.required' => 'El perfil es requerido.',
            'profile_id.exists' => 'El perfil proporcionado no es válido.',
        ];
        $request->validate($rules, $messages);

        $user->first_name = trim($request->get('first_name'));
        $user->last_name = trim($request->get('last_name'));
        $user->profile_id = (int) $request->get('profile_id');
        $user->save();

        return response()->json(['error' => false, 'user' => $user]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }
}
