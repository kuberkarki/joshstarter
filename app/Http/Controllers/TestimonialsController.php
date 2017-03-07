<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Testimonial;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Lang;

class TestimonialsController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$testimonials = Testimonial::latest()->get();
		return view('admin.testimonials.index', compact('testimonials'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('admin.testimonials.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
		$testimonial= new Testimonial($request->except(''));
                		
                		$testimonial->save();
		return redirect('admin/testimonials')->with('success', Lang::get('message.success.create'));
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$testimonial = Testimonial::findOrFail($id);
		return view('admin.testimonials.show', compact('testimonial'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$testimonial = Testimonial::findOrFail($id);
		return view('admin.testimonials.edit', compact('testimonial'));
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
		$testimonial = Testimonial::findOrFail($id);

                		/*if($request->has('')){
                        	$testimonial->=1;
                        }
                        else{
                        	$testimonial->=0;
                        }*/

                		
                		$testimonial->update($request->except(''));
		return redirect('admin/testimonials')->with('success', Lang::get('message.success.update'));
	}

	/**
    	 * Delete confirmation for the given Testimonial.
    	 *
    	 * @param  int      $id
    	 * @return View
    	 */
    	public function getModalDelete($id = null)
    	{
            $error = '';
            $model = '';
            $confirm_route =  route('admin.testimonials.delete',['id'=>$id]);
            return View('admin/layouts/modal_confirmation', compact('error','model', 'confirm_route'));

    	}

    	/**
    	 * Delete the given Testimonial.
    	 *
    	 * @param  int      $id
    	 * @return Redirect
    	 */
    	public function getDelete($id = null)
    	{
    		$testimonial = Testimonial::destroy($id);

            // Redirect to the group management page
            return redirect('admin/testimonials')->with('success', Lang::get('message.success.delete'));

    	}

}