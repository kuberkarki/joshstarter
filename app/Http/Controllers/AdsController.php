<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Ad;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Lang;

class AdsController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$ads = Ad::latest()->get();
		return view('admin.ads.index', compact('ads'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('admin.ads.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
		$ad= new Ad($request->except(''));
                		
                		$ad->save();
		return redirect('admin/ads')->with('success', Lang::get('message.success.create'));
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$ad = Ad::findOrFail($id);
		return view('admin.ads.show', compact('ad'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$ad = Ad::findOrFail($id);
		return view('admin.ads.edit', compact('ad'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id, Request $request)
	{
		//$this->validate($request, ['name' => 'required']); // Uncomment and modify if needed.
		$ad = Ad::findOrFail($id);

                		/*if($request->has('')){
                        	$ad->=1;
                        }
                        else{
                        	$ad->=0;
                        }*/

                		
                		$ad->update($request->except(''));
		return redirect('admin/ads')->with('success', Lang::get('message.success.update'));
	}

	/**
    	 * Delete confirmation for the given Ad.
    	 *
    	 * @param  int      $id
    	 * @return View
    	 */
    	public function getModalDelete($id = null)
    	{
            $error = '';
            $model = '';
            $confirm_route =  route('admin.ads.delete',['id'=>$id]);
            return View('admin/layouts/modal_confirmation', compact('error','model', 'confirm_route'));

    	}

    	/**
    	 * Delete the given Ad.
    	 *
    	 * @param  int      $id
    	 * @return Redirect
    	 */
    	public function getDelete($id = null)
    	{
    		$ad = Ad::destroy($id);

            // Redirect to the group management page
            return redirect('admin/ads')->with('success', Lang::get('message.success.delete'));

    	}

}