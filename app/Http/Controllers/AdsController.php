<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Ad;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Lang;
use App\Ads_category;
use Sentinel;
use App\Ads_photos;
use App\Ads_prices;

class AdsController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function indexFrontend()
	{
		if(Sentinel::check()){
			$user=Sentinel::getUser();
		}
		$ads = Ad::where('user_id',$user->id)->get();
		$ads_category = Ads_category::lists('name', 'id');
		//dd($ads_category[1]);
		return view('ads.index', compact('ads','ads_category'));
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
		$galimage=array();

		 
		
		//echo $request->get('captcha');exit;
		if(Sentinel::check()){
			$user=Sentinel::getUser();
			$request->request->add(['user_id'=>$user->id]);
		}

		$ad= new Ad($request->except('photo_image','mytext'));
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

        if(count($photos)){
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
        }
        Ads_photos::insert($galimage);

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

		

		//$this->validate($request, ['name' => 'required']); // Uncomment and modify if needed.
		$ad = Ad::findOrFail($id);
		if(Sentinel::check()){
			$user=Sentinel::getUser();
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

                $ad->update($request->except('photo_image','mytext','myprice','myguest'));


             if(count($photos) && $request['mytext'][0]['tmp_name']!=''){
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