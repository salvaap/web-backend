<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Attribute;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request) {
        $categories = Category::where('parent_id', null)->get();
        return view('site.index', compact('categories'));
    }

    public function filters(Request $request) {
        $cid = (int) $request->get('cid');
        $sub_category = ($request->get('sub_cat')) ? (int) $request->get('sub_cat') : null;
        $categories = Category::select('id', 'name', 'parent_id');
        $attributes = Attribute::select('id', 'name');

        if($cid) {
            $categories = $categories->where('parent_id', $cid);
            if($sub_category) {
                $attributes = $attributes->whereHas('values', function($query) use ($sub_category) {
                    $query->whereHas('variants', function($query) use ($sub_category) {
                        $query->whereHas('product', function($query) use ($sub_category) {
                            $query->whereHas('category', function($query) use ($sub_category) {
                                $query->where('id', $sub_category);
                            });
                        });
                    });
                });
            } else {
                $attributes = $attributes->whereHas('values', function($query) use ($cid) {
                    $query->whereHas('variants', function($query) use ($cid) {
                        $query->whereHas('product', function($query) use ($cid) {
                            $query->whereHas('category', function($query) use ($cid) {
                                $query->where('parent_id', $cid);
                            });
                        });
                    });
                });
            }
        }

        $categories = $categories->get();
        $attributes = $attributes->with(['values' => function($query) use ($cid) {
            $query->whereHas('variants', function($query) use ($cid) {
                $query->whereHas('product', function($query) use ($cid) {
                    $query->whereHas('category', function($query) use ($cid) {
                        $query->where('parent_id', $cid);
                    });
                });
            })->select('id', 'name', 'attribute_id');
        }])->get();

        return response()->json(compact('categories', 'attributes'));
    }

    public function catalog(Request $request) {
        $items_per_page = 18;
        $s = ($request->get('s')) ? trim($request->get('s')) : null;
        $category_id = ($request->get('category_id')) ? trim($request->get('category_id')) : null;
        $sub_category = ($request->get('sub_category')) ? trim($request->get('sub_category')) : null;
        //$sub_categories = ($request->get('sub_categories')) ? json_decode($request->get('sub_categories')) : null;
        $values = ($request->get('values')) ? json_decode($request->get('values')) : null;
        $page = ($request->get('page')) ? (int) ($request->get('page')) - 1 : 0;
        $offset = (int) $page * $items_per_page;
        $items = Product::select('id', 'name', 'is_variant', 'description', 'featured_image', 'published_at', 'category_id')
            ->orderBy('id', 'ASC')
            ->with(['variants' => function($query) {
                $query->orderBy('price', 'ASC')->with(['product', 'values']);
            }]);

        if($s) {
            $items = $items->whereRaw("LOWER(name) like LOWER('%{$s}%')");
        }

        if($category_id) {
            $items = $items->whereHas('category', function($query) use ($category_id) {
                $query->where('parent_id', $category_id);
            });
        }

        if($sub_category) {
            $items = $items->whereHas('category', function($query) use ($sub_category) {
                $query->where('id', $sub_category);
            });
        }

        if($values) {
            $items = $items->whereHas('variants', function($query) use ($values) {
                $query->whereHas('values', function($query) use ($values) {
                    $query->whereIn('value_id', $values);
                });
            });
        }

        $total_count = $items->get()->count();
        $items = $items->offset($offset)->limit($items_per_page)->get();

        return response()->json(compact('total_count', 'items'));
    }
}
