<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Event;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Lang;
use Captcha;
use Validator;
use Input;
use Sentinel;
use App\News;
use App\Page;
use App\EventComment;
use App\Http\Requests\EventCommentRequest;
use App\User;
use Share;

class EventsController extends Controller {

	protected $frontarray;

    public function __construct(){
        $this->frontarray['onenews'] = News::latest()->first();
        $this->frontarray['mainmenu']=Page::where('type','Main Menu')->get();
        $this->frontarray['OurExpertServices']=Page::where('type','Our Expert Services')->get();
    }
/**
     * @return \Illuminate\View\View
     */
    public function getIndexFrontend()
    {
        // Grab all the newss
        $events = Event::latest()->simplePaginate(5);
        $events->setPath('event');
       // $tags = $this->tags;
        // Show the page


        return View('events', compact('events'))->with('frontarray',$this->frontarray);
    }

    /**
     * @param string $slug
     * @return \Illuminate\View\View
     */
    public function getEventFrontend($slug = '')
    {
    	if(Sentinel::check()){
				$user=Sentinel::getUser();
			}
        if ($slug == '') {
            $event= Event::first();
            $reviewed=$event->reviews()->where('author_id',$user->id)->where('reviewable_id',$event->id)->first();
        }
        try {
            $event = Event::where('slug',$slug)->first();
            if(isset($user))
             $reviewed=$event->reviews()->where('author_id',$user->id)->where('reviewable_id',$event->id)->first();
         	else{
         		$reviewed=1;
         		$user=null;
         	}
            //$event->increment('views');
        } catch (ModelNotFoundException $e) {
            return Response::view('404', array(), 404);
        }

        $subject="Message on Ad-".$event->name;
		$users = User::where('id', '=', $event->user_id)->get();

		$adlink= "<a href=".url('event/'.$event->slug).">".$event->name."</a>";

			$share=Share::load(url('event/'.$event->slug), $event->name)->services('facebook', 'gplus', 'twitter','email','pinterest');

        
        // Show the page
        return View('event', compact('event','reviewed','user','users','share'))->with('frontarray',$this->frontarray);

    }

    /**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function createEventMenuFrontend()
	{
		return view('create_event_menu')->with('frontarray',$this->frontarray);
	}

	public function createEventFrontend()
	{
		return view('create_event')->with('frontarray',$this->frontarray);
	}

	public function reviewsmanagement()
	{
		if(Sentinel::check()){
			$user=Sentinel::getUser();
		}
		$events = Event::where('user_id',$user->id)->paginate(15);
		//$ads_category = Ads_category::lists('name', 'id');
		//dd($ads_category[1]);
		return view('events.managereviews', compact('events'));
	}

	public function viewereviews($id)
	{
		if(Sentinel::check()){
			$user=Sentinel::getUser();
		}
		$event = Event::where('id',$id)->where('user_id',$user->id)->first();
		//$ads_category = Ads_category::lists('name', 'id');
		//dd($ads_category[1]);
		return view('events.viewreviews', compact('event'));
	}

	



	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function storeFrontend(Request $request)
	{

		//echo $request->get('captcha');exit;
		if(Sentinel::check()){
			$user=Sentinel::getUser();
			$request->request->add(['user_id'=>$user->id]);
		}

		

		$rules = ['captcha' => 'required|captcha'];
            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails())
            {
                return redirect('create-event')->with('error', 'captcha error')->withInput();
                echo '<p style="color: #ff0000;">Incorrect!</p>';
                exit;
            }
		$event= new Event($request->except('photo_image','captcha'));
                		
                if ($request->hasFile('photo_image')) {
        			$file            = $request->file('photo_image');
        			$destinationPath =  public_path().'/uploads/crudfiles/';
        			$filename        = str_random(20) .'.' . $file->getClientOriginalExtension() ?: 'png';
        			$event->photo = $filename;
        			if ($request->hasFile('photo_image')) {
						$request->file('photo_image')->move($destinationPath, $filename);
					}
        		}

                		$event->save();
		return redirect('my-events')->with('success', Lang::get('message.success.create'))->withInput();
	}

	public function editevent($id,Request $request)
	{

		$event = Event::findOrFail($id);

		

		$rules = ['name' => 'required'];
            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails())
            {
                 return Redirect::route('edit-event')->withInput()->with('error', 'Event edit Failed');
            }
		//$event= new Event($request->all(''));
                		
                if ($request->hasFile('photo_image')) {
        			$file            = $request->file('photo_image');
        			$destinationPath =  public_path().'/uploads/crudfiles/';
        			$filename        = str_random(20) .'.' . $file->getClientOriginalExtension() ?: 'png';
        			$event->photo = $filename;
        			if ($request->hasFile('photo_image')) {
						$request->file('photo_image')->move($destinationPath, $filename);
					}
        		}

                $event->update($request->except('photo_image'));
		return redirect('edit-event/'.$id)->with('success', 'Edited Succesfully')->withInput();
	}

	public function deleteevent($id){
		$event = Event::destroy($id);

        // Redirect to the group management page
        return redirect('my-events')->with('success', Lang::get('message.success.delete'));
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function myevents()
	{
		if(Sentinel::check()){
			$user=Sentinel::getUser();
		}

		$events = Event::where('user_id',$user->id)->get();
		return view('events.my-events', compact('events'))->with('frontarray',$this->frontarray);
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function bookingmanagement()
	{
		if(Sentinel::check()){
			$user=Sentinel::getUser();
		}

		$events = Event::where('user_id',$user->id)->get();
		return view('ads.bookingmanagement', compact('events'))->with('frontarray',$this->frontarray);
	}

	public function showeditevent($event){
		if(Sentinel::check()){
			$user=Sentinel::getUser();
		}

		$event = Event::where('user_id',$user->id)->where('id',$event)->first();

		if($event==null){
			$event = Event::where('user_id',$user->id)->get();
			return view('events.my-events', compact('events'))->witherrors("Please select you event to edit");
		}

		//dd($event);exit;

		return view('events.edit-event', compact('event'))->with('frontarray',$this->frontarray);

	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{

		$events = Event::latest()->get();
		return view('admin.events.index', compact('events'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('admin.events.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
		$event= new Event($request->except('photo_image'));
                		
                if ($request->hasFile('photo_image')) {
        			$file            = $request->file('photo_image');
        			$destinationPath =  public_path().'/uploads/crudfiles/';
        			$filename        = str_random(20) .'.' . $file->getClientOriginalExtension() ?: 'png';
        			$event->photo = $filename;
        			if ($request->hasFile('photo_image')) {
						$request->file('photo_image')->move($destinationPath, $filename);
					}
        		}

                		$event->save();
		return redirect('admin/events')->with('success', Lang::get('message.success.create'));
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$event = Event::findOrFail($id);
		return view('admin.events.show', compact('event'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$event = Event::findOrFail($id);
		return view('admin.events.edit', compact('event'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id, Request $request)
	{
		$this->validate($request, ['name' => 'required']); // Uncomment and modify if needed.
		$event = Event::findOrFail($id);

                		/*if($request->has('')){
                        	$event->=1;
                        }
                        else{
                        	$event->=0;
                        }*/

                		
                if ($request->hasFile('photo_image')) {
        			$file            = $request->file('photo_image');
        			$destinationPath =  public_path().'/uploads/crudfiles/';
        			$filename        = str_random(20) .'.' . $file->getClientOriginalExtension() ?: 'png';
        			$event->photo = $filename;
        			if ($request->hasFile('photo_image')) {
						$request->file('photo_image')->move($destinationPath, $filename);
					}
        		}

                		$event->update($request->except('photo_image'));
		return redirect('admin/events')->with('success', Lang::get('message.success.update'));
	}

	/**
    	 * Delete confirmation for the given Event.
    	 *
    	 * @param  int      $id
    	 * @return View
    	 */
    	public function getModalDelete($id = null)
    	{
            $error = '';
            $model = '';
            $confirm_route =  route('admin.events.delete',['id'=>$id]);
            return View('admin/layouts/modal_confirmation', compact('error','model', 'confirm_route'));

    	}

    	/**
    	 * Sponsored the given Event.
    	 *
    	 * @param  int      $id
    	 * @return Redirect
    	 */
    	public function getSponsor($id = null)
    	{
    		$event = Event::find($id);
    		$event->issponsored=true;
    		$event->save();

            // Redirect to the group management page
            return redirect('admin/events')->with('success', 'sponsored');

    	}

    	/**
    	 * cancelSponsored the given Event.
    	 *
    	 * @param  int      $id
    	 * @return Redirect
    	 */
    	public function getcancelsponsor($id = null)
    	{
    		$event = Event::find($id);
    		$event->issponsored=false;
    		$event->save();

            // Redirect to the group management page
            return redirect('admin/events')->with('success', 'canceled sponsore');

    	}

    	/**
    	 * Delete the given Event.
    	 *
    	 * @param  int      $id
    	 * @return Redirect
    	 */
    	public function getDelete($id = null)
    	{
    		$event = Event::destroy($id);

            // Redirect to the group management page
            return redirect('admin/events')->with('success', Lang::get('message.success.delete'));

    	}

    	/**
     * @param EventCommentRequest $request
     * @param Event $event
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function storeCommentFrontend($events,EventCommentRequest $request)
    {
    	$event=Event::where('slug',$events)->first();
    	//dd($event);
    	//echo $events;exit;
        $eventcooment = new EventComment($request->all());
        $eventcooment->event_id = $event->id;
        $eventcooment->save();

        return redirect('event/' . $event->slug);
    }

    public function showmessages(){
    	if(Sentinel::check()){
			$user=Sentinel::getUser();
		}

		$events = Event::where('user_id',$user->id)->get();
	

    	return View('events.show_messages')->with('frontarray',$this->frontarray)->with('events',$events);
    }

    public function submitreview(request $request){
    		if(Sentinel::check()){
				$user=Sentinel::getUser();
			}
				$events = Event::find($request->get('id'));
				$review = $events->review([
				    'title' => $request->get('title'),
				    'body' => $request->get('body'),
				    'rating' => $request->get('rate'),
				], $user);


			return redirect('event/'.$events->slug)->with('success','Reviewed !!');
    	}

    	public function submitreviewagain(request $request){
			$events = Event::find($request->get('id'));


			$review = $events->updateReview($request->get('review_id'), [
			    'title' => $request->get('title'),
				 'body' => $request->get('body'),
				 'rating' => $request->get('rate'),
			]);



			return redirect('event/'.$events->slug)->with('success','Reviewed !!');
    	}

}