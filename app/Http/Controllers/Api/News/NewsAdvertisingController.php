<?php

namespace App\Http\Controllers\Api\News;

use Illuminate\Http\Request;
use App\Models\NewsAdvertising;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\NewsAdvertisingRequest;
use App\Http\Requests\UpdateNewsAdvertisingRequest;

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
    public function store(NewsAdvertisingRequest $request)
    {
        $data = $request->all();
        if($request->hasFile('ads_image')) {
            $image = $request->file('ads_image');
            $filename = $image->getClientOriginalName();
            $image->move(public_path('uploads/advertising'), $filename);
        }
        $data['created_by']    = Auth::user()->id;
        $data['updated_by']    = Auth::user()->id;
        # Move Image
        $data['ads_image'] = $filename;
        NewsAdvertising::create($data);
        return response()->json(['success'=>true,'message'=>'Advertising successfully created.']);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $advertising = NewsAdvertising::find($id);
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
    public function update(UpdateNewsAdvertisingRequest $request, $id)
    {
        $data = $request->all();
        if($request->hasFile('ads_image')) {
            $image = $request->file('ads_image');
            $filename = $image->getClientOriginalName();
            $image->move(public_path('uploads/advertising'), $filename);
        }else{
            $filename = $request->old_ads_image;
        }
        # Move Image
        $data['ads_image']     = $filename;
        $data['created_by']    = Auth::user()->id;
        $data['updated_by']    = Auth::user()->id;
        $data['is_active']     = 1;
        NewsAdvertising::where('id',$id)->update($data);
        return response()->json(['success'=>true,'message'=>'Advertising successfully updated.']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deleted = NewsAdvertising::where('id',$id)->delete($id);
        # Delete Image
        $success['deleted'] = $deleted;
        return $this->sendResponse($success, 'Advertising successfully deleted.');
    }
}
