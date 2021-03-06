<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Ad;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Lang;
use App\Ads_category;
use Sentinel;
use Validator;
use App\Ads_photos;
use App\Ads_prices;
use App\Ads_services;
use Redirect;
use URL;
use willvincent\Rateable\Rateable;
use App\User;
use Share;
use App\Booking;
use Session;
use DB;
use App\Event;
use Helper;
use App\Withdrawl;

class AdsController extends Controller {
	private $objFoo;
	public function __construct(Ad $foo){
         $this->objFoo = $foo;
     }

	public function search(request $request){
		$query=$request->get('keyword');
		$location=$request->get('location');
		$date=$request->get('date');
		
	 if($request->get('type')=='business'){
	 	$isbusinesssearch=1;//$request->get('business');
	 	$iseventsearch=0;
	 }else{
	 	$iseventsearch=1;
	 	$isbusinesssearch=0;
	 }
	 

	 $ads=$events=$ads_category=null;


		if($isbusinesssearch){
			if($date){
				$ads = Ad::search($query)
				->leftJoin('bookings', function($join) use($date){
									
		                             $join->on('bookings.ads_id', '=', 'ads.id');
		                             $join->on('book_date','<>',DB::raw("'$date'"));
		                            
		                         })->select(array('ads.*','ads_id','book_date'))->Where('location', 'like', '%' . $location . '%')->groupBy('ads.id')->orderBy('ads.id')->paginate(3);


		     }
		     else{
				$ads = Ad::search($query)->Where('location', 'like', '%' . $location . '%')->orderBy('ads.id')->paginate(3);
			}
				$ads_category=Ads_category::all();
		}

		if($iseventsearch){
			if($date){
				$events = Event::search($query)
				/*->Join('bookings', function($join) use($date){
									
		                             $join->on('bookings.ads_id', '=', 'ads.id');
		                             $join->on('book_date','<>',DB::raw("'$date'"));
		                            
		                         })->select(array('ads.*','ads_id','book_date'))*/->Where('location', 'like', '%' . $location . '%')->groupBy('events.id')->orderBy('date')->paginate(3);

		                         


		     }
		     else{
				$events = Event::search($query)->Where('location', 'like', '%' . $location . '%')->orderBy('date')->paginate(3);
			}
				
		}







		return view('ads.search',compact('ads','ads_category','query','events','location','date','iseventsearch','isbusinesssearch'));

		//dd($ads);
	}

	public function moreevents(request $request){



		$query=$request->get('keyword');
		$location=$request->get('location');
		$date=$request->get('date');
		
	 if($request->get('type')=='business'){
	 	$isbusinesssearch=1;//$request->get('business');
	 	$iseventsearch=0;
	 }else{
	 	$iseventsearch=1;
	 	$isbusinesssearch=0;
	 }
	 

	 $ads=$events=$ads_category=null;


		if($isbusinesssearch){
			if($date){
				$ads = Ad::search($query)
				->leftJoin('bookings', function($join) use($date){
									
		                             $join->on('bookings.ads_id', '=', 'ads.id');
		                             $join->on('book_date','<>',DB::raw("'$date'"));
		                            
		                         })->select(array('ads.*','ads_id','book_date'))->Where('location', 'like', '%' . $location . '%')->groupBy('ads.id')->paginate(15);


		     }
		     else{
				$ads = Ad::search($query)->Where('location', 'like', '%' . $location . '%')->paginate(15);
			}
				$ads_category=Ads_category::all();
		}

		if($iseventsearch){
			if($date){
				$events = Event::search($query)
				/*->Join('bookings', function($join) use($date){
									
		                             $join->on('bookings.ads_id', '=', 'ads.id');
		                             $join->on('book_date','<>',DB::raw("'$date'"));
		                            
		                         })->select(array('ads.*','ads_id','book_date'))*/->Where('location', 'like', '%' . $location . '%')->groupBy('events.id')->paginate(15);


		     }
		     else{
				$events = Event::search($query)->Where('location', 'like', '%' . $location . '%')->paginate(15);
			}
				
		}

		$e='';
		foreach($events as $event){
			$e .='<div class="col-sm-4 unique-class">'.$event->name.'</div>';
		}



		
        return response($e,200);
    
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function listadscategory(Request $request)
	{
		$ads_category=Ads_category::all();
		return view('ads.listadscategory', compact('ads_category'));
	}


	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function ads($slug=null,Request $request)
	{
		$from= $request->get('from');
		$to=$request->get('to');
		if($slug){
			$adscategory=Ads_category::where('slug',$slug)->first();
			if(!$adscategory){
				$ads=Ad::all();
			}
			else{
				if($from>$to){
					$ads=array();
				}
				if($from && $to){
					$ads=array();

						$ads_raw=Ad::where('ads_category_id',$adscategory->id)->get();

						foreach($ads_raw as $ad){

							$bookings=Booking::where('ads_id',$ad->id)->whereBetween('book_date', [$from, $to])->get();

							//echo count($bookings);
							if(count($bookings)==0){
								$ads[]=$ad;
							}

		                             
										
						}
					/*$startTime = strtotime( $from );
							$endTime = strtotime( $to );
					$query='(';

					for ( $i = $startTime; $i <= $endTime; $i = $i + 86400 ) {
							  $thisDate = date( 'Y-m-d', $i ); // 2010-05-01, 2010-05-02, etc

							  if($i!=$startTime){
							  	$query .=" And ";
							  }
							  $query .=" `bookings`.book_date <> '$thisDate' " ;
							}
					$query .=')';

					
					$ads=Ad::where('ads_category_id',$adscategory->id)

						 ->leftJoin('bookings', function($join) use($from,$to){
									
		                             $join->on('bookings.ads_id', '=', 'ads.id');
		                             //$join->on('book_date','<>',DB::raw("'$to'"));
		                             $startTime = strtotime( $from );
									$endTime = strtotime( $to );

		                             for ( $i = $startTime; $i <= $endTime; $i = $i + 86400 ) {
									  $thisDate = date( 'Y-m-d', $i ); // 2010-05-01, 2010-05-02, etc
									  $join->on('book_date','<>',DB::raw("'$thisDate'"));
									}
		                            
		                         })->select(array('ads.*','ads_id','book_date'))->groupBy('ads.id')->paginate(12);
					*//*->leftJoin('bookings',function($q) use($from,$to){

							$q->on('bookings.ads_id', '=', 'ads.id');
							//$q->whereBetween('book_date', [$from, $to]);
							$startTime = strtotime( $from );
							$endTime = strtotime( $to );

							// Loop between timestamps, 24 hours at a time
							for ( $i = $startTime; $i <= $endTime; $i = $i + 86400 ) {
							  $thisDate = date( 'Y-m-d', $i ); // 2010-05-01, 2010-05-02, etc
							  $q->on('book_date','<>',DB::raw($thisDate));
							}

							//$q->groupBy('ads_id');

						})*/
					/*->leftJoin(
					        DB::raw("
					            (select
					                * From `bookings`
					            where ".$query."
					            group by `bookings`.`ads_id`) `bookings`
					        "), 'ads.id', '=', 'bookings.ads_id'
					    )
					->groupBy('ads_id')->paginate(12);*/
					
				}elseif($request->get('rating')){
					$ads=array();
						$ads_raw=Ad::where('ads_category_id',$adscategory->id)->get();

						foreach($ads_raw as $ad){
							if($ad->avragereviews()==$request->get('rating')){
								$ads[]=$ad;
							}
						}

				}elseif($request->get('price')){
					$ads=array();
					$pricerange=explode('-',$request->get('price'));

					if(is_numeric($pricerange[0]))
						$minprice=Helper::exchangeToUSD($pricerange[0]);
					if(is_numeric($pricerange[1]))
						$maxprice=Helper::exchangeToUSD($pricerange[1]);
					else
						$maxprice=999999999999;

					$ads_raw=Ad::where('ads_category_id',$adscategory->id)->get();

						foreach($ads_raw as $ad){
							if($ad->price_type=='Fixed'){
								if($ad->price>=$minprice && $ad->price<=$maxprice){
									$ads[]=$ad;
								}

							}else{
								if(count($ad->prices()->first())){
									$pricelist=($ad->prices()->orderBy('ads_prices.price','DESC')->get());
									//dd($pricelist[0]);
									
                      				if($minprice>=$pricelist[0]->price && $maxprice<=$pricelist[count($pricelist)-1]->price){
                      					$ads[]=$ad;
                      				}
                      			}

							}
							
						}
					
					
					//$ads=array();

					/*$ads_raw=Ad::where('ads_category_id',$adscategory->id)->where(function($q) use($minprice,$maxprice){
                    	$q->where('price','>=',DB::raw($minprice));
                    if($maxprice>0)
                    	$q->where('price','<=',DB::raw($maxprice));*/
                    //$q->orWhere('ticket_price','=','Free');
                
				}
				else{
					$ads=Ad::where('ads_category_id',$adscategory->id)->get()/*->paginate(12)*/;
				}
			}
		}
		else
			$ads = Ad::all();//paginate(12);
		$ads_category = Ads_category::all();



		//dd($ads_category);
		//dd($ads_category[1]);
		return view('ads.ads', compact('ads','ads_category'));
	}

	public function postbook(request $request){
		
		$id=$request->get('id');
		$dates=$request->get('dates');

		$bookdata = ['ads_id' => $id, 'dates' => $dates];
		Session::forget('bookData');
    	Session::set('bookData', $bookdata); // use set() not push()

    	if(!Sentinel::check()){
    		return redirect('login');
    	}

		

		$ad=Ad::find($id);
		return view('ads.book',compact('ad','dates'));

	}

	public function blockad(request $request){
		
		$id=$request->get('ads');
		$dates=$request->get('date');
		//echo $dates;exit;


		$bookdata = ['ads_id' => $id, 'dates' => $dates];
		//Session::forget('bookData');
    	//Session::set('bookData', $bookdata); // use set() not push()

    	if(!Sentinel::check()){
    		return redirect('login');
    	}

		

		$ad=Ad::find($id)->where('user_id',Sentinel::getUser()->id);

		if(!$ad){
			return redirect()->route('bookings-detail',array($id,$dates))->with('error', 'Ads Can\'t be blocked');
		}

		$booking=Booking::where('book_date',$dates)->where('ads_id',$id)->first();

		

		if($booking){
			return redirect()->route('bookings-detail',array($id,$dates))->with('error', 'Ads Already Blocked or Booked');
		}


			$booking=new booking();
			$booking->ads_id=$id;
			$booking->book_date=$dates;
			$booking->price=0;
			$booking->user_id=Sentinel::getUser()->id;
			$booking->save();
		

		return redirect()->route('bookings-detail',array($id,$dates))->with('success', 'Successfully Blocked');
		

	}
	public function getbook(request $request){

		if(!Session::get('bookData')){
			redirect('/');
		}
		$id=Session::get('bookData.ads_id');;
		$dates=Session::get('bookData.dates');
		$ad=Ad::find($id);
		return view('ads.book',compact('ad','dates'));

	}

	public function submitbook(request $request){

		$dates=explode(',',$request->get('dates'));

		foreach($dates as $date){
			$booking=new booking();
			$booking->ads_id=$request->get('ads_id');
			$booking->book_date=$date;
			$booking->price=$request->get('price');
			$booking->user_id=Sentinel::getUser()->id;
			$booking->save();
		}

		return redirect('/')->with('success', 'Successfully Booked');


		
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function indexFrontend(){

		if(Sentinel::check()){
			$user=Sentinel::getUser();
		}
		$ads = Ad::where('user_id',$user->id)->with('booking')->paginate(15);
		$ads_category = Ads_category::lists('name', 'id');

		
		//dd($ads_category[1]);
		return view('ads.index', compact('ads','ads_category'));
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
		$ads = Ad::where('user_id',$user->id)->paginate(15);
		$ads_category = Ads_category::lists('name', 'id');

		foreach($ads as $ad){
			$calendar[$ad->id]=$this->draw_calendar(date('m'),date('Y'),$ad->id);
		}
		//dd($ads_category[1]);
		return view('ads.managebooking', compact('ads','ads_category','calendar'));
	}

	public function reviewsmanagement()
	{
		if(Sentinel::check()){
			$user=Sentinel::getUser();
		}
		$ads = Ad::where('user_id',$user->id)->paginate(15);
		$ads_category = Ads_category::lists('name', 'id');
		//dd($ads_category[1]);
		return view('ads.managereviews', compact('ads','ads_category'));
	}



	public function viewereviews($id)
	{
		if(Sentinel::check()){
			$user=Sentinel::getUser();
		}
		$ad = Ad::where('id',$id)->where('user_id',$user->id)->first();
		$ads_category = Ads_category::lists('name', 'id');
		//dd($ads_category[1]);
		return view('ads.viewreviews', compact('ad','ads_category'));
	}

	public function totalrevenue()
	{
		if(Sentinel::check()){
			$user=Sentinel::getUser();
		}
		$ads = Ad::where('user_id',$user->id)->with('booking')->get();
		//$ads_category = Ads_category::lists('name', 'id');
		$total_earnings=$withdrawl_total=0;
		
		foreach($ads as $ad){
			foreach($ad->booking as $book){
                                $total_earnings += $book->price;
                                
                            }
		}
		$withdrawls=Withdrawl::where('user_id',$user->id)->where('approved',1)->get();

		foreach($withdrawls as $withdrawl){
			$withdrawl_total +=$withdrawl->amount;
		}
		//$total_earnings=20000;
		//$withdrawls=5000;
		$expenses=0;
		$pending_clearence=$total_earnings-$withdrawl_total;
		$available_balance=$pending_clearence-$expenses;
		
		return view('ads.totalrevenue', compact('ads','ads_category','total_earnings','withdrawl_total','expenses','pending_clearence','available_balance'));
	}

	public function withdrawrequest(Request $request){
		if(Sentinel::check()){
			$user=Sentinel::getUser();
		}
		$ads = Ad::where('user_id',$user->id)->with('booking')->get();
		//$ads_category = Ads_category::lists('name', 'id');
		$total_earnings=$withdrawl_total=0;
		
		foreach($ads as $ad){
			foreach($ad->booking as $book){
                                $total_earnings += $book->price;
                                
                            }
		}
		$withdrawls=Withdrawl::where('user_id',$user->id)->where('approved',1)->get();

		foreach($withdrawls as $withdrawl){
			$withdrawl_total +=$withdrawl->amount;
		}
		//$total_earnings=20000;
		//$withdrawls=5000;
		$expenses=0;
		$pending_clearence=$total_earnings-$withdrawl_total;
		$available_balance=$pending_clearence-$expenses;

		if($request->get('amount')>$available_balance){
			return redirect('total-revenue')->with('error', 'Try again!! Amount is too high');
		}

		if($request->get('amount')<100){
			return redirect('total-revenue')->with('error', 'Try again!! Amount is too low');
		}

		$withdraw['amount']=$request->get('amount');
		$withdraw['description']=$request->get('type');
		$withdraw['date']=date('Y-m-d');
		$withdraw['user_id']=$user->id;
		$withdraw['approved']=0;

		$withdraw = new Withdrawl;

        $withdraw->amount = $request->get('amount');
        $withdraw->description = $request->get('type');
        $withdraw->date = date('Y-m-d');
        $withdraw->user_id = $user->id;
        $withdraw->approved = 0;

        $withdraw->save();
        return redirect('total-revenue')->with('success', 'Withdrawl Request Sent');

	}

	public function approvewithdrawl(Request $request){

		$id=$request->get('id');

		$withdrawl=Withdrawl::find($id);
		$withdrawl->approved=1;
		$withdrawl->remarks=$request->get('comment');
		$withdrawl->save();
		return redirect('admin/withdrawl')->with('success', 'Withdrawl Request approved');



	}

	public function disapprovewithdrawl(Request $request){

		$id=$request->get('id');

		$withdrawl=Withdrawl::find($id);
		$withdrawl->approved=0;
		$withdrawl->remarks=$request->get('comment');
		$withdrawl->save();
		return redirect('admin/withdrawl')->with('success', 'Withdrawl Request disapproved');



	}



	public function getWithdrawlReqest(){
		$withdrawls=Withdrawl::where('approved',0)->with('user')->get();
		//$user=User::find($withdrawls->user_id);
		return view('admin.withdrawls',compact('withdrawls','user'));
	}

	


	/**
	 * Show the form for creating a new Ads.
	 *
	 * @return Response
	 */
	public function createFrontend()
	{
		$ads_category = Ads_Category::lists('name', 'id');
		return view('ads.create',compact('ads_category'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function storeFrontend(Request $request)
	{

		

		$photos=($request['mytext']);
		$prices=$request['myprice'];
		$guests=$request['myguest'];
		$services=$request['services'];
		$serviceprices=$request['serviceprice'];



		$galimage=array();
		$galprice=array();$serprice=array();

		 
		
		//echo $request->get('captcha');exit;
		if(Sentinel::check()){
			$user=Sentinel::getUser();
			$request->request->add(['user_id'=>$user->id]);
		}

		$messsages = array(
        'ads_category_id.required'=>'You cant leave Category empty',
		 'mytext.0.max'=>'You cant have images 1 file larger than 2mb',
		 'mytext.1.max'=>'You cant have images 2 file larger than 2mb',
		 'mytext.2.max'=>'You cant have images 3 file larger than 2mb',
		 'mytext.3.max'=>'You cant have images 4 file larger than 2mb',
		 'mytext.4.max'=>'You cant have images 5 file larger than 2mb',
		 'mytext.5.max'=>'You cant have images 6 file larger than 2mb',
		 'mytext.6.max'=>'You cant have images 7 file larger than 2mb',
		 'mytext.7.max'=>'You cant have images 8 file larger than 2mb',
		 'mytext.8.max'=>'You cant have images 9 file larger than 2mb',
		 'mytext.9.max'=>'You cant have images 10 file larger than 2mb',
		 'mytext.10.max'=>'You cant have images 11 file larger than 2mb',
		 );


		$rules=[
            'title' => 'min:3',
            'content' => 'min:3',
            'photo_image' => 'max:2000',
            //'mytext' => 'array|each|max:2000',
            'ads_category_id'=>'required',
		];
			 // $this->validate($request, [
			 //        'title' => 'required',
	
			 //    ]);

			 // Create a new validator instance from our validation rules
        $validator = Validator::make($request->all(), $rules,$messsages);

        $validator->each('mytext', ['max:2000']);


        // If validation fails, we'll exit the operation now.
        if ($validator->fails()) {
            // Ooops.. something went wrong
            return Redirect::to(URL::previous() )->withInput()->withErrors($validator);
        }

		$ad= new Ad($request->except('photo_image','mytext','myprice','myguest','services','serviceprice'));
		if ($request->hasFile('photo_image')) {
        			$file            = $request->file('photo_image');
        			$destinationPath =  public_path().'/uploads/crudfiles/';
        			$filename        = str_random(20) .'.' . $file->getClientOriginalExtension() ?: 'png';
        			$ad->photo = $filename;
        			if ($request->hasFile('photo_image')) {
						$request->file('photo_image')->move($destinationPath, $filename);
					}
        		}
                		
        $ad->save();

        if(count($photos) && $request['mytext'][0]){
        	for($i=0; $i<count($photos); $i++){
        			$file=( $request['mytext'][$i]);
        			$destinationPath =  public_path().'/uploads/crudfiles/';
        			$filename        = str_random(20) .'.' . $file->getClientOriginalExtension() ?: 'png';
        			//$ad->photo = $filename;
        			if ($file) {
						$file->move($destinationPath, $filename);
					}
					$galimage[]=array('ads_id'=>$ad->id,'photo'=>$filename);
        			//echo $photo["temp_name"];
        			//echo $file            = $_FILES["fileToUpload"]["tmp_name"];
        			//$destinationPath =  public_path().'/uploads/crudfiles/';
        			//$filename        = str_random(20) .'.' . $file->getClientOriginalExtension() ?: 'png';
        			//$ad->photo = $filename;
        		//$galimage[]=array('ads_id'=>$ad->id,'photo'=>$filename);
        	}

        	  Ads_photos::insert($galimage);
        }
      

        if(count($prices) && $request['myprice'][0]!=''){
        	for($i=0; $i<count($prices); $i++){
        			$price=(int)( $request['myprice'][$i]);
        			$guest=( $request['myguest'][$i]);

        			if($i==0)
        				$minguest=0;
        			else
        				$minguest=(int)( $request['myguest'][$i-1]);

        			$maxguest=(int)$request['myguest'][$i];
        			
					$galprice[]=array('ads_id'=>$ad->id,'minguest'=>$minguest,'maxguest'=>$maxguest,'price'=>$price);
        			//echo $photo["temp_name"];
        			//echo $file            = $_FILES["fileToUpload"]["tmp_name"];
        			//$destinationPath =  public_path().'/uploads/crudfiles/';
        			//$filename        = str_random(20) .'.' . $file->getClientOriginalExtension() ?: 'png';
        			//$ad->photo = $filename;
        		//$galimage[]=array('ads_id'=>$ad->id,'photo'=>$filename);
        	}
        	 Ads_prices::insert($galprice);
        }

         if(count($services) && $request['services'][0]!=''){
        	for($i=0; $i<count($services); $i++){
        			$price=(int)( $request['serviceprice'][$i]);
        			$service=( $request['services'][$i]);

        			

        			
        			
					$serprice[]=array('ads_id'=>$ad->id,'price'=>$price,'name'=>$service);
        			//echo $photo["temp_name"];
        			//echo $file            = $_FILES["fileToUpload"]["tmp_name"];
        			//$destinationPath =  public_path().'/uploads/crudfiles/';
        			//$filename        = str_random(20) .'.' . $file->getClientOriginalExtension() ?: 'png';
        			//$ad->photo = $filename;
        		//$galimage[]=array('ads_id'=>$ad->id,'photo'=>$filename);
        	}
        	 Ads_services::insert($serprice);
        }

        //$ad->id;

		return redirect('ads')->with('success', Lang::get('message.success.create'));
	}

	/**
	 * Delete the given Ad.
	 *
	 * @param  int      $id
	 * @return Redirect
	 */
	public function deleteads($id = null)
	{
		$ad = Ad::destroy($id);

	    // Redirect to the group management page
	    return redirect('ads')->with('success', Lang::get('message.success.delete'));

	}




/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function showeditads($id)
	{
		$ad = Ad::findOrFail($id);
		if(Sentinel::check()){
			$user=Sentinel::getUser();
		}
		if($ad->user_id!=$user->id)
			return redirect('ads')->with('error','Error');
		$ads_category = Ads_Category::lists('name', 'id');

		$events = [];


		//print_r($ad->photos()->get());

		return view('ads.edit', compact('ad','ads_category','calendar'));
	}

	public function manageads($id,Request $request){
		
		if(Sentinel::check()){
			$user=Sentinel::getUser();
		}

		$ad = Ad::where('id',$id)->where('user_id',$user->id)->first();
		//dd($ad);

		if(!$ad)
			return redirect('ads')->with('error','Error');

		$bookings=Booking::where('ads_id',$id)->groupBy('book_date')->orderBy('book_date','DESC')->with('user')->get();

		$calendar=$this->draw_calendar(date('m'),date('Y'),$ad->id);

		

		return view('ads.manage', compact('ad','bookings','user','calendar'));
	}

	public function bookingdetail($id,$date,Request $request){
		
		if(Sentinel::check()){
			$user=Sentinel::getUser();
		}

		$ad = Ad::where('id',$id)->where('user_id',$user->id)->first();
		//dd($ad);

		if(!$ad)
			return redirect('ads')->with('error','Error');

		$bookings=Booking::where('ads_id',$id)->where('book_date',$date)->orderBy('book_date','DESC')->with('user')->first();
		$calendar=$this->draw_calendar(date('m'),date('Y'),$ad->id);

		

		return view('ads.bookingdetail', compact('ad','bookings','user','date','calendar'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function editads($id, Request $request)
	{
		$photos=($request['mytext']);
		$prices=$request['myprice'];
		$guests=$request['myguest'];
		$galimage=array();
		$galprice=array();

		//dd($request['mytext'][0]);

		//$this->validate($request, ['name' => 'required']); // Uncomment and modify if needed.
		$ad = Ad::findOrFail($id);
		if(Sentinel::check()){
			$user=Sentinel::getUser();
		}

		 $messsages = array(
        'ads_category_id.required'=>'You cant leave Category empty',
		 'mytext.0.max'=>'You cant have images 1 file larger than 2mb',
		 'mytext.1.max'=>'You cant have images 2 file larger than 2mb',
		 'mytext.2.max'=>'You cant have images 3 file larger than 2mb',
		 'mytext.3.max'=>'You cant have images 4 file larger than 2mb',
		 'mytext.4.max'=>'You cant have images 5 file larger than 2mb',
		 'mytext.5.max'=>'You cant have images 6 file larger than 2mb',
		 'mytext.6.max'=>'You cant have images 7 file larger than 2mb',
		 'mytext.7.max'=>'You cant have images 8 file larger than 2mb',
		 'mytext.8.max'=>'You cant have images 9 file larger than 2mb',
		 'mytext.9.max'=>'You cant have images 10 file larger than 2mb',
		 'mytext.10.max'=>'You cant have images 11 file larger than 2mb',
		 );


		$rules=[
            'title' => 'min:3',
            'content' => 'min:3',
            'photo_image' => 'max:2000',
            //'mytext' => 'array|each|max:2000',
            'ads_category_id'=>'required',
		];
			 // $this->validate($request, [
			 //        'title' => 'required',
	
			 //    ]);

			 // Create a new validator instance from our validation rules
        $validator = Validator::make($request->all(), $rules,$messsages);

        $validator->each('mytext', ['max:2000']);


        // If validation fails, we'll exit the operation now.
        if ($validator->fails()) {
            // Ooops.. something went wrong
            return Redirect::to(URL::previous() )->withInput()->withErrors($validator);
        }


		if($ad->user_id!=$user->id)
			return redirect('ads')->with('error','Error');

                if ($request->hasFile('photo_image')) {
        			$file            = $request->file('photo_image');
        			$destinationPath =  public_path().'/uploads/crudfiles/';
        			$filename        = str_random(20) .'.' . $file->getClientOriginalExtension() ?: 'png';
        			$ad->photo = $filename;
        			if ($request->hasFile('photo_image')) {
						$request->file('photo_image')->move($destinationPath, $filename);
					}
        		}

        		//dd($request); 

                $ad->update($request->except('photo_image','mytext','myprice','myguest','services','serviceprice'));

                //dd('test');


             if(count($photos) && $request['mytext'][0]){
        	for($i=0; $i<count($photos); $i++){
        			$file=( $request['mytext'][$i]);
        			$destinationPath =  public_path().'/uploads/crudfiles/';
        			$filename        = str_random(20) .'.' . $file->getClientOriginalExtension() ?: 'png';
        			//$ad->photo = $filename;
        			if ($file) {
						$file->move($destinationPath, $filename);
					}
					$galimage[]=array('ads_id'=>$ad->id,'photo'=>$filename);
        			//echo $photo["temp_name"];
        			//echo $file            = $_FILES["fileToUpload"]["tmp_name"];
        			//$destinationPath =  public_path().'/uploads/crudfiles/';
        			//$filename        = str_random(20) .'.' . $file->getClientOriginalExtension() ?: 'png';
        			//$ad->photo = $filename;
        		//$galimage[]=array('ads_id'=>$ad->id,'photo'=>$filename);
        	}
        	 Ads_photos::insert($galimage);
        }

        if(count($prices) && $request['myprice'][0]!=''){
        	for($i=0; $i<count($prices); $i++){
        			$price=(int)( $request['myprice'][$i]);
        			$guest=( $request['myguest'][$i]);

        			if($i==0)
        				$minguest=0;
        			else
        				$minguest=(int)( $request['myguest'][$i-1]);

        			$maxguest=(int)$request['myguest'][$i];
        			
					$galprice[]=array('ads_id'=>$ad->id,'minguest'=>$minguest,'maxguest'=>$maxguest,'price'=>$price);
        			//echo $photo["temp_name"];
        			//echo $file            = $_FILES["fileToUpload"]["tmp_name"];
        			//$destinationPath =  public_path().'/uploads/crudfiles/';
        			//$filename        = str_random(20) .'.' . $file->getClientOriginalExtension() ?: 'png';
        			//$ad->photo = $filename;
        		//$galimage[]=array('ads_id'=>$ad->id,'photo'=>$filename);
        	}
        	 Ads_prices::insert($galprice);
        }
		return redirect('ads')->with('success', Lang::get('message.success.update'));
	}

	public function adsdetail($slug)
	{

		$ad = Ad::where('slug',$slug)->first();
		$ads_category=Ads_category::lists('name','id');
		$reviewable=false;
		if(Sentinel::check()){
				$user=Sentinel::getUser();
				$reviewed=$ad->reviews()->where('author_id',$user->id)->where('reviewable_id',$ad->id)->first();

				$chk=Booking::where('user_id',$user->id)->where('ads_id',$ad->id)->first();
				if($chk){
					$reviewable=true;
				}
			}
		$ad->view();
			if(!isset($reviewed))
				$reviewed=0;

		//$users=array($ad->user_id);
			$subject="Message on Ad-".$ad->title;
			$users = User::where('id', '=', $ad->user_id)->get();
			$adlink= "<a href=".url('ads-detail/'.$ad->slug).">".$ad->title."</a>";

			$share=Share::load(url('ads-detail/'.$ad->slug), $ad->title)->services('facebook', 'gplus', 'twitter','email','pinterest');

			$owner=$ad->owner()->first();


		$otherads=Ad::where('ads_category_id',$ad->ads_category_id)->limit(5)->get();


			//print_r($ad->owner()->first()->company_name);exit;;


		//echo count($users);exit;

		
		return view('ads.adsdetail', compact('ad','ads_category','reviewed','users','subject','share','owner','otherads','reviewable'));
	}

		/**
    	 * Delete the given Ad image.
    	 *
    	 * @param  int      $id
    	 * @return Redirect
    	 */
    	public function deleteadsimage(request $request)
    	{
    		$id=$request->get('id');
    		$ad = Ads_photos::destroy($id);
    		$return["response"] = json_encode("Deleted");
  			echo json_encode($return);

            // Redirect to the group management page
            //return rdeleteadsedirect('ads')->with('success', Lang::get('message.success.delete'));

    	}

    	public function submitreview(request $request){
    		if(Sentinel::check()){
				$user=Sentinel::getUser();
			}
				$ads = Ad::find($request->get('id'));
				$review = $ads->review([
				    'title' => $request->get('title'),
				    'body' => $request->get('body'),
				    'rating' => $request->get('rate'),
				], $user);


			return redirect('ads-detail/'.$ads->slug)->with('success','Reviewed !!');
    	}

    	public function submitreviewagain(request $request){
			$ads = Ad::find($request->get('id'));


			$review = $ads->updateReview($request->get('review_id'), [
			    'title' => $request->get('title'),
				 'body' => $request->get('body'),
				 'rating' => $request->get('rate'),
			]);



			return redirect('ads-detail/'.$ads->slug)->with('success','Reviewed !!');
    	}

    	public function rateads(request $request){
    		$id=$request->get('id');
    		$rate=(int)$request->get('rating');

    		if(Sentinel::check()){
				$user=Sentinel::getUser();
			}else
			return false;

    		$ads = Ad::find($id);

			$rating = new \willvincent\Rateable\Rating;
			$rating->rating = $rate;
			$rating->user_id = $user->id;

			$ads->ratings()->save($rating);

			//dd(Post::first()->ratings);
			//
			$return['total']=count($ads->ratings);
			$return['average']=$ads->averageRating;
    		



    		//$ad = Ads_photos::destroy($id);
    		$return["response"] = json_encode($return);
  			echo json_encode($return);
    	}

    	/**
    	 * Delete the given Ad image.
    	 *
    	 * @param  int      $id
    	 * @return Redirect
    	 */
    	public function deleteadsprice(request $request)
    	{
    		$id=$request->get('id');
    		$ad = Ads_prices::destroy($id);
    		$return["response"] = json_encode("Deleted");
  			echo json_encode($return);

            // Redirect to the group management page
            //return rdeleteadsedirect('ads')->with('success', Lang::get('message.success.delete'));

    	}

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

	public function ajaxadsdetail($id,$date){
		$ad = Ad::findOrFail($id);
		$ads_category = Ads_category::lists('name', 'id');
		$date=$date;
		return view('ads.ajaxdetail', compact('ad','ads_category','date'));

	}

	public function ajaxadsbookingdetail($id){
		$ad = Ad::findOrFail($id);
		$ads_category = Ads_category::lists('name', 'id');
		//$date=$date;
		return view('ads.ajaxbookingdetail', compact('ad','ads_category'));

	}

	public function ajaxadsbookingmanagementdetail($id,$date){
		$ad = Ad::findOrFail($id);
		/*echo time();
		echo "<br/>";
		echo $date;
		echo "<br/>";
		$date=date('Y-m-d',$date);
		echo $date;*/
		$ads_category = Ads_category::lists('name', 'id');
		$booking=Booking::where('ads_id',$id)->where('book_date',$date)->first();
		//dd($booking);
		$user=User::findOrFail($booking->user_id);
		//dd($user);

		//$date=$date;
		return view('ads.ajaxbookingmanagementdetail', compact('ad','ads_category','booking','user'));

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

    	public /* draws a calendar */
function draw_calendar($month,$year,$id){
	
	
	if(Sentinel::check()){
			$user=Sentinel::getUser();
		}

			/*$youttimestring=date('Y').'-'.date('m').'-28';
			$currentday=Carbon::createFromFormat('Y-m-d',$youttimestring);
			echo $currentday;
			if($bookings->contains('book_date', $youttimestring)){
				echo "here";
			}else
			echo "there";
			exit;*/


	/* draw table */
	$calendar = '<table cellpadding="0" cellspacing="0" class="calendar">';

	/* table headings */
	$headings = array('Sun','Mon','Tue','Wed','Thu','Fri','Sat');
	$calendar.= '<tr class="calendar-row"><td class="calendar-day-head">'.implode('</td><td class="calendar-day-head">',$headings).'</td></tr>';

	/* days and weeks vars now ... */
	$running_day = date('w',mktime(0,0,0,$month,1,$year));
	$days_in_month = date('t',mktime(0,0,0,$month,1,$year));
	$days_in_this_week = 1;
	$day_counter = 0;
	$dates_array = array();

	/* row for week one */
	$calendar.= '<tr class="calendar-row">';

	/* print "blank" days until the first of the current week */
	for($x = 0; $x < $running_day; $x++):
		$calendar.= '<td class="calendar-day-np"> </td>';
		$days_in_this_week++;
	endfor;

	/* keep going with days.... */
	for($list_day = 1; $list_day <= $days_in_month; $list_day++):
		$calendar.= '<td class="calendar-day">';
			/* add in the day number */

			$youttimestring=date('Y').'-'.date('m').'-'.$list_day;
			//$bookings=Booking::where('ads_id',$id)->groupBy('book_date')->whereMonth( DB::raw('book_date'), '=', date('m') )->with('user')->get();
			$booking=Booking::where('ads_id',$id)->groupBy('book_date')->where( DB::raw('book_date'), '=', $youttimestring )->with('user')->get();
			//$youttimestring
			//$currentday=Carbon::parse(Carbon::createFromFormat('Y-m-d',$youttimestring));
			if($booking->contains('book_date', $youttimestring)){
				if($booking->contains('user_id',$user->id))
					$calendar.= '<div class="day-number blocked"><a href="'.url('bookings-detail',array($id,$youttimestring)).'"   data-id="{{ $id  }}">'.$list_day.'</a></div>';
				else
				$calendar.= '<div class="day-number booked" ><a href="'.url('bookings-detail',array($id,$youttimestring)).'">'.$list_day.'</a></div>';
			}
			else
				$calendar.= '<div class="day-number"><a href="'.url('bookings-detail',array($id,$youttimestring)).'" data-post="data-php" data-action="empty"  data-id="{{ $id  }}"  >'.$list_day.'</a></div>';
			

			/** QUERY THE DATABASE FOR AN ENTRY FOR THIS DAY !!  IF MATCHES FOUND, PRINT THEM !! **/
			$calendar.= str_repeat('<p> </p>',2);
			
		$calendar.= '</td>';
		if($running_day == 6):
			$calendar.= '</tr>';
			if(($day_counter+1) != $days_in_month):
				$calendar.= '<tr class="calendar-row">';
			endif;
			$running_day = -1;
			$days_in_this_week = 0;
		endif;
		$days_in_this_week++; $running_day++; $day_counter++;
	endfor;

	/* finish the rest of the days in the week */
	if($days_in_this_week < 8):
		for($x = 1; $x <= (8 - $days_in_this_week); $x++):
			$calendar.= '<td class="calendar-day-np"> </td>';
		endfor;
	endif;

	/* final row */
	$calendar.= '</tr>';

	/* end the table */
	$calendar.= '</table>';
	
	/* all done, return result */
	return $calendar;
}

 public function loadModal($id, $action)
    {
       //return view for specified action
       //if action is delete, call this view, etc...
        //return View::make('ads.modal_'.$action)->render();
        $id=$id;
        return view('ads.modal_'.$action,compact('id'));
    }

}