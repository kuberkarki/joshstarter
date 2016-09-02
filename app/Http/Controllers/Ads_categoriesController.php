<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Ads_category;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Lang;
use Sentinel;

class Ads_categoriesController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//$user=Sentinel::getUser();
		$ads_categories = Ads_category::latest()->get();
		return view('admin.ads_categories.index');
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('admin.ads_categories.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
		$ads_category= new Ads_category($request->except(''));
                		
                		$ads_category->save();
		return redirect('admin/ads_categories')->with('success', Lang::get('message.success.create'));
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$ads_category = Ads_category::findOrFail($id);
		return view('admin.ads_categories.show', compact('ads_category'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$ads_category = Ads_category::findOrFail($id);
		return view('admin.ads_categories.edit', compact('ads_category'));
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
		$ads_category = Ads_category::findOrFail($id);

                		/*if($request->has('')){
                        	$ads_category->=1;
                        }
                        else{
                        	$ads_category->=0;
                        }*/

                		
                		$ads_category->update($request->except(''));
		return redirect('admin/ads_categories')->with('success', Lang::get('message.success.update'));
	}

	/**
    	 * Delete confirmation for the given Ads_category.
    	 *
    	 * @param  int      $id
    	 * @return View
    	 */
    	public function getModalDelete($id = null)
    	{
            $error = '';
            $model = '';
            $confirm_route =  route('admin.ads_categories.delete',['id'=>$id]);
            return View('admin/layouts/modal_confirmation', compact('error','model', 'confirm_route'));

    	}

    	/**
    	 * Delete the given Ads_category.
    	 *
    	 * @param  int      $id
    	 * @return Redirect
    	 */
    	public function getDelete($id = null)
    	{
    		$ads_category = Ads_category::destroy($id);

            // Redirect to the group management page
            return redirect('admin/ads_categories')->with('success', Lang::get('message.success.delete'));

    	}

}