<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Merchant;
use App\Models\Account;
use App\Models\Bank;
use Carbon\Carbon;

class CommerceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $user_id = auth()->user()->id;
        $merchant = Merchant::where('owner_id', $user_id)->first();
        $merchant->load(['accounts.bank', 'owner']);
        $banks = Bank::select('id', 'name')->get();
        return view('dashboard.merchants.commerce', compact('merchant', 'banks'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
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
    public function update(Request $request, Merchant $merchant)
    {
        $rules = [
            'name' => 'required|min:3',
            'address' => 'required|min:10',
            'logo' => 'required|url',
        ];
        $messages = [
            'name.required' => 'El nombre de la tienda es requerido.',
            'name.min' => 'El nombre de la tienda debe tener un mínimo de 3 caracteres.',
            'address.required' => 'La dirección de la tienda es requerida.',
            'address.min' => 'La dirección debe tener un mínimo de 10 caracteres.',
            'logo.required' => 'El logo es requerido.',
            'logo.url' => 'El logo proporcionada no es válido.',
        ];
        $this->validate($request, $rules, $messages);

        $merchant->name = trim($request->get('name'));
        $merchant->address = trim($request->get('address'));
        $merchant->logo = trim($request->get('logo'));
        $merchant->save();

        return response()->json(['merchant' => $merchant]);
    }

    public function storeAccount(Request $request, Merchant $merchant) {
        $rules = [
            'name' => 'required|min:3',
            'description' => 'nullable|min:5',
            'bank_id' => 'required|exists:banks,id',
            'account_titular' => 'required|min:8',
            'account_number' => 'required|numeric|min:5',
        ];
        $messages = [
            'name.required' => 'El nombre descriptivo de la cuenta es requerido.',
            'name.min' => 'El nombre debe tener al menos 5 caracteres.',
            'description.min' => 'La descripción debe tener al menos 5 caracteres.',
            'bank_id.required' => 'Es requerido seleccionar un banco.',
            'bank_id.exists' => 'El banco proporcionado no es válido.',
            'account_titular.required' => 'El nombre del titular de la cuenta es requerido.',
            'account_titular.min' => 'El nombre del titular de la cuenta debe tener al menos 8 caracteres.',
            'account_number.required' => 'El número de la cuenta es requerido.',
            'account_number.min' => 'El número de la cuenta debe tener al menos 5 caracteres.',
            'account_number.numeric' => 'El número de la cuenta debe ser un valor númerico.',
        ];
        $this->validate($request, $rules, $messages);

        $account = Account::create([
            'name' => trim($request->get('name')),
            'description' => (trim($request->get('description'))) ? trim($request->get('description')) : null,
            'bank_id' => (int) $request->get('bank_id'),
            'account_titular' => trim($request->get('account_titular')),
            'account_number' => trim($request->get('account_number')),
            'merchant_id' => (int) $merchant->id
        ]);
        $account->load('bank');

        return response()->json(['account' => $account]);
    }

    public function uploadLogo(Request $request, Merchant $merchant) {
        $rules = [
            'logo' => 'required|image|dimensions:min_width=300,min_height=300,max_width=500,min_width=500,ration=1',
        ];
        $messages = [
            'logo.required' => 'El logo es requerido.',
            'logo.image' => 'El logo debe ser un formato de imagen válido (jpeg, png)',
            'logo.dimensions' => 'El logo debe tener dimensiones minimas de 300px, dimensiones máximas de 500px con una relación de aspecto de 1:1 (cuadrada).'
        ];
        $this->validate($request, $rules, $messages);

        $format = $request->file('logo')->getClientOriginalExtension();
        $file_name = 'logo_' . $merchant->id . '-' . Carbon::now()->timestamp . '.' . $format;
        $path = 'images/merchants/';
        $file_location = config('app.url') . '/' . $path . $file_name;
        $upload_path = public_path('images/merchants');
        $request->file('logo')->move($upload_path, $file_name);

        return response()->json(['logo' => $file_location]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
