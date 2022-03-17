<?php

namespace App\Http\Controllers\Api\News;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Models\ProductCategory;

class ProductCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $productCategories = ProductCategory::paginate(10);
        $success['productCategories'] = $productCategories;
        return $this->sendResponse($success, 'Product Category retrive successfully.');
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
            $productCategory = $request->all();
            $productCategory['created_by']    = Auth::user()->id;
            $productCategory['updated_by']    = Auth::user()->id;
            $productCategory['slug']          = preg_replace("/[~`{}.'\"\!\@\#\$\%\^\&\*\(\)\_\=\+\/\?\>\<\,\[\]\:\;\|\\\]/","-", $request->name);
            ProductCategory::create($productCategory);
            $success['productCategory'] = $productCategory;
            return $this->sendResponse($success, 'Product Category successfully created.');
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
        $productCategory = ProductCategory::find($id);
        $success['productCategory'] = $productCategory;
        return $this->sendResponse($success, 'Product Category successfully created.');
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
            $productCategory = $request->all();
            $productCategory['created_by']    = Auth::user()->id;
            $productCategory['updated_by']    = Auth::user()->id;
            $productCategory['slug']          = preg_replace("/[~`{}.'\"\!\@\#\$\%\^\&\*\(\)\_\=\+\/\?\>\<\,\[\]\:\;\|\\\]/","-", $request->name);
            ProductCategory::where('id',$id)->update($productCategory);
            $success['productCategory'] = $productCategory;
            return $this->sendResponse($success, 'Product Category successfully updated.');
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
        $deleted = ProductCategory::where('id',$id)->delete($id);
        $success['deleted'] = $deleted;
        return $this->sendResponse($success, 'Product Category successfully deleted.');
    }
}
