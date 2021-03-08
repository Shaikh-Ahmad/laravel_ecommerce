<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Input;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $q = $request->get( 'q' );
        $products= Product::latest()->where('title', 'LIKE', '%' . $q . '%')->paginate(25);
        return view('product.index', compact('products'));
        
        // $products = Product::latest()->paginate(25);
        // return view('product.index', compact('products'));
       
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('product.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'title' => 'required',
            'price' => 'required',
            'description' => 'required|max:300',
            'product_image' => 'nullable'
        ]);

       
            // handeling image file upload
            if ($request->hasFile('product_image')) {
                //get file name with extesion
                $fileNameWithExt = $request->file('product_image')->getClientOriginalName();
                //get just file name
                $fileName = pathinfo($fileNameWithExt,PATHINFO_FILENAME);
                //get just extension
                $extension =  $request->file('product_image')->getClientOriginalExtension();
                //filename to store
                $fileNameToStore =   $fileName.'_'.time().'.'.$extension;
                //uploadImage
                
                $path = $request->file('product_image')->storeAs('public/product_images',$fileNameToStore);
                }
                else
                {
                    $fileNameToStore = 'noimage.jpg';
                }


                $input_data=[
                    'title'=>$request->input('title'),
                    'description'=>$request->input('description'),
                    'price'=>$request->input('price'),
                    'product_image'=>  $fileNameToStore,
                ];
                
                Product::create($input_data);
                return redirect()->route('products.index')->with('success', 'Product created successfully');
        
            
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        $products = Product::inRandomOrder()->take(4)->get();
        return view('product.show')->with(compact('product','products'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        return view('product.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $product)
    {
        $request->validate([
            'description' => 'required',
            'title' => 'required',
            'price' => 'required',
        ]);

        
        // handeling image file upload
        if ($request->hasFile('product_image')) {
            //get file name with extesion
            $fileNameWithExt = $request->file('product_image')->getClientOriginalName();
            //get just file name
            $fileName = pathinfo($fileNameWithExt,PATHINFO_FILENAME);
            //get just extension
            $extension =  $request->file('product_image')->getClientOriginalExtension();
            //filename to store
            $fileNameToStore =   $fileName.'_'.time().'.'.$extension;
            //uploadImage
            
            $path = $request->file('product_image')->storeAs('public/product_images',$fileNameToStore);
            }
            else
            {
                $fileNameToStore = 'noimage.jpg';
            }

            $product = Product::find($product);
            $product->title = $request->input('title');
            $product->description = $request->input('description');
            $product->price = $request->input('price');
            

            if($request->hasFile('product_image')){
                if( $product->product_image != 'noimage.jpg')
                {
                    Storage::delete('public/product_images/'.$product->product_image);
                }
                $product->product_image = $fileNameToStore ;
            }

            $product->save();
            return redirect()->route('products.index')->with('success', 'Product created successfully');
        
        }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        if( $product->product_image != 'noimage.jpg')
        {
            Storage::delete('public/product_images/'.$product->product_image);
        }
        $product->delete();
        return redirect()->route('products.index')
            ->with('success', 'Product deleted successfully');
    }


}
