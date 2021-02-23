<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Profile;
use App\Models\Action;
use App\Models\User;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $actions = Action::get();
        return view('dashboard.profiles.index', compact('actions'));
    }

    public function list(Request $request) {
        $items_per_page = 25;
        $s = ($request->get('s')) ? trim($request->get('s')) : null;
        $page = ($request->get('page')) ? (int) ($request->get('page')) - 1 : 0;
        $offset = (int) $page * $items_per_page;
        $items = Profile::select('id', 'name')->orderBy('id', 'ASC');

        if($s) {
            $items = $items->whereRaw("LOWER(name) like LOWER('%{$s}%')");
        }

        $total_count = $items->get()->count();
        $items = $items->offset($offset)->limit($items_per_page)->get();

        return response()->json(compact('total_count', 'items'));
    }

    public function listUsers(Request $request, $id) {
        $items_per_page = 25;
        $s = ($request->get('s')) ? trim($request->get('s')) : null;
        $page = ($request->get('page')) ? (int) ($request->get('page')) - 1 : 0;
        $offset = (int) $page * $items_per_page;
        $items = User::select('id', 'name', 'email')->orderBy('name', 'ASC')->where('profile_id', (int) $id);

        if($s) {
            $items = $items->whereRaw("LOWER(name) like LOWER('%{$s}%')")->orWhereRaw("LOWER(email) like LOWER('%{$s}%')");
        }

        $total_count = $items->get()->count();
        $items = $items->offset($offset)->limit($items_per_page)->get();

        return response()->json(compact('total_count', 'items'));
    }

    public function listUnassignedUsers($id, Request $request) {
        $s = ($request->get('s')) ? trim($request->get('s')) : null;
        $items = User::where('profile_id', '!=', (int) $id)->orWhere('profile_id', null)->select('id', 'name')->orderBy('name', 'ASC');

        if($s) {
            $items = $items->whereRaw("LOWER(name) like LOWER('%{$s}%')");
        }

        $items = $items->get();

        return response()->json(compact('items'));
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
            'name' => 'required|min:3',
            //'description' => 'required|min:6',
            'actions_ids' => 'required|exists:actions,id',
        ];
        $messages = [
            'name.required' => 'El nombre del perfil es requerido.',
            'name.min' => 'El nombre del perfil debe tener al menos 3 caracteres.',
            //'description.required' => 'La descripción del perfil es requerido.',
            //'description.min' => 'La descripción del perfil debe tener al menos 6 caracteres.',
            'actions_ids.required' => 'Debes asignar las acciones a las que tiene permiso el perfil.',
            'actions_ids.exists' => 'Uno o más de las acciones porporcionadas no son válidas.'
        ];
        $this->validate($request, $rules, $messages);
        $profile = Profile::create([
            'name' => trim($request->get('name')),
            //'description' => trim($request->get('description'))
        ]);
        $profile->actions()->sync((array) $request->get('actions_ids'));
        $actions_ids = [];
        $actions_ids_strings = $profile->actions()->pluck('actions.id');
        foreach($actions_ids_strings as $id) {
            array_push($actions_ids, (int) $id);
        }
        $profile->actions_ids = $actions_ids;

        return response()->json(compact('profile'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Profile $profile)
    {
        $actions_ids = [];
        $actions_ids_strings = $profile->actions()->pluck('actions.id');
        foreach($actions_ids_strings as $id) {
            array_push($actions_ids, (int) $id);
        }
        $profile->actions_ids = $actions_ids;

        return response()->json(compact('profile'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Profile $profile)
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
    public function update(Request $request, Profile $profile)
    {
        $rules = [
            'name' => 'required|min:3',
            //'description' => 'required|min:6',
            'actions_ids' => 'required|exists:actions,id',
        ];
        $messages = [
            'name.required' => 'El nombre del perfil es requerido.',
            'name.min' => 'El nombre del perfil debe tener al menos 3 caracteres.',
            //'description.required' => 'La descripción del perfil es requerido.',
            //'description.min' => 'La descripción del perfil debe tener al menos 6 caracteres.',
            'actions_ids.required' => 'Debes asignar las acciones a las que tiene permiso el perfil.',
            'actions_ids.exists' => 'Uno o más de las acciones porporcionadas no son válidas.'
        ];
        $this->validate($request, $rules, $messages);
        $profile->name = trim($request->get('name'));
        //$profile->description = trim($request->get('description'));
        $profile->save();
        $profile->actions()->sync((array) $request->get('actions_ids'));
        $actions_ids = [];
        $actions_ids_strings = $profile->actions()->pluck('actions.id');
        foreach($actions_ids_strings as $id) {
            array_push($actions_ids, (int) $id);
        }
        $profile->actions_ids = $actions_ids;

        return response()->json(compact('profile'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Profile $profile)
    {
        //
    }
}
