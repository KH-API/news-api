<?php

namespace App\Http\Controllers\Api\News;

use Illuminate\Http\Request;
use App\Models\Models\Product;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $product = Product::paginate(10);
        $success['product'] = $product;
        return $this->sendResponse($success, 'Product retrive successfully.');
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
        try {
            if($request->hasFile('product_photo')) {
                $image = $request->file('product_photo');
                $filename = $image->getClientOriginalName();
                $image->move(public_path('uploads/products'), $filename);
            }
            $product = $request->all();
            $product['status_id']       = 1;
            $product['product_photo']   = $filename;
            $product['created_by']      = Auth::user()->id;
            $product['updated_by']      = Auth::user()->id;
            Product::create($product);
            $success['product'] = $product;
            return $this->sendResponse($success, 'Product successfully created.');
            DB::commit();
        } catch (\Throwable $exp) {
            DB::rollBack();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::find($id);
        $success['product'] = $product;
        return $this->sendResponse($success, 'Product successfully created.');
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
        try {
            if($request->hasFile('product_photo')) {
                $image = $request->file('product_photo');
                $filename = $image->getClientOriginalName();
                $image->move(public_path('uploads/products'), $filename);
            }else{
                $filename = $request->old_product_photo;
            }
            $product = $request->all();
            $product['status_id']       = 1;
            $product['product_photo']   = 1;
            $product['created_by']      = Auth::user()->id;
            $product['updated_by']      = Auth::user()->id;
            Product::where('id',$id)->update($product);
            $success['product'] = $product;
            return $this->sendResponse($success, 'Product successfully updated.');
            DB::commit();
        } catch (\Throwable $exp) {
            DB::rollBack();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deleted = Product::where('id',$id)->delete($id);
        $success['deleted'] = $deleted;
        return $this->sendResponse($success, 'Product Category successfully deleted.');
    }
}
