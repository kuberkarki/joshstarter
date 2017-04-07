<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Event_anouncement;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Lang;
use Sentinel;

class Event_anouncementsController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$event_anouncements = Event_anouncement::latest()->get();
		return view('admin.event_anouncements.index', compact('event_anouncements'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('admin.event_anouncements.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{

		//dd($request->event_id);

		if(Sentinel::check()){
				$user=Sentinel::getUser();
			}

		$event=\App\Event::find($request->event_id);


		
		$request->request->add(
			[
				'user_id'=>$user->id,
				'parent_id'=>NULL
			]
			);

		

		$event_anouncement= new Event_anouncement($request->except(''));
                		
        $event_anouncement->save();
		return redirect('event/'.$event->slug)->with('success', "Anouncement successfully posted");
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function storevideo(Request $request)
	{

		//dd($request->event_id);

		if(Sentinel::check()){
				$user=Sentinel::getUser();
			}

		$event=\App\Event::find($request->event_id);


		
		$request->request->add(
			[
				'user_id'=>$user->id,
				'parent_id'=>NULL,
				'post_type'=>'video'
			]
			);

		

		$event_anouncement= new Event_anouncement($request->except(''));
                		
        $event_anouncement->save();
		return redirect('event/'.$event->slug)->with('success', "Anouncement video successfully posted");
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function storephoto(Request $request)
	{

		//dd($request->event_id);

		if(Sentinel::check()){
				$user=Sentinel::getUser();
			}

			if ($file = $request->file('photo')) {
            $fileName = $file->getClientOriginalName();
            $extension = $file->getClientOriginalExtension() ?: 'png';
            $folderName = '/uploads/crudfiles/';
            $destinationPath = public_path() . $folderName;
            $safeName = str_random(10) . '.' . $extension;
            $file->move($destinationPath, $safeName);
            $request['description'] = $safeName;
        }

       // dd($description);



		$event=\App\Event::find($request->event_id);


		
		$request->request->add(
			[
				'user_id'=>$user->id,
				'parent_id'=>NULL,
				'post_type'=>'photo',
				'description'=>$request['description']
			]
			);

		//dd($request);

		

		$event_anouncement= new Event_anouncement($request->except('photo'));
                		
        $event_anouncement->save();
		return redirect('event/'.$event->slug)->with('success', "Anouncement video successfully posted");
	}


	public function storereply(Request $request)
	{

		//dd($request);

		if(Sentinel::check()){
				$user=Sentinel::getUser();
			}

			



		$event=\App\Event::find($request->event_id);


		
		$request->request->add(
			[
				'user_id'=>$user->id,
				'parent_id'=>$request->anouncement_id,
				'description'=>$request['description']
			]
			);

		//dd($request);

		

		$event_anouncement= new Event_anouncement($request->except('anouncement_id'));
                		
        $event_anouncement->save();
		return redirect('event/'.$event->slug)->with('success', "Anouncement video successfully posted");
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$event_anouncement = Event_anouncement::findOrFail($id);
		return view('admin.event_anouncements.show', compact('event_anouncement'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$event_anouncement = Event_anouncement::findOrFail($id);
		return view('admin.event_anouncements.edit', compact('event_anouncement'));
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
		$event_anouncement = Event_anouncement::findOrFail($id);

                		/*if($request->has('')){
                        	$event_anouncement->=1;
                        }
                        else{
                        	$event_anouncement->=0;
                        }*/

                		
                		$event_anouncement->update($request->except(''));
		return redirect('admin/event_anouncements')->with('success', Lang::get('message.success.update'));
	}

	/**
    	 * Delete confirmation for the given Event_anouncement.
    	 *
    	 * @param  int      $id
    	 * @return View
    	 */
    	public function getModalDelete($id = null)
    	{
            $error = '';
            $model = '';
            $confirm_route =  route('admin.event_anouncements.delete',['id'=>$id]);
            return View('admin/layouts/modal_confirmation', compact('error','model', 'confirm_route'));

    	}

    	/**
    	 * Delete the given Event_anouncement.
    	 *
    	 * @param  int      $id
    	 * @return Redirect
    	 */
    	public function getDelete($id = null)
    	{
    		$event_anouncement = Event_anouncement::destroy($id);

            // Redirect to the group management page
            return redirect('admin/event_anouncements')->with('success', Lang::get('message.success.delete'));

    	}

    	public function deleteanouncement($id=null){

    		//dd($request);

		if(Sentinel::check()){
				$user=Sentinel::getUser();
			}

			$anouncement=Event_anouncement::find($id);

			$event=\App\Event::find($anouncement->event_id);

			if($user->id==$anouncement->user_id){
				$event_anouncement = Event_anouncement::destroy($id);
			}
			return redirect('event/'.$event->slug)->with('success', "Post successfully deleted");

    	}

}