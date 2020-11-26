<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Auth;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        DB::table('products')->insert([
            'product_type_id' => $request->product_type_id,
            'user_id' => $request->user_id,
            'product_name' => $request->product_name,
            'description' => $request->description,
            'product_picture' => $request->product_picture,
            'price' => $request->price,
            'units' => $request->units,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        return "New Product Created";
    }

    public function index()
    {
        return Product::all();
    }

    public function create(Request $request)
    {
        /*$product = new Product;

        $product ->id_product_type = $request->id_product_type;
        $product ->id_user = $request->id_user;
        $product ->product_name = $request->product_name;
        $product ->price = $request->price;
        $product ->units = $request->units;
        $product->save();


        return "New Product Created";*/
        echo "View Create";
    }

    public function destroy($id)
    {
        $product = Product::find($id);
        $product->delete();

        return "Product Deleted";
    }

    public function update(Request $request, $id)
    {
        $product = Product::find($id);

        $product->product_type_id = $request->product_type_id;
        $product->user_id = $request->user_id;
        $product->product_name = $request->product_name;
        $product->price = $request->price;
        $product->units = $request->units;
        $product->description = $request->description;
        $product->product_picture = $request->product_picture;
        $product->updated_at = date('Y-m-d H:i:s');
        $product->save();

        return "Product Updated";
    }

    public function show($id)
    {
        $product = Product::find($id);

        return response()->json($product);
    }

    public function edit($id)
    {
        echo 'edit_product';
    }

    public function search(Request $request)
    {
        $search = $request->search;
        $id = $request->id;
        //$search = $request->getContent();
        //$search = explode("search=", $search);
        //$product = DB::table('products')
        //->where('product_name','like',"%".$search."%")
        //->paginate();
        $product = Product::where('user_id', $id) 
                            ->where('product_name', 'LIKE', '%' . $search . '%')->get();

        return response()->json($product, 200);
    }

    public function searchByUserID(Request $request)
    {
        $id = $request->id;
        $product = Product::where('user_id', $id)->get();

        return response()->json($product, 200);
    }

    public function productStock(Request $request)
    {
        $id = $request->id;
        //$product = Product::where('user_id', $id)->get();

        $product = DB::table('products')
        -> leftJoin('product_details', 'product_details.product_id', '=', 'products.id') 
        -> select('products.id', 'product_name', 'price', 'product_picture', DB::raw('sum(product_details.product_quantity) as total'))
        -> where('user_id', $id) 
        -> groupBy('products.id', 'products.product_name', 'products.price', 'products.product_picture') 
        -> get();

        return response()->json($product, 200);
    }

    public function product()
    {
        $data = Product::all();
        return response()->json($data, 200);
    }

    public function productAuth()
    {
        $data = "Welcome " . Auth::User()->username;
        return response()->json($data, 200);
    }

    //public function __invoke(Request $request)
    //{
    //
    //}
}
