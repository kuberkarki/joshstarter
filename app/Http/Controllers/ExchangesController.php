<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Exchange;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Lang;

class ExchangesController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$exchanges = Exchange::latest()->get();
		return view('admin.exchanges.index', compact('exchanges'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('admin.exchanges.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
		$exchange= new Exchange($request->except(''));
                		
                		$exchange->save();
		return redirect('admin/exchanges')->with('success', Lang::get('message.success.create'));
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$exchange = Exchange::findOrFail($id);
		return view('admin.exchanges.show', compact('exchange'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$exchange = Exchange::findOrFail($id);
		return view('admin.exchanges.edit', compact('exchange'));
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
		$exchange = Exchange::findOrFail($id);

                		/*if($request->has('')){
                        	$exchange->=1;
                        }
                        else{
                        	$exchange->=0;
                        }*/

                		
                		$exchange->update($request->except(''));
		return redirect('admin/exchanges')->with('success', Lang::get('message.success.update'));
	}

	/**
    	 * Delete confirmation for the given Exchange.
    	 *
    	 * @param  int      $id
    	 * @return View
    	 */
    	public function getModalDelete($id = null)
    	{
            $error = '';
            $model = '';
            $confirm_route =  route('admin.exchanges.delete',['id'=>$id]);
            return View('admin/layouts/modal_confirmation', compact('error','model', 'confirm_route'));

    	}

    	/**
    	 * Delete the given Exchange.
    	 *
    	 * @param  int      $id
    	 * @return Redirect
    	 */
    	public function getDelete($id = null)
    	{
    		$exchange = Exchange::destroy($id);

            // Redirect to the group management page
            return redirect('admin/exchanges')->with('success', Lang::get('message.success.delete'));

    	}

}