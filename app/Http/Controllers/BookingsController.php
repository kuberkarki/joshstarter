<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Booking;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Lang;

class BookingsController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$bookings = Booking::latest()->get();
		return view('admin.bookings.index', compact('bookings'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('admin.bookings.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
		$booking= new Booking($request->except(''));
                		
                		$booking->save();
		return redirect('admin/bookings')->with('success', Lang::get('message.success.create'));
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$booking = Booking::findOrFail($id);
		return view('admin.bookings.show', compact('booking'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$booking = Booking::findOrFail($id);
		return view('admin.bookings.edit', compact('booking'));
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
		$booking = Booking::findOrFail($id);

                		if($request->has('')){
                        	$booking->=1;
                        }
                        else{
                        	$booking->=0;
                        }

                		
                		$booking->update($request->except(''));
		return redirect('admin/bookings')->with('success', Lang::get('message.success.update'));
	}

	/**
    	 * Delete confirmation for the given Booking.
    	 *
    	 * @param  int      $id
    	 * @return View
    	 */
    	public function getModalDelete($id = null)
    	{
            $error = '';
            $model = '';
            $confirm_route =  route('admin.bookings.delete',['id'=>$id]);
            return View('admin/layouts/modal_confirmation', compact('error','model', 'confirm_route'));

    	}

    	/**
    	 * Delete the given Booking.
    	 *
    	 * @param  int      $id
    	 * @return Redirect
    	 */
    	public function getDelete($id = null)
    	{
    		$booking = Booking::destroy($id);

            // Redirect to the group management page
            return redirect('admin/bookings')->with('success', Lang::get('message.success.delete'));

    	}

}