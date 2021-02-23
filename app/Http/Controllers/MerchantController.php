<?php

namespace App\Http\Controllers;

use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Merchant;
use App\Models\Product;
use App\Models\User;
use Carbon\Carbon;

class MerchantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.merchants.index');
    }

    public function list(Request $request) {
        $items_per_page = 25;
        $s = ($request->get('s')) ? trim($request->get('s')) : null;
        $page = ($request->get('page')) ? (int) ($request->get('page')) - 1 : 0;
        $offset = (int) $page * $items_per_page;
        $items = Merchant::select('id', 'name', 'owner_id', 'logo', 'town_id', 'address')->orderBy('id', 'ASC')->with(['owner', 'town.department.country']);

        if($s) {
            $items = $items->whereRaw("LOWER(name) like LOWER('%{$s}%')");
        }

        $total_count = $items->get()->count();
        $items = $items->offset($offset)->limit($items_per_page)->get();

        return response()->json(compact('total_count', 'items'));
    }

    public function uploadLogo(Request $request) {
        $rules = [
            'merchant_logo' => 'required|image|dimensions:min_width=300,min_height=300,max_width=500,min_width=500,ration=1',
        ];
        $messages = [
            'merchant_logo.required' => 'El logo es requerido.',
            'merchant_logo.image' => 'El logo debe ser un formato de imagen válido (jpeg, png)',
            'merchant_logo.dimensions' => 'El logo debe tener dimensiones minimas de 300px, dimensiones máximas de 500px con una relación de aspecto de 1:1.'
        ];
        $this->validate($request, $rules, $messages);

        $format = $request->file('merchant_logo')->getClientOriginalExtension();
        $file_name = 'logo_' . Carbon::now()->timestamp . '.' . $format;
        $path = 'images/merchants/';
        $file_location = config('app.url') . '/' . $path . $file_name;
        $upload_path = public_path('images/merchants');
        $request->file('merchant_logo')->move($upload_path, $file_name);

        return response()->json(['merchant_logo' => $file_location]);
    }

    public function uploadAvatar(Request $request) {
        $rules = [
            'avatar' => 'required|image|dimensions:min_width=300,min_height=300,max_width=500,min_width=500,ration=1',
        ];
        $messages = [
            'avatar.required' => 'El logo es requerido.',
            'avatar.image' => 'El logo debe ser un formato de imagen válido (jpeg, png)',
            'avatar.dimensions' => 'El logo debe tener dimensiones minimas de 300px, máximas de 500px con una relación de aspecto de 1:1 (imagen cuadrada).',
        ];
        $this->validate($request, $rules, $messages);

        /*$format = $request->file('avatar')->getClientOriginalExtension();
        $file_name = 'user_avatar_' . Carbon::now()->timestamp . '.' . $format;
        $path = 'images/users/';
        $file_location = config('app.url') . '/' . $path . $file_name;
        $upload_path = public_path('images/users');
        $request->file('avatar')->move($upload_path, $file_name);*/
        $original_format = $request->file('avatar')->getClientOriginalExtension();
        $original_name = str_replace(".{$original_format}", "", $request->file('avatar')->getClientOriginalName());
        $file_name = 'avatar_' . Carbon::now()->timestamp . '_' . str_replace(" ", "-", strtolower($original_name)) . '.' . $original_format;
        return response()->json(['filename' => $file_name]);
        $path = $request->file('avatar')->storeAs('avatars', $file_name);

        return response()->json(['avatar' => $path]);
    }

    public function uploadId(Request $request) {
        $rules = [
            'id_file' => 'required|image|max:1024',
        ];
        $messages = [
            'id_file.required' => 'La foto o scan de la cedula/pasaporte es requerido.',
            'id_file.image' => 'La foto o scan debe ser un formato de imagen válido (jpeg, png)',
            'id_file.max' => 'El peso de la foto o scan de la cedula/pasaporte debe ser de un máximo de 1MB.'
        ];
        $this->validate($request, $rules, $messages);

        $format = $request->file('id_file')->getClientOriginalExtension();
        $file_name = 'id_file_' . Carbon::now()->timestamp . '.' . $format;
        $path = 'images/users/';
        $file_location = config('app.url') . '/' . $path . $file_name;
        $upload_path = public_path('images/merchants');
        $request->file('id_file')->move($upload_path, $file_name);

        return response()->json(['id_file' => $file_location]);
    }

    public function store(Request $request) {
        $rules = [
            'first_name' => 'required|min:5',
            'last_name' => 'required|min:5',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'birthday' => 'required|date',
            'id_number' => 'required|min:10',
            'id_file' => 'required|url',
            'avatar' => 'required|url',
            'merchant_name' => 'required|min:5',
            'merchant_address' => 'required|min:10',
            'merchant_logo' => 'required|url',
            'merchant_town_id' => 'required|exists:towns,id',
            'merchant_phone' => 'required|numeric',
            'terms_and_conditions' => 'required|boolean|accepted',
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
            'birthday.required' => 'La fecha de nacimiento del paciente es requerida.',
            'birthday.date' => 'La fecha de nacimiento debe ser una fecha válida.',
            'id_number.required' => 'La cedula/pasaporte es requerido.',
            'id_number.min' => 'La cedula/pasaporte debe tener al menos 10 caracteres.',
            'id_file.required' => 'La cedula/pasaporte es requerido.',
            'id_file.url' => 'La cedula/pasaporte proporcionado no es válido.',
            'avatar.required' => 'El avatar es requerido.',
            'avatar.url' => 'El avatar proporcionado no es válido.',
            'merchant_name.required' => 'El nombre de la tienda es requerido.',
            'merchant_name.min' => 'El nombre de la tienda debe tener al menos 5 caracteres.',
            'merchant_address.required' => 'La dirección de la tienda es requerida.',
            'merchant_address.min' => 'La dirección de la tienda debe tener al menos 5 caracteres.',
            'merchant_logo.required' => 'El logo de la tienda es requerido.',
            'merchant_logo.url' => 'El logo de la tienda proporcionado no es válido.',
            'merchant_town_id.required' => 'El municipio es requerido.',
            'merchant_town_id.exists' => 'El municipio proporcionado no es valido.',
            'merchant_phone.required' => 'El telefono de la tienda es requerido.',
            'merchant_phone.numeric' => 'El telefono de la tienda debe ser un valor numerico.',
            'terms_and_conditions.required' => 'Los términos y condiciones es requerido.',
            'terms_and_conditions.boolean' => 'El valor de los términos y condiciones es inválido.',
            'terms_and_conditions.accepted' => 'Debes aceptar los términos y condiciones.',
        ];
        $request->validate($rules, $messages);
        $first_name = trim($request->get('first_name'));
        $last_name = trim($request->get('last_name'));
        $email = trim($request->get('email'));
        $password = trim($request->get('password'));
        $birthday = Carbon::parse($request->get('birthday'));
        $id_number = trim($request->get('id_number'));
        $id_file = trim($request->get('id_file'));
        $avatar = trim($request->get('avatar'));

        $merchant_name = trim($request->get('merchant_name'));
        $merchant_address = trim($request->get('merchant_address'));
        $merchant_logo = trim($request->get('merchant_logo'));
        $merchant_town_id = (int) trim($request->get('merchant_town_id'));
        $merchant_phone = trim($request->get('merchant_phone'));

        try {
            $user = User::create([
                'first_name' => $first_name,
                'last_name' => $last_name,
                'email' => $email,
                'password' => bcrypt($password),
                'birthday' => $birthday,
                'id_number' => $id_number,
                'id_file' => $id_file,
                'avatar' => $avatar,
                'profile_id' => 3,
            ]);

            Merchant::create([
                'name' => $merchant_name,
                'owner_id' => $user->id,
                'address' => $merchant_address,
                'logo' => $merchant_logo,
                'town_id' => $merchant_town_id,
                'phone' => $merchant_phone,
            ]);

            DB::commit();
        } catch(QueryException $e) {
            DB::rollBack();
            return response()->json(['Exception' => $e, 'request' => $request->all(), 'message' => 'Error en el guardado de datos.', 'errors' => ['exception' => ['No se pudo realizar el registro.']]], 400);
        }

        return response()->json(['error' => false]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Merchant $merchant)
    {
        $merchant->load(['owner', 'town.department.country']);

        return response()->json(['merchant' => $merchant]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Merchant $merchant)
    {
        $merchant->approved_at = Carbon::now();

        return response()->json(['success' => true]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Merchant $merchant)
    {
        $merchant->load(['owner']);
        $user = $merchant->owner;
        Product::where('merchant_id', $merchant->id)->delete();
        $merchant->delete();
        $user->delete();

        return response()->json(['sucess' => true]);
    }

    public function register() {
        return view('auth.register-merchant');
    }
}
