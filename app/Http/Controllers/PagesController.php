<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Page;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Lang;
use App\News;

class PagesController extends Controller {

	protected $frontarray;

    public function __construct(){
        $this->frontarray['onenews'] = News::latest()->first();
        $this->frontarray['mainmenu']=Page::where('type','Main Menu')->get();
        $this->frontarray['OurExpertServices']=Page::where('type','Our Expert Services')->get();

    }
	public function showFrontend($slug)
	{
		$page = Page::where('slug',$slug)->first();
		if(!$page)
			return Response::view('404', array(), 404);

		//print_r($page);exit;

		return view('page', compact('page'))->with('frontarray',$this->frontarray);
	}
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$pages = Page::latest()->get();
		return view('admin.pages.index', compact('pages'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('admin.pages.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
		$page= new Page($request->except(''));
                		
                		$page->save();
		return redirect('admin/pages')->with('success', Lang::get('message.success.create'));
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$page = Page::findOrFail($id);
		return view('admin.pages.show', compact('page'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$page = Page::findOrFail($id);
		return view('admin.pages.edit', compact('page'));
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
		$page = Page::findOrFail($id);

                		/*if($request->has('')){
                        	$page->=1;
                        }
                        else{
                        	$page->=0;
                        }
*/
                		
                		$page->update($request->except(''));
		return redirect('admin/pages')->with('success', Lang::get('message.success.update'));
	}

	/**
    	 * Delete confirmation for the given Page.
    	 *
    	 * @param  int      $id
    	 * @return View
    	 */
    	public function getModalDelete($id = null)
    	{
            $error = '';
            $model = '';
            $confirm_route =  route('admin.pages.delete',['id'=>$id]);
            return View('admin/layouts/modal_confirmation', compact('error','model', 'confirm_route'));

    	}

    	/**
    	 * Delete the given Page.
    	 *
    	 * @param  int      $id
    	 * @return Redirect
    	 */
    	public function getDelete($id = null)
    	{
    		$page = Page::destroy($id);

            // Redirect to the group management page
            return redirect('admin/pages')->with('success', Lang::get('message.success.delete'));

    	}

}