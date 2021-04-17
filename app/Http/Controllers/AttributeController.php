<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Attribute;
use App\Models\Value;

class AttributeController extends Controller
{
    public function index() {
        return view('dashboard.attributes.index');
    }

    public function values(Attribute $attribute) {
        return view('dashboard.attributes.values', ['attribute' => $attribute]);
    }

    public function list(Request $request) {
        $items_per_page = 25;
        $s = ($request->get('s')) ? trim($request->get('s')) : null;
        $page = ($request->get('page')) ? (int) ($request->get('page')) - 1 : 0;
        $offset = (int) $page * $items_per_page;
        $items = Attribute::select('id', 'name')->orderBy('id', 'ASC');

        if($s) {
            $items = $items->whereRaw("LOWER(name) like LOWER('%{$s}%')");
        }

        $total_count = $items->get()->count();
        $items = $items->offset($offset)->limit($items_per_page)->get();

        return response()->json(compact('total_count', 'items'));
    }

    public function select(Request $request) {
        $category_id = ($request->get('category_id')) ? (int) $request->get('category_id') : null;
        $items = Attribute::select('id', 'name', 'category_id');

        if($category_id) {
            $items = $items->where('category_id', $category_id);
        }

        $items = $items->get();

        return response()->json($items);
    }

    public function listValues(Request $request, $id) {
        $attribute_id = (int) $id;
        $items_per_page = 25;
        $s = ($request->get('s')) ? trim($request->get('s')) : null;
        $page = ($request->get('page')) ? (int) ($request->get('page')) - 1 : 0;
        $offset = (int) $page * $items_per_page;
        $items = Value::select('id', 'name', 'attribute_id')->orderBy('id', 'ASC')->where('attribute_id', $attribute_id);

        if($s) {
            $items = $items->whereRaw("LOWER(name) like LOWER('%{$s}%')");
        }

        $total_count = $items->get()->count();
        $items = $items->offset($offset)->limit($items_per_page)->get();

        return response()->json(compact('total_count', 'items'));
    }

    public function search(Request $request) {
        $s = ($request->get('s')) ? trim($request->get('s')) : null;
        $items = Attribute::select('id', 'name')->orderBy('id', 'ASC');

        if($s) {
            $items = $items->whereRaw("LOWER(name) like LOWER('%{$s}%')");
        }

        $items = $items->get();

        return response()->json($items);
    }

    public function searchValues($id) {
        $attribute_id = (int) $id;

        $items = Value::select('id', 'name', 'attribute_id')->orderBy('id', 'ASC');

        $count = Attribute::where('id', $attribute_id)->count();

        if($count) {
            $items = $items->where('attribute_id', $attribute_id);
        }

        $items = $items->get();

        return response()->json($items);
    }

    public function store(Request $request) {
        $rules = [
            'name' => 'required|min:2',
        ];
        $messages = [
            'name.required' => 'El nombre del atributo es requerido.',
            'name.min' => 'El nombre del atributo debe tener al menos 2 caracteres.',
        ];
        $this->validate($request, $rules, $messages);
        $name = trim($request->get('name'));

        $a = Attribute::whereRaw("LOWER(name) = LOWER('{$name}')")->first();

        if($a) {
            return response()->json(['message' => 'Solicitud inválida.', 'a' => $a, 'errors' => ['name' => ['El atributo proporcionado ya está registrado.']]], 400);
        }

        $attribute = Attribute::create([
            'name' => ucfirst($name)
        ]);
        $attribute->active = false;
        $attribute->available_values = [];
        $attribute->selected_values = [];

        return response()->json(['attribute' => $attribute]);
    }

    public function storeValue(Request $request, Attribute $attribute) {
        $rules = [
            'name' => 'required|min:2',
        ];
        $messages = [
            'name.required' => 'El nombre del atributo es requerido.',
            'name.min' => 'El nombre del atributo debe tener al menos 2 caracteres.',
        ];
        $this->validate($request, $rules, $messages);
        $name = trim($request->get('name'));

        $v = Value::whereRaw("LOWER(name) = LOWER('{$name}')")->first();

        if($v) {
            return response()->json(['message' => 'Solicitud inválida.', 'a' => $v, 'errors' => ['name' => ['El atributo proporcionado ya está registrado.']]], 400);
        }

        $value = $attribute->values()->create([
            'name' => ucfirst($name)
        ]);

        return response()->json(['value' => $value]);
    }
}
