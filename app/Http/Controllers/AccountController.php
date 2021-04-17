<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Department;
use App\Models\Merchant;
use App\Models\Address;
use App\Models\Town;
use App\Models\User;

class AccountController extends Controller
{
    public function user() {
        $user = User::where('id', auth()->user()->id)
            ->select('id', 'first_name', 'last_name', 'email', 'birthday', 'phone')
            ->first();
        //$session = session()->getId();

        return response()->json(compact('user'));
    }

    public function updatePersonalInfo(Request $request, User $user) {
        $rules = [
            'first_name' => 'required|min:3',
            'last_name' => 'required|min:3',
            'birthday' => 'nullable|date',
            'phone' => 'nullable|min:9'
        ];
        $messages = [
            'first_name.required' => 'El nombre es requerido.',
            'first_name.min' => 'El nombre debe tener un mínimo de 3 caracteres.',
            'last_name.required' => 'El apellido es requerido.',
            'last_name.min' => 'El apellido debe tener un mínimo de 3 caracteres.',
            'birthday.date' => 'La fecha de cumpleños debe ser una fecha válida.',
            'phone.min' => 'El teléfono debe tener 8 números.'
        ];
        $request->validate($rules, $messages);
        $user->first_name = trim($request->get('first_name'));
        $user->last_name = trim($request->get('last_name'));
        $user->birthday = ($request->get('birthday')) ? trim($request->get('birthday')) : null;
        $user->phone = ($request->get('phone')) ? trim($request->get('phone')) : null;
        $user->save();

        return response()->json(compact('user'));
    }

    public function updatePassword(Request $request, User $user) {
        $rules = [
            'current_password' => 'required|password:sanctum',
            'password' => 'required|min:8|confirmed',
        ];
        $messages = [
            'current_password.required' => 'La contraseña actual es requerida.',
            'current_password.password' => 'La contraseña actual es incorrecta.',
            'password.required' => 'La nueva contraseña es requerida.',
            'password.min' => 'La contraseña debe tener al menos 8 caractéres.',
            'password.confirmed' => 'La nueva contraseña y la confirmación de contraseña deben ser iguales.'
        ];
        $request->validate($rules, $messages);
        $user->password = bcrypt(trim($request->get('password')));

        return response()->json(['error' => false]);
    }

    public function departments() {
        $departments = Department::where('country_id', 1)->get();

        return response()->json(compact('departments'));
    }

    public function towns(Request $request) {
        $department_id = ($request->get('department_id')) ? (int) $request->get('department_id') : null;
        if ($department_id) {
            $towns = Town::where('department_id', $department_id)->get();
        } else {
            $towns = Town::get();
        }

        return response()->json(compact('towns'));
    }

    public function addresses() {
        $user_id = auth()->user()->id;
        $addresses = Address::where('user_id', $user_id)->with(['town.department.country'])->get();

        return response()->json(compact('addresses'));
    }

    public function storeAddress(Request $request) {
        $rules = [
            'name' => 'required|min:3',
            'address' => 'required|min:10',
            'additional_information' => 'nullable|min:8',
            'postal_code' => 'nullable|min:5',
            'department_id' => 'required|integer|exists:departments,id',
            'town_id' => 'required|integer|exists:towns,id'
        ];
        $messages = [
            'name.required' => 'El nombre de la dirección es requerida.',
            'name.min' => 'El nombre de la dirección debe tener al menos 3 caracteres.',
            'address.required' => 'La dirección es requerida.',
            'address.min' => 'La dirección debe tener al menos 10 caracteres.',
            'additional_information' => 'La información adicional debe tener al menos 8 caracteres.',
            'postal_code.min' => 'El código postal debe tener al menos 5 caracteres.',
            'department_id.required' => 'La ciudad es requerida.',
            'department_id.exists' => 'La ciudad proporcionada no es válida.',
            'town_id.required' => 'El municipio es requerido.',
            'town_id.exists' => 'El municipio proporcionado no es válido.'
        ];
        $request->validate($rules, $messages);
        $user_id = (int) auth()->user()->id;
        $address = Address::create([
            'name' => trim($request->get('name')),
            'address' => trim($request->get('address')),
            'additional_information' => ($request->get('additional_information')) ? trim($request->get('additional_information')) : null,
            'postal_code' => ($request->get('postal_code')) ? trim($request->get('postal_code')) : null,
            'town_id' => (int) $request->get('town_id'),
            'user_id' => $user_id
        ]);
        $address->load(['town.department.country']);


        return response()->json(compact('address'));
    }

    public function updateAddress(Request $request, Address $address) {
        $rules = [
            'name' => 'required|min:3',
            'address' => 'required|min:10',
            'additional_information' => 'nullable|min:8',
            'postal_code' => 'nullable|min:5',
            'department_id' => 'required|integer|exists:departments,id',
            'town_id' => 'required|integer|exists:towns,id'
        ];
        $messages = [
            'name.required' => 'El nombre de la dirección es requerida.',
            'name.min' => 'El nombre de la dirección debe tener al menos 3 caracteres.',
            'address.required' => 'La dirección es requerida.',
            'address.min' => 'La dirección debe tener al menos 10 caracteres.',
            'additional_information' => 'La información adicional debe tener al menos 8 caracteres.',
            'postal_code.min' => 'El código postal debe tener al menos 5 caracteres.',
            'department_id.required' => 'La ciudad es requerida.',
            'department_id.exists' => 'La ciudad proporcionada no es válida.',
            'town_id.required' => 'El municipio es requerido.',
            'town_id.exists' => 'El municipio proporcionado no es válido.'
        ];
        $request->validate($rules, $messages);
        $address->name = trim($request->get('name'));
        $address->address = trim($request->get('address'));
        $address->additional_information = ($request->get('additional_information')) ? trim($request->get('additional_information')) : null;
        $address->postal_code = ($request->get('postal_code')) ? trim($request->get('postal_code')) : null;
        $address->town_id = (int) $request->get('town_id');
        $address->save();
        $address->load(['town.department.country']);

        return response()->json(compact('address'));
    }

    public function destroyAddress(Address $address) {
        $address->delete();

        return response()->json(['error' => false]);
    }
}
