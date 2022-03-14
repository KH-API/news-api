<?php

namespace App\Http\Controllers\Api\News;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Models\ProductStatus;
use Illuminate\Support\Facades\Auth;

class ProductStatusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $productStatus = ProductStatus::paginate(10);
        $success['productStatus'] = $productStatus;
        return $this->sendResponse($success, 'Product Status retrive successfully.');
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
            $productStatus = $request->all();
            $productStatus['created_by']    = Auth::user()->id;
            $productStatus['updated_by']    = Auth::user()->id;
            ProductStatus::create($productStatus);
            $success['productStatus'] = $productStatus;
            return $this->sendResponse($success, 'Product Status successfully created.');
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
        $productStatus = ProductStatus::find($id);
        $success['productStatus'] = $productStatus;
        return $this->sendResponse($success, 'Product Status retrive successfully.');
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
            $productStatus = $request->all();
            $productStatus['created_by']    = Auth::user()->id;
            $productStatus['updated_by']    = Auth::user()->id;
            ProductStatus::where('id',$id)->update($productStatus);
            $success['productStatus'] = $productStatus;
            return $this->sendResponse($success, 'Product Status successfully updated.');
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
        $deleted = ProductStatus::where('id',$id)->delete($id);
        $success['deleted'] = $deleted;
        return $this->sendResponse($success, 'Product Status successfully deleted.');
    }
}
