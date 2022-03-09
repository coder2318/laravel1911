<?php

namespace App\Http\Controllers;

use App\Http\Requests\Product\StoreRequest;
use App\Http\Requests\Product\UpdateRequest;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request) // get
    {
        $products = Product::query()->with('category');  //get(), all()


        if($request->search){
            $products = $products->where('name', 'like', '%'.$request->search.'%');
        }
        if(isset($request->status)){
            $products = $products->where('status', $request->status);
        }
        $products = $products->get();

        // dd($products);

        // dd($products);
        return view('products.index', ['products' => $products]); //compact('products')
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() //get
    {
        $categories = Category::get();
        return view('products.create', ['categories' => $categories]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request) //post
    {
        $image_name = time() .'.'. $request->file('image')->getClientOriginalExtension();
        $request->file('image')->storeAs('/public/images', $image_name);

        $images = null;
        if(sizeof($request->file('images')) > 0){
            $image_names = [];
            foreach($request->file('images') as $key => $item){
                $file_names = time() .'_'.$key.'.'. $item->getClientOriginalExtension(); // 787238374_0.jpg
                $item->storeAs('/public/images', $file_names);
                $image_names[] = $file_names;
            }
            $images = implode(',', $image_names); // '4244234_0.jpg, 4244234_1.jpg, 4244234_2.jpg'
        }

        $cat = null;
        if($request->cat_name){
            $cat = Category::create([

                'name' => $request->cat_name
            ]);
        }

        //session, cookie
        $data = [
            'name' => $request->name,
            'price' => $request->price,
            'weight' => $request->weight,
            'status' => $request->status,
            'category_id' => $cat ? $cat->id : $request->category_id,
            'image' => $image_name??'',
            'images' => $images??'',
        ];

        Product::create($data);


        return redirect()->route('product.index');
    }


    public function show(Product $product) //get
    {
        return view('products.show', ['item' => $product]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product) //get
    {
        $categories = Category::get();

        return view('products.edit', ['product' => $product, 'categories' => $categories]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, Product $product) //put
    {
        // dd($request);
        $image_name = null;
        if($request->image && $request->file('image')){
            $image_name = time() .'.'. $request->file('image')->getClientOriginalExtension();
            $request->file('image')->storeAs('/public/images', $image_name);
            unlink('storage/images/'.$product->image);
        }

        $images = null;
        if(isset($request->images)){
            if(sizeof($request->file('images')) > 0):
                $image_names = [];
                foreach($request->file('images') as $key => $item){
                    $file_names = time() .'_'.$key.'.'. $item->getClientOriginalExtension(); // 787238374_0.jpg
                    $item->storeAs('/public/images', $file_names);
                    $image_names[] = $file_names;
                }
                $images = implode(',', $image_names); // '4244234_0.jpg, 4244234_1.jpg, 4244234_2.jpg'

                if($product->images){
                    $old_images = explode(',', $product->images);
                    foreach($old_images as $value){
                        unlink('storage/images/'.$value);
                    }
                }
            endif;
        }

        $data = [
            'name' => $request->name,
            'price' => $request->price,
            'weight' => $request->weight,
            'status' => $request->status,
            'category_id' => $request->category_id,
            'image' => $image_name ?? $product->image, //  $image_name ? $image_name : $product->image,
            'images' => $images??$product->images
        ];
        $product->update($data);
        return redirect()->route('product.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) //delete
    {
        $product = Product::where('id', '=', $id)->first();
        $product->delete();

        return redirect()->route('product.index');
    }

    //CRUD => Create Read Update Delete

    public function category()
    {
        $category = Category::with('product')->get();
        dd($category);
    }
}
