<?php

namespace App\Http\Controllers\Api\News;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Models\ProductAttribute;

class ProductAttributeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $productAttribute = ProductAttribute::paginate(10);
        $success['productAttribute'] = $productAttribute;
        return $this->sendResponse($success, 'Product Attribute retrive successfully.');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $productAttribute = $request->all();
            $productAttribute['created_by']    = Auth::user()->id;
            $productAttribute['updated_by']    = Auth::user()->id;
            ProductAttribute::create($productAttribute);
            $success['productAttribute'] = $productAttribute;
            return $this->sendResponse($success, 'Product Attribute successfully created.');
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
        $productAttribute = ProductAttribute::find($id);
        $success['productAttribute'] = $productAttribute;
        return $this->sendResponse($success, 'Product Attribute retrive successfully.');
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
            $productAttribute = $request->all();
            $productAttribute['created_by']    = Auth::user()->id;
            $productAttribute['updated_by']    = Auth::user()->id;
            ProductAttribute::where('id',$id)->update($productAttribute);
            $success['productAttribute'] = $productAttribute;
            return $this->sendResponse($success, 'Product Attribute successfully created.');
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
        $deleted = ProductAttribute::where('id',$id)->delete($id);
        $success['deleted'] = $deleted;
        return $this->sendResponse($success, 'Product Attribute successfully deleted.');
    }
}
