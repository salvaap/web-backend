<?php

namespace App\Http\Controllers;

use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\WeightRange;
use App\Models\Condition;
use App\Models\Attribute;
use App\Models\Category;
use App\Models\Merchant;
use App\Models\Gallery;
use App\Models\Product;
use App\Models\Image;
use Carbon\Carbon;

class ProductController extends Controller
{
    protected $upload_path = 'uploads/products';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.products.index');
    }

    public function list(Request $request) {
        $user_id = auth()->user()->id;
        $merchant = Merchant::where('owner_id', $user_id)->first();
        $items_per_page = 25;
        $s = ($request->get('s')) ? trim($request->get('s')) : null;
        $page = ($request->get('page')) ? (int) ($request->get('page')) - 1 : 0;
        $offset = (int) $page * $items_per_page;
        $items = Product::select('id', 'name', 'featured_image', 'is_variant', 'published_at')
            ->orderBy('id', 'ASC')
            ->with(['variants' => function($query) {
                $query->orderBy('price', 'ASC');
            }]);

        if($s) {
            $items = $items->whereRaw("LOWER(name) like LOWER('%{$s}%')");
        }

        if($merchant) {
            $items = $items->where('merchant_id', $merchant->id);
        }

        $total_count = $items->get()->count();
        $items = $items->offset($offset)->limit($items_per_page)->get();

        return response()->json(compact('total_count', 'items'));
    }

    public function all(Request $request) {
        $items = Product::select('id', 'name', 'featured_image', 'is_variant', 'published_at')
            ->orderBy('id', 'ASC')
            ->with(['variants' => function($query) {
                $query->orderBy('price', 'ASC');
            }])
            ->get();

        return response()->json(compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::where('parent_id', '!=', null)->with(['parent'])->get();
        $attributes = Attribute::select('id', 'name')->orderBy('id', 'ASC')->get();
        $conditions = Condition::select('id', 'name')->orderBy('id', 'ASC')->get();
        $weight_ranges = WeightRange::select('id', 'range')->orderBy('id', 'ASC')->get();

        $attributes->each(function($item) {
            $item->active = false;
            $item->available_values = [];
            $item->selected_values = [];
        });


        return view('dashboard.products.create', compact('categories', 'attributes', 'conditions', 'weight_ranges'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $is_variant = ($request->get('is_variant')) ? (bool) $request->get('is_variant') : false;
        $is_promoted = ($request->get('is_promoted')) ? (bool) $request->get('is_promoted') : false;
        $in_offer = ($request->get('in_offer')) ? (bool) $request->get('in_offer') : false;
        $price_rules = (!$is_variant) ? 'required_if:is_variant,false|numeric|min:1' : 'nullable';
        $amount_rules = (!$is_variant) ? 'required_if:is_variant,false|numeric|min:1' : 'nullable';
        $attributes_rules = $is_variant ? 'required_if:is_variant,true|array|min:1' : 'required_if:is_variant,true|array';
        $variants_rules = $is_variant ? 'required_if:is_variant,true|array|min:1' : 'required_if:is_variant,true|array';
        $images_rules = $is_variant ? 'required_if:is_variant,false|array' : 'required_if:is_variant,false|array|min:1';
        $offer_discount_rules = $in_offer ? 'required_if:in_offer,true|numeric|min:1' : 'nullable';
        $rules = [
            'name' => 'required|min:3',
            'description' => 'nullable|min:5',
            'featured_image' => 'required|url',
            'in_offer' => 'required|boolean',
            'is_promoted' => 'required|boolean',
            'category_id' => 'required|exists:categories,id',
            'weight_range_id' => 'required|exists:weight_ranges,id',
            'condition_id' => 'required|exists:conditions,id',
            'offer_discount' => $offer_discount_rules,
            'length' => 'required|numeric',
            'width' => 'required|numeric',
            'height' => 'required|numeric',
            'sku' => 'nullable',
            'images' => 'required_if:is_variant,false|array',
            'price' => $price_rules,
            'amount' => $amount_rules,
            'preparation_days' => 'nullable|integer',
            'attributes' => $attributes_rules,
            'attributes.*.id' => 'required|exists:attributes,id',
            'attributes.*.selected_values' => 'required|array|min:1',
            'attributes.*.selected_values.*.id' => 'required|exists:values,id',
            'variants' => $variants_rules,
            'variants.*.featured_image' => 'required|url',
            'variants.*.sku' => 'nullable',
            'variants.*.amount' => 'required|numeric|min:1',
            'variants.*.price' => 'required|numeric|min:1',
            'variants.*.width' => 'required|numeric|min:1',
            'variants.*.length' => 'required|numeric|min:1',
            'variants.*.height' => 'required|numeric|min:1',
            'variants.*.weight_range_id' => 'required|exists:weight_ranges,id',
            'variants.*.images' => 'required|array|min:1',
        ];
        $messages = [
            'images.required_if' => 'Las imagenes para el producto son requeridas.',
            'images.array' => 'Las imagenes proporcionadas no son válidas',
            'images.min' => 'Debes cargar al menos una imagen',
            'name.required' => 'El nombre del producto es requerido.',
            'name.min' => 'El nombre del producto debe tener al menos 3 caracteres.',
            'description.min' => 'La descripción del producto debe tener al menos 5 caracteres.',
            'featured_image.required' => 'La imagen principal es requerida.',
            'featured_image.url' => 'La imagen principal proporcionada no es válida.',
            'in_offer.required' => 'Es requerido definir si el producto está en oferta.',
            'in_offer.boolean' => 'El valor de oferta es inválido.',
            'is_promoted.required' => 'Es requerido definir si el producto será promocionado.',
            'is_promoted.boolean' => 'El valor de promoción es inválido.',
            'category_id.required' => 'Debes seleccionar una categoría.',
            'category_id.exists' => 'La categoría proporcionado no es válida.',
            'weight_range_id.required' => 'El rango de peso es requerido.',
            'weight_range_id.exists' => 'El rango de precio seleccionado no existe,',
            'condition_id.required' => 'Debes seleccionar una condición.',
            'condition_id.exists' => 'La condición proporcionado no es válida.',
            'offer_discount.required_if' => 'El porcentaje de descuento es requerido.',
            'offer_discount.numeric' => 'El porcentaje de descuento debe ser un valor númerico.',
            'offer_discount.min' => 'El porcentaje de descuento debe ser al menos de 1%.',
            'length.required' => 'La longitud es requerida.',
            'length.numeric' => 'La longitud debe ser un valor númerico.',
            'width.required' => 'La anchura es requerida.',
            'width.numeric' => 'La anchura debe ser un valor númerico.',
            'height.required' => 'La altura es requerida.',
            'height.numeric' => 'La altura debe ser un valor númerico.',
            'price.required_if' => 'El precio es requerido para el producto',
            'price.numeric' => 'El precio debe ser un valor númerico',
            'price.min' => 'El precio debe tener un valor mínimo de 1',
            'amount.required_if' => 'La cantidad en inventario es requerida para el producto',
            'amount.numeric' => 'La cantidad en inventario debe ser un valor númerico',
            'amount.min' => 'La cantidad en inventario debe tener un valor mínimo de 1',
            'preparation_days.integer' => 'Los días de preparación debe ser un valor númerico entero',
            'attributes.required_if' => 'Debes definir los atributos a utilizar en el producto.',
            'attributes.array' => 'El formato de los atributos no es válido.',
            'attributes.min' => 'Debes seleccionar al menos 1 atributo.',
            'attributes.*.id.required' => 'Attibuto ID requerido.',
            'attributes.*.id.exists' => 'El atributo no es válido.',
            'attributes.*.selected_values.required' => 'Los valores a utilizar son requeridos.',
            'attributes.*.selected_values.array' => 'Los valores proporcionados no son válidos.',
            'attributes.*.selected_values.min' => 'Debes seleccionar al menos un valor.',
            'attributes.*.selected_values.*.id.required' => 'El valor del atributo es un valor requerido.',
            'attributes.*.selected_values.*.id.exists' => 'El valor del atributo es inválido.',
            'variants.required_if' => 'Debes especificar las variantes para el producto.',
            'variants.array' => 'Las variantes proporcionadas no son válidas.',
            'variants.min' => 'Debes establecer al menos una variante.',
            'variants.*.amount.required' => 'La cantidad es requerida.',
            'variants.*.amount.numeric' => 'La cantidad debe ser un valor numérico.',
            'variants.*.amount.min' => 'La cantidad debe ser un mínimo de 1.',
            'variants.*.price.required' => 'El precio es requerido.',
            'variants.*.price.numeric' => 'El precio debe ser un valor numérico.',
            'variants.*.price.min' => 'El precio debe ser un mínimo de 1.',
            'variants.*.width.required' => 'El ancho es requerido.',
            'variants.*.width.numeric' => 'El ancho debe ser un valor numérico.',
            'variants.*.width.min' => 'El ancho debe ser un mínimo de 1.',
            'variants.*.height.required' => 'La altura es requerida.',
            'variants.*.height.numeric' => 'La altura debe ser un valor numérico.',
            'variants.*.height.min' => 'La altura debe ser un mínimo de 1.',
            'variants.*.length.required' => 'La longitud es requerida.',
            'variants.*.length.numeric' => 'La longitud debe ser un valor numérico.',
            'variants.*.length.min' => 'La longitud debe ser un mínimo de 1.',
            'variants.*.featured_image.required' => 'La imagen principal es requerida.',
            'variants.*.featured_image.url' => 'La imagen principal proporcionada no es válida.',
        ];

        $this->validate($request, $rules, $messages);
        $user_id = auth()->user()->id;
        $merchant_id = Merchant::where('owner_id', $user_id)->first()->id;
        try {
            DB::beginTransaction();
            $product = Product::create([
                'name' => trim($request->get('name')),
                'description' => ($request->get('description')) ? trim($request->get('description')) : null,
                'featured_image' => trim($request->get('featured_image')),
                'category_id' => (int) $request->get('category_id'),
                'condition_id' => (int) $request->get('condition_id'),
                'is_promoted' => $is_promoted,
                'is_variant' => $is_variant,
                'published_at' => Carbon::now(),
                'merchant_id' => $merchant_id,
                'in_offer' => $in_offer,
                'offer_discount' => ($request->get('offer_discount')) ? (int) $request->get('offer_discount') : null,
            ]);
            $attributes = (array) $request->get('attributes');
            $variants = (array) $request->get('variants');

            if($is_variant) {
                //$product->save();
                //$product->load('product_attributes');
                $this->storeVariant($product, $attributes, $variants);
            } else {
                //$product->save();
                $variant = $product->variants()->create([
                    'sku' => ($request->get('sku')) ? trim($request->get('sku')) : null,
                    'featured_image' => trim($request->get('featured_image')),
                    'amount' => ($request->get('amount')) ? (int) trim($request->get('amount')) : null,
                    'price' => ($request->get('price')) ? (float) round(trim($request->get('price')), 2) : null,
                    'length' => (float) round(trim($request->get('length')), 2),
                    'width' => (float) round(trim($request->get('width')), 2),
                    'height' => (float) round(trim($request->get('height')), 2),
                    'weight_range_id' => (int) $request->get('weight_range_id'),
                ]);
                foreach($request->get('images') as $image) {
                    $variant->images()->create([
                        'image' => (string) trim($image)
                    ]);
                }
            }
            $product->load('variants');
            $amount = $product->variants()->sum('amount');
            $product->amount = (int) $amount;
            $product->save();

            DB::commit();
        } catch(QueryException $e) {
            DB::rollBack();
            return response()->json(['Exception' => $e, 'request' => $request->all(), 'message' => 'Error de prueba', 'errors' => ['name' => ['Error de base de datos']]], 400);
        }

        return response()->json(['message' => 'Mensaje guardado exitosamente.']);
    }

    protected function storeVariant($product, $attributes, $variants) {
        foreach($attributes as $attribute) {
            $attribute_product = $product->product_attributes()->create([
                    'attribute_id' => (int) $attribute['id']
                ]);
            $attribute_product_ids = [];
            foreach($attribute['selected_values'] as $value) {
                $attribute_product_ids[] = (int) $value['id'];
            }
            $attribute_product->values()->attach($attribute_product_ids);
        }

        foreach($variants as $variant) {
            $created_variant = $product->variants()->create([
                    'sku' => ($variant['sku']) ? trim($variant['sku']) : null,
                    'featured_image' => trim($variant['featured_image']),
                    'amount' => (int) $variant['amount'],
                    'price' => trim($variant['price']),
                    'length' => (float) round(trim($variant['length']), 2),
                    'width' => (float) round(trim($variant['width']), 2),
                    'height' => (float) round(trim($variant['height']), 2),
                    'weight_range_id' => (int) $variant['weight_range_id'],
                ]);
            $value_variant_ids = [];
            foreach($variant['images'] as $image) {
                $created_variant->images()->create([
                        'image' => (string) trim($image)
                    ]);
            }
            foreach($variant['values'] as $value) {
                $value_variant_ids[] = (int) $value['id'];
            }
            $created_variant->values()->attach($value_variant_ids);
        }

        return true;
    }

    public function images(Request $request) {
        $user_id = auth()->user()->id;
        $merchant = Merchant::where('owner_id', $user_id)->first();
        $merchant_id = $merchant->id;
        $gallery = Gallery::where('merchant_id', $merchant_id)->where('type', 'product')->first();

        if(!$gallery) {
            return response()->json(['items' => []]);
        }

        $items = $gallery->load(['images' => function($query) {
            $query->orderBy('id', 'DESC');
        }])->images;

        return response()->json(compact('items'));
    }

    public function uploadImage(Request $request) {
        $rules = [
            'featured_image' => 'required|file|mimes:jpg,jpeg,png|dimensions:min_width=800,min_height=800,max_width=1000,max_height=1000,ratio=1',
        ];
        $messages = [
            'featured_image.required' => 'La imagen principal es requerido.',
            'featured_image.file' => 'La imagen principal debe ser un archivo válido.',
            'featured_image.mimes' => 'La imagen principal debe ser una de imagen válida (jpeg, jpg, png).',
            'featured_image.dimensions' => 'La imagen principal debe tener dimensiones minimas de 800px, dimensiones máximas de 1000px con una relación de aspecto de 1:1 (cuadrada).',
        ];
        $request->validate($rules, $messages);
        $user_id = auth()->user()->id;
        $merchant = Merchant::where('owner_id', $user_id)->first();
        $merchant_id = $merchant->id;
        $merchant_name = str_replace(" ", "-", strtolower($merchant->name));
        $gallery = Gallery::where('merchant_id', $merchant_id)->where('type', 'product')->first();

        if(!$gallery) {
            $gallery = Gallery::create([
                'merchant_id' => $merchant_id,
                'type' => 'product',
            ]);
        }

        $original_format = $request->file('featured_image')->getClientOriginalExtension();
        $original_name = str_replace(".{$original_format}", "", $request->file('featured_image')->getClientOriginalName());
        $file_name = str_replace(" ", "-", strtolower($original_name)) . '_' . Carbon::now()->timestamp . '.' . $original_format;
        $file_location = "/{$this->upload_path}/{$merchant_name}/{$file_name}";
        $file_url = config('app.url') . $file_location;
        $request->file('featured_image')->move(public_path("{$this->upload_path}/{$merchant_name}"), $file_name);

        $image = Image::create([
            'url' => $file_url,
            'name' => $file_name,
            'title' => $original_name,
            'alt' => $original_name,
            'absolute_path' => '/public' . $file_location,
            'relative_path' => $file_location,
            'gallery_id' => $gallery->id
        ]);

        return response()->json(compact('image'));
    }

    public function uploadImages(Request $request) {
        $rules = [
            'images' => 'required|array',
            'images.*' => 'file|mimes:jpg,jpeg,png|dimensions:min_width=800,min_height=800,max_width=1000,max_height=1000,ratio=1'
        ];
        $messages = [
            'images.required' => 'Las imagenes son requeridas.',
            'images.array' => 'Las imagenes son un formato no válido.',
            'images.*.file' => 'La imagen debe ser un archivo válido.',
            'images.*.mimes' => 'La imagen debe ser una de imagen válida (jpeg, jpg, png).',
            'images.*.dimensions' => 'La imagen debe tener dimensiones minimas de 800px, dimensiones máximas de 1000px con una relación de aspecto de 1:1 (cuadrada).',
        ];
        $request->validate($rules, $messages);
        $user_id = auth()->user()->id;
        $merchant = Merchant::where('owner_id', $user_id)->first();
        $merchant_id = $merchant->id;
        $merchant_name = str_replace(" ", "-", strtolower($merchant->name));
        $gallery = Gallery::where('merchant_id', $merchant_id)->where('type', 'product')->first();

        if(!$gallery) {
            $gallery = Gallery::create([
                'merchant_id' => $merchant_id,
                'type' => 'product',
            ]);
        }
        $images = $request->file('images');
        $uploaded_images = [];

        foreach($images as $image) {
            $original_format = $image->getClientOriginalExtension();
            $original_name = str_replace(".{$original_format}", "", $image->getClientOriginalName());
            $file_name = str_replace(" ", "-", strtolower($original_name)) . '_' . Carbon::now()->timestamp . '.' . $original_format;
            $file_location = "/{$this->upload_path}/{$merchant_name}/{$file_name}";
            $file_url = config('app.url') . $file_location;
            $image->move(public_path("{$this->upload_path}/{$merchant_name}"), $file_name);

            $uploaded_images[] = Image::create([
                'url' => $file_url,
                'name' => $file_name,
                'title' => $original_name,
                'absolute_path' => '/public' . $file_location,
                'relative_path' => $file_location,
                'gallery_id' => $gallery->id
            ]);
        }

        return response()->json(['images' => $uploaded_images]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();

        return response()->json(['error' => false]);
    }
}
