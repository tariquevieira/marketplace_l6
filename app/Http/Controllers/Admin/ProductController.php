<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Product;
use App\Store;
use App\Category;
use App\Http\Requests\ProductRequest;
use App\Traits\UploadTrait;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    use UploadTrait;

    private $product;
    private $paginate;
    private $user;
    


    public function __construct(Product $product)
    {
     
        $this->product = $product;
        $this->paginate = 10;
    }

    public function index()
    {
        if(!auth()->user()->store()->exists()) return redirect()->route('admin.stores.index');
        $store = auth()->user()->store;
        //use aqui para testar atributos
        $products = $store->products()->paginate($this->paginate);
        //dd($products);
        // $products = $this->product->paginate($this->paginate);
        return view('admin.products.index',compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all(['id','name']);

        return view('admin.products.create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        
        $data = $request->all();
        $store = auth()->user()->store;
        $product=$store->products()->create($data);
        $categories = $request->get('categories',null);
        $product->categories()->sync($categories);

        if($request->hasFile('photos')){
            $images = $this->imageUpload($request->file('photos'),'image');

        // inserir fotos na tabela fotos

            $product->photos()->createMany($images); 
        }

        flash('Produto Criado com Sucesso')->success();
        return redirect()->route('products.index');
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
    public function edit($product)
    {

        $product = $this->product->find($product);
        $categories = Category::all(['id','name']);
        return view('admin.products.edit',compact('product','categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $product
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, $product)
    {
        $data = $request->all();
        $product = $this->product->find($product);
        $product->update($data);
        $product->categories()->sync($data['categories']);

        
        if($request->hasFile('photos')){
            $images = $this->imageUpload($request->file('photos'),'image');

        // inserir fotos na tabela fotos
            
            $product->photos()->createMany($images); 
        }

        
        flash('Produto atualizado com Sucesso')->success();
        return redirect()->route('products.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($product)
    {
      $product = $this->product->find($product);
      $product->delete();
      
      flash('Produto apagado com Sucesso')->success();
      return redirect()->route('products.index');   
  }

  
}
