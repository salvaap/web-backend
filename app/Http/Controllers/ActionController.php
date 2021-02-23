<?php

namespace App\Http\Controllers;

use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use App\Models\Application;
use App\Models\Action;

class ActionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $parent_actions = Action::where('parent_id', null)->orderBy('order', 'ASC')->get();
        $application_options = Application::select('id', 'name')->orderBy('id', 'ASC')->get();

        return view('dashboard.actions.index', compact('parent_actions', 'application_options'));
    }

    public function list(Request $request) {
        $items_per_page = 25;
        $s = ($request->get('s')) ? trim($request->get('s')) : null;
        $page = ($request->get('page')) ? (int) ($request->get('page')) - 1 : 0;
        $offset = (int) $page * $items_per_page;
        $items = Action::select('id', 'parent_id', 'title', 'description', 'action', 'location', 'order')->with('parent')->orderBy('id', 'ASC');

        if($s) {
            $items = $items->whereRaw("LOWER(title) like LOWER('%{$s}%')");
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
            'parent_id' => 'nullable|exists:actions,id',
            'title' => 'required|min:3',
            'description' => 'nullable|min:5',
            'action' => 'required|min:5|unique:actions,action',
            'icon' => 'required_if:is_visible,true',
            'application_id' => 'required|exists:applications,id',
            'order' => 'nullable|numeric',
            'is_visible' => 'exclude_unless:parent_id,null|required|boolean',
            'is_component' => 'exclude_if:is_visible,true|required|boolean'
        ];
        $messages = [
            'parent_id.exists' => 'La ruta padre proporcionada no es válida.',
            'title.required' => 'El titulo de la ruta es requerido.',
            'title.min' => 'El titulo de la ruta debe tener al menos 3 caracteres.',
            'description.min' => 'El titulo de la ruta debe tener al menos 5 caracteres.',
            'action.required' => 'La ruta es requerida.',
            'action.min' => 'La ruta debe tener un mínimo de 5 caracteres.',
            'action.unique' => 'La ruta especificada ya existe.',
            'application_id.required' => 'La aplicación a la que pertenecerá es requerido.',
            'application_id.exists' => 'La aplicación proporcionada no es válida.',
            'icon.required_if' => 'El ícono es requerido para las acciones ubicadas en TOOLBAR.',
            'order.numeric' => 'El orden debe ser un valor numerico.',
            'is_visible.required' => 'La visibilidad es requerida.',
            'is_visible.boolean' => 'El valor porporcionado para la visibilidad es inválido.',
            'is_component.required' => 'Es requerido saber si el campo es un componente.',
            'is_component.boolean' => 'El valor proporcionado para el campo componente es inválido.',
        ];
        $this->validate($request, $rules, $messages);
        $action = Action::create([
            'parent_id' => ($request->get('parent_id')) ? (int) $request->get('parent_id') : null,
            'title' => trim($request->get('title')),
            'description' => trim($request->get('description')),
            'action' => trim($request->get('action')),
            'icon' => trim($request->get('icon')),
            'application_id' => $request->get('application_id'),
            'location' => $request->get('location'),
            'order' => ($request->get('order')) ? (int) trim($request->get('order')) : null,
            'is_visible' => (bool) $request->get('is_visible'),
            'is_component' => (bool) $request->get('is_component')
        ]);

        return response()->json(compact('action'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Action $action)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Action $action)
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
    public function update(Request $request, Action $action)
    {
        $rules = [
            'parent_id' => 'nullable|exists:options,id',
            'title' => 'required|min:3',
            'description' => 'nullable|min:5',
            'action' => ['required', 'min:5', Rule::unique('actions', 'action')->ignore($action->id)],
            'icon' => 'required_if:location,toolbar',
            'application' => 'required',
            'order' => 'nullable|numeric',
            'is_visible' => 'exclude_unless:parent_id,null|required|boolean',
            'is_component' => 'exclude_if:is_visible,true|required|boolean'
        ];
        $messages = [
            'parent_id.exists' => 'La ruta padre proporcionada no es válida.',
            'title.required' => 'El titulo de la ruta es requerido.',
            'title.min' => 'El titulo de la ruta debe tener al menos 3 caracteres.',
            'description.min' => 'El titulo de la ruta debe tener al menos 5 caracteres.',
            'action.required' => 'La ruta es requerida.',
            'action.min' => 'La ruta debe tener un mínimo de 5 caracteres.',
            'action.unique' => 'La ruta especificada ya existe.',
            'icon.required_if' => 'El ícono es requerido para las acciones ubicadas en TOOLBAR.',
            'order.numeric' => 'El orden debe ser un valor numerico.',
            'is_visible.required' => 'La visibilidad es requerida.',
            'is_visible.boolean' => 'El valor porporcionado para la visibilidad es inválido.',
            'is_component.required' => 'Es requerido saber si el campo es un componente.',
            'is_component.boolean' => 'El valor proporcionado para el campo componente es inválido.'
        ];
        $this->validate($request, $rules, $messages);

        $action->parent_id = ($request->get('parent_id')) ? (int) $request->get('parent_id') : null;
        $action->title = trim($request->get('title'));
        $action->description = trim($request->get('description'));
        $action->action = trim($request->get('action'));
        $action->icon = trim($request->get('icon'));
        $action->application = $request->get('application');
        $action->location = $request->get('location');
        $action->order = ($request->get('order')) ? (int) trim($request->get('order')) : null;
        $action->is_visible = (bool) $request->get('is_visible');
        $action->is_component = (bool) $request->get('is_component');
        $action->save();

        return response()->json(compact('action'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Action $action)
    {
        //
    }
}
