<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Resource;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Lang;

class ResourcesController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$resources = Resource::latest()->get();
		return view('admin.resources.index', compact('resources'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('admin.resources.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
		$resource= new Resource($request->except(''));
                		
                		$resource->save();
		return redirect('admin/resources')->with('success', Lang::get('message.success.create'));
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$resource = Resource::findOrFail($id);
		return view('admin.resources.show', compact('resource'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$resource = Resource::findOrFail($id);
		return view('admin.resources.edit', compact('resource'));
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
		$resource = Resource::findOrFail($id);

                		/*if($request->has('')){
                        	$resource->=1;
                        }
                        else{
                        	$resource->=0;
                        }
*/
                		
                		$resource->update($request->except(''));
		return redirect('admin/resources')->with('success', Lang::get('message.success.update'));
	}

	/**
    	 * Delete confirmation for the given Resource.
    	 *
    	 * @param  int      $id
    	 * @return View
    	 */
    	public function getModalDelete($id = null)
    	{
            $error = '';
            $model = '';
            $confirm_route =  route('admin.resources.delete',['id'=>$id]);
            return View('admin/layouts/modal_confirmation', compact('error','model', 'confirm_route'));

    	}

    	/**
    	 * Delete the given Resource.
    	 *
    	 * @param  int      $id
    	 * @return Redirect
    	 */
    	public function getDelete($id = null)
    	{
    		$resource = Resource::destroy($id);

            // Redirect to the group management page
            return redirect('admin/resources')->with('success', Lang::get('message.success.delete'));

    	}

}