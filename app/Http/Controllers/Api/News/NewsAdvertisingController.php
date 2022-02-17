<?php

namespace App\Http\Controllers\Api\News;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Models\NewsAdvertising;

class NewsAdvertisingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $advertising = NewsAdvertising::paginate(10);
        $success['advertising'] = $advertising;
        return $this->sendResponse($success, 'Advertising retrive successfully.');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required'
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $advertising = new NewsAdvertising;

        $advertising->advertising   = $request->parent_level;
        $advertising->name          = $request->name;
        $advertising->ads_image     = $request->ads_image;
        $advertising->ads_link      = $request->ads_link;
        $advertising->ads_position  = $request->ads_position;
        $advertising->start_date    = $request->start_date;
        $advertising->end_date      = $request->end_date;
        $advertising->created_by    = Auth::user()->id;
        $advertising->save();
        # Move Image
        $success['advertising'] = $advertising;
        return $this->sendResponse($success, 'Advertising successfully created.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $advertising = NewsCategory::find($id);
        $success['advertising'] = $advertising;
        return $this->sendResponse($success, 'Advertising retrive successfully.');
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
        $validator = Validator::make($request->all(), [
            'name' => 'required'
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $advertising = NewsAdvertising::find($id);

        $advertising->advertising   = $request->parent_level;
        $advertising->name          = $request->name;
        $advertising->ads_image     = $request->ads_image;
        $advertising->ads_link      = $request->ads_link;
        $advertising->ads_position  = $request->ads_position;
        $advertising->start_date    = $request->start_date;
        $advertising->end_date      = $request->end_date;
        $advertising->updated_by    = Auth::user()->id;
        $advertising->save();
        # Delete Image

        # Upload Image

        $success['advertising'] = $advertising;
        return $this->sendResponse($success, 'Advertising successfully updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deleted = NewsAdvertising::delete($id);
        # Delete Image
        $success['deleted'] = $deleted;
        return $this->sendResponse($success, 'Advertising successfully deleted.');
    }
}
