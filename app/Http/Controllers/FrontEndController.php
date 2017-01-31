<?php

namespace App\Http\Controllers;

use Activation;
use App\Http\Requests;
use App\Http\Requests\UserRequest;
use App\User;
use Cartalyst\Sentinel\Checkpoints\NotActivatedException;
use Cartalyst\Sentinel\Checkpoints\ThrottlingException;
use File;
use Hash;
use Illuminate\Http\Request;
use Lang;
use Mail;
use Redirect;
use Reminder;
use Sentinel;
use URL;
use View;
use Newsletter;
use App\Event;
use Carbon\Carbon ;
use App\News;
use DateTime;
use App\Page;
use Captcha;
use Validator;
use App\Ads_category;
use Session;
use Helper;
use DB;



class FrontEndController extends JoshController
{
     protected $frontarray;

    public function __construct(){
        $this->frontarray['onenews'] = News::latest()->first();
        $this->frontarray['mainmenu']=Page::where('type','Main Menu')->get();
        $this->frontarray['OurExpertServices']=Page::where('type','Our Expert Services')->get();
    }

    /*
     * $user_activation set to false makes the user activation via user registered email
     * and set to true makes user activated while creation
     */
    private $user_activation = true;

    public function index(){
        return View::make('welcome');
    }

    public function home(Request $request){

       
        $date = new DateTime;
        $date->modify('-50 minutes');
        $formatted_date = $date->format('Y-m-d H:i:s');
        $filtereventbyprice = session('filtereventbyprice');



        if($filtereventbyprice && $filtereventbyprice!='-1'){
            $price=Helper::exchangeToUSD($filtereventbyprice);
            
                $events=Event::where('type','Public')->where(function($q) use($price){
                    $q->where('ticket_price','<=',DB::raw($price));
                    //$q->orWhere('ticket_price','=','Free');
                })->where('date','>',$formatted_date)->orderBy('date','ASC')->limit(6)->get();

        }else{
            $events=Event::where('type','Public')->where('date','>',$formatted_date)->orderBy('date','ASC')->limit(6)->get();

        }


        $popularevents= Event::select(['*', DB::raw('count(event_comments.id) as total')])
                ->leftJoin('event_comments', 'events.id', '=', 'event_comments.event_id')
                ->groupBy('events.id')
                ->orderBy('total', 'DESC')
                ->limit(5)->get();

        $sponsoredevents=Event::where('issponsored','1')->where('type','Public')->where('date','>',$formatted_date)->orderByRaw("RAND()")->limit(6)->get();

        
        
        
        $newss = News::latest()->simplePaginate(6);
        $newss->setPath('news');

        $ads_category = Ads_category::where('homepage',true)->get();

        //print_r($this->frontarray);exit;


        //$tags = $this->tags;
        return View::make('index',compact('ads_category','popularevents','sponsoredevents'))->with('events',$events)->with('news',$newss)->with('frontarray',$this->frontarray);
    }

    public function filtereventbyprice(Request $request){

       session(['filtereventbyprice' => $request->get('price')]);
        
        return redirect('/');
    }

    /**
     * Account sign in.
     *
     * @return View
     */
    public function getLogin()
    {
        // Is the user logged in?
        if (Sentinel::check()) {
            return Redirect::route('my-account');
        }

        // Show the login page
        return View::make('login')->with('frontarray',$this->frontarray);
    }

    /**
     * Account sign in form processing.
     *
     * @return Redirect
     */
    public function postLogin(Request $request)
    {

        try {
            // Try to log the user in
            if (Sentinel::authenticate($request->only('email', 'password'), $request->get('remember-me', 0))) {
                //return Redirect::intended('default_path');
               // return Redirect::to(URL::previous());
               // return Redirect::intended('/');



                if(Session::get('bookData'))
                   return Redirect::intended('ads/book');

                if(Sentinel::inRole('event-organizer'))
                    return Redirect::route("my-account-event-organizer")->with('success', Lang::get('auth/message.login.success'));
                elseif(Sentinel::inRole('freelancer'))
                    return Redirect::route("my-account-freelancer")->with('success', Lang::get('auth/message.login.success'));
                elseif(Sentinel::inRole('business'))
                    return Redirect::route("my-account-business")->with('success', Lang::get('auth/message.login.success'));
                else
                    return Redirect::route("my-account")->with('success', Lang::get('auth/message.login.success'));
            } else {
                return Redirect::to('login')->with('error', 'Username or password is incorrect.');
                //return Redirect::back()->withInput()->withErrors($validator);
            }

        } catch (UserNotFoundException $e) {
            $this->messageBag->add('email', Lang::get('auth/message.account_not_found'));
        } catch (NotActivatedException $e) {
            $this->messageBag->add('email', Lang::get('auth/message.account_not_activated'));
        } catch (UserSuspendedException $e) {
            $this->messageBag->add('email', Lang::get('auth/message.account_suspended'));
        } catch (UserBannedException $e) {
            $this->messageBag->add('email', Lang::get('auth/message.account_banned'));
        } catch (ThrottlingException $e) {
            $delay = $e->getDelay();
            $this->messageBag->add('email', Lang::get('auth/message.account_suspended', compact('delay')));
        }

        // Ooops.. something went wrong
        return Redirect::back()->withInput()->withErrors($this->messageBag);
    }

     public function portfolio(User $user)
    { 

        $user = Sentinel::getUser();
        $countries = $this->countries;
        return View::make('business.portfolio', compact('user', 'countries'))->with('frontarray',$this->frontarray);
    }


    //Business Acciunt
    //
     /**
     * get user details and display
     */
    public function myAccountBusiness(User $user)
    { 

        $user = Sentinel::getUser();
        $countries = $this->countries;
        return View::make('business.user_account', compact('user', 'countries'))->with('frontarray',$this->frontarray);
    }

    //Freelancer Acciunt
    //
     /**
     * get user details and display
     */
    public function myAccountFreelancer(User $user)
    { 
        $user = Sentinel::getUser();
        $countries = $this->countries;
        return View::make('freelancer.user_account', compact('user', 'countries'))->with('frontarray',$this->frontarray);
    }

    //Freelancer Acciunt
    //
     /**
     * get user details and display
     */
    public function myAccountEventOrganizer(User $user)
    { 
        $user = Sentinel::getUser();
        $countries = $this->countries;
        return View::make('event_organizer.user_account', compact('user', 'countries'))->with('frontarray',$this->frontarray);
    }

    /**
     * get user details and display
     */
    public function myAccount(User $user)
    {
        $user = Sentinel::getUser();

         if(Sentinel::inRole('event-organizer'))
            return Redirect::route("my-account-event-organizer");
        elseif(Sentinel::inRole('freelancer'))
            return Redirect::route("my-account-freelancer");
        elseif(Sentinel::inRole('business'))
            return Redirect::route("my-account-business");
                
        $countries = $this->countries;
        return View::make('user_account', compact('user', 'countries'))->with('frontarray',$this->frontarray);
    }

    /**
     * update user details and display
     * @param Request $request
     * @param User $user
     * @return Return Redirect
     */
    public function update(Request $request, User $user)
    {

        $user = Sentinel::getUser();

        //update values
        $user->first_name = $request->get('first_name');
        $user->last_name = $request->get('last_name');
       // $user->email = $request->get('email');
        $user->dob = $request->get('dob');
        $user->bio = $request->get('bio');
        $user->gender = $request->get('gender');
        $user->country = $request->get('country');
        $user->state = $request->get('state');
        $user->city = $request->get('city');
        $user->address = $request->get('address');
        $user->postal = $request->get('postal');

        $user->company_name = $request->get('company_name');
        $user->office_number = $request->get('office_number');
        $user->mobile_number = $request->get('mobile_number');
        $user->duration = $request->get('duration');
        $user->portfolio = $request->get('portfolio');

       // echo $user->office_number;exit;
        


        if ($password = $request->get('password')) {
            $user->password = Hash::make($password);
        }
        // is new image uploaded?
        if ($file = $request->file('pic')) {
            $fileName = $file->getClientOriginalName();
            $extension = $file->getClientOriginalExtension() ?: 'png';
            $folderName = '/uploads/users/';
            $destinationPath = public_path() . $folderName;
            $safeName = str_random(10) . '.' . $extension;
            $file->move($destinationPath, $safeName);

            //delete old pic if exists
            if (File::exists(public_path() . $folderName . $user->pic)) {
                File::delete(public_path() . $folderName . $user->pic);
            }

            //save new file path into db
            $user->pic = $safeName;

        }

        // Was the user updated?
        if ($user->save()) {
            // Prepare the success message
            $success = Lang::get('users/message.success.update');

            // Redirect to the user page
            if($request->get('redirection'))
                return Redirect::route('portfolio')->with('success', $success);
            return Redirect::route('my-account')->with('success', $success);
        }

        // Prepare the error message
        $error = Lang::get('users/message.error.update');


        // Redirect to the user page
        return Redirect::route('my-account')->withInput()->with('error', $error);


    }

    /**
     * Account Register.
     *
     * @return View
     */
    public function getRegister()
    {
        // Show the page
        $countries = $this->countries;
        return View::make('register',compact('countries'))->with('frontarray',$this->frontarray);
    }

    /**
     * Account sign up form processing.
     *
     * @return Redirect
     */
    public function postRegisterBusiness(UserRequest $request)
    {

        

       // print_r($request->get('type'));exit;
        $activate = $this->user_activation; //make it false if you don't want to activate user automatically it is declared above as global variable

        try {
            $rules = ['captcha' => 'required|captcha'];
            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails())
            {
                return redirect('register-business')->with('error', 'captcha error')->withInput();
            }
            // Register the user
            $user = Sentinel::register($request->except(['captcha','password_confirm','subscribed','submit']), $activate);

            //add user to 'User' group
            
                $role = Sentinel::findRoleByName('Business');
            

            //print_r($role);exit;
            $role->users()->attach($user);

            //if you set $activate=false above then user will receive an activation mail
            if (!$activate) {
                // Data to be used on the email view
                $data = array(
                    'user' => $user,
                    'activationUrl' => URL::route('activate', [$user->id, Activation::create($user)->code]),
                );

                // Send the activation code through email
                Mail::send('emails.register-activate', $data, function ($m) use ($user) {
                    $m->to($user->email, $user->first_name . ' ' . $user->last_name);
                    $m->subject('Welcome ' . $user->first_name);
                });

                //Redirect to login page
                return Redirect::to("login")->with('success', Lang::get('auth/message.signup.success'));
            }
            // login user automatically
            Sentinel::login($user, false);

            // Redirect to the home page with success menu
            return Redirect::route("my-account")->with('success', Lang::get('auth/message.signup.success'));
            //return View::make('user_account')->with('success', Lang::get('auth/message.signup.success'));

        } catch (UserExistsException $e) {
            $this->messageBag->add('email', Lang::get('auth/message.account_already_exists'));
        }

        // Ooops.. something went wrong
        return Redirect::back()->withInput()->withErrors($this->messageBag);
    }

    /**
     * Account Register.
     *
     * @return View
     */
    public function getRegisterBusiness()
    {
        // Show the page
        $countries = $this->countries;
        return View::make('business.register-business',compact('countries'))->with('frontarray',$this->frontarray);
    }


    /**
     * Account sign up form processing.
     *
     * @return Redirect
     */
    public function postRegisterEventOrganizer(UserRequest $request)
    {

        

       // print_r($request->get('type'));exit;
        $activate = $this->user_activation; //make it false if you don't want to activate user automatically it is declared above as global variable

        try {
            $rules = ['captcha' => 'required|captcha'];
            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails())
            {
                return redirect('register-event-organizer')->with('error', 'captcha error')->withInput();
            }
            // Register the user
            $user = Sentinel::register($request->except(['captcha','password_confirm','subscribed','submit']), $activate);

            //add user to 'User' group
            
                $role = Sentinel::findRoleByName('Event Organizer');
            

            //print_r($role);exit;
            $role->users()->attach($user);

            //if you set $activate=false above then user will receive an activation mail
            if (!$activate) {
                // Data to be used on the email view
                $data = array(
                    'user' => $user,
                    'activationUrl' => URL::route('activate', [$user->id, Activation::create($user)->code]),
                );

                // Send the activation code through email
                Mail::send('emails.register-activate', $data, function ($m) use ($user) {
                    $m->to($user->email, $user->first_name . ' ' . $user->last_name);
                    $m->subject('Welcome ' . $user->first_name);
                });

                //Redirect to login page
                return Redirect::to("login")->with('success', Lang::get('auth/message.signup.success'));
            }
            // login user automatically
            Sentinel::login($user, false);

            // Redirect to the home page with success menu
            return Redirect::route("my-account")->with('success', Lang::get('auth/message.signup.success'));
            //return View::make('user_account')->with('success', Lang::get('auth/message.signup.success'));

        } catch (UserExistsException $e) {
            $this->messageBag->add('email', Lang::get('auth/message.account_already_exists'));
        }

        // Ooops.. something went wrong
        return Redirect::back()->withInput()->withErrors($this->messageBag);
    }

    /**
     * Account Register.
     *
     * @return View
     */
    public function getRegisterEventOrganizer()
    {
        // Show the page
        $countries = $this->countries;
        return View::make('event_organizer.register',compact('countries'))->with('frontarray',$this->frontarray);
    }

    public function postRegisterFreelancer(UserRequest $request)
    {

        

       // print_r($request->get('type'));exit;
        $activate = $this->user_activation; //make it false if you don't want to activate user automatically it is declared above as global variable

        try {
            $rules = ['captcha' => 'required|captcha'];
            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails())
            {
                return redirect('register-freelancer')->with('error', 'captcha error')->withInput();
            }
            // Register the user
            $user = Sentinel::register($request->except(['captcha','password_confirm','subscribed','submit']), $activate);

            //add user to 'User' group
            
                $role = Sentinel::findRoleByName('Freelancer');
            

            //print_r($role);exit;
            $role->users()->attach($user);

            //if you set $activate=false above then user will receive an activation mail
            if (!$activate) {
                // Data to be used on the email view
                $data = array(
                    'user' => $user,
                    'activationUrl' => URL::route('activate', [$user->id, Activation::create($user)->code]),
                );

                // Send the activation code through email
                Mail::send('emails.register-activate', $data, function ($m) use ($user) {
                    $m->to($user->email, $user->first_name . ' ' . $user->last_name);
                    $m->subject('Welcome ' . $user->first_name);
                });

                //Redirect to login page
                return Redirect::to("login")->with('success', Lang::get('auth/message.signup.success'));
            }
            // login user automatically
            Sentinel::login($user, false);

            // Redirect to the home page with success menu
            return Redirect::route("my-account")->with('success', Lang::get('auth/message.signup.success'));
            //return View::make('user_account')->with('success', Lang::get('auth/message.signup.success'));

        } catch (UserExistsException $e) {
            $this->messageBag->add('email', Lang::get('auth/message.account_already_exists'));
        }

        // Ooops.. something went wrong
        return Redirect::back()->withInput()->withErrors($this->messageBag);
    }

    /**
     * Account Register.
     *
     * @return View
     */
    public function getRegisterFreelancer()
    {
        // Show the page
         $countries = $this->countries;
        return View::make('freelancer.register-freelancer',compact('countries'))->with('frontarray',$this->frontarray);
    }

    /**
     * Account sign up form processing.
     *
     * @return Redirect
     */
    public function postRegister(UserRequest $request)
    {

        

       // print_r($request->get('type'));exit;
        $activate = $this->user_activation; //make it false if you don't want to activate user automatically it is declared above as global variable

        try {
            // Register the user
            $user = Sentinel::register($request->only(['first_name', 'last_name', 'email', 'password']), $activate);

            //add user to 'User' group
            if($request->get('type')=='Business'){
                $role = Sentinel::findRoleByName('Business');
            }
            elseif($request->get('type')=='Freelancer'){
                $role = Sentinel::findRoleByName('Freelancer');
            }else
                $role = Sentinel::findRoleByName('User');

            //print_r($role);exit;
            $role->users()->attach($user);

            //if you set $activate=false above then user will receive an activation mail
            if (!$activate) {
                // Data to be used on the email view
                $data = array(
                    'user' => $user,
                    'activationUrl' => URL::route('activate', [$user->id, Activation::create($user)->code]),
                );

                // Send the activation code through email
                Mail::send('emails.register-activate', $data, function ($m) use ($user) {
                    $m->to($user->email, $user->first_name . ' ' . $user->last_name);
                    $m->subject('Welcome ' . $user->first_name);
                });

                //Redirect to login page
                return Redirect::to("login")->with('success', Lang::get('auth/message.signup.success'));
            }
            // login user automatically
            Sentinel::login($user, false);

            // Redirect to the home page with success menu
            return Redirect::route("my-account")->with('success', Lang::get('auth/message.signup.success'));
            //return View::make('user_account')->with('success', Lang::get('auth/message.signup.success'));

        } catch (UserExistsException $e) {
            $this->messageBag->add('email', Lang::get('auth/message.account_already_exists'));
        }

        // Ooops.. something went wrong
        return Redirect::back()->withInput()->withErrors($this->messageBag);
    }

    /**
     * User account activation page.
     *
     * @param number $userId
     * @param string $activationCode
     *
     */
    public function getActivate($userId, $activationCode)
    {
        // Is the user logged in?
        if (Sentinel::check()) {
            return Redirect::route('my-account');
        }

        $user = Sentinel::findById($userId);

        if (Activation::complete($user, $activationCode)) {
            // Activation was successfull
            return Redirect::route('login')->with('success', Lang::get('auth/message.activate.success'));
        } else {
            // Activation not found or not completed.
            $error = Lang::get('auth/message.activate.error');
            return Redirect::route('login')->with('error', $error)->with('frontarray',$this->frontarray);
        }
    }

    /**
     * Forgot password page.
     *
     * @return View
     */
    public function getForgotPassword()
    {
        // Show the page
        return View::make('forgotpwd')->with('frontarray',$this->frontarray);

    }

    /**
     * Forgot password form processing page.
     * @param Request $request
     * @return Redirect
     */
    public function postForgotPassword(Request $request)
    {
        try {
            // Get the user password recovery code
            //$user = Sentinel::FindByLogin($request->get('email'));
            $user = Sentinel::findByCredentials(['email' => $request->email]);
            if (!$user) {
                return Redirect::route('forgot-password')->with('error', Lang::get('auth/message.account_not_found'));
            }

            $activation = Activation::completed($user);
            if (!$activation) {
                return Redirect::route('forgot-password')->with('error', Lang::get('auth/message.account_not_activated'));
            }

            $reminder = Reminder::exists($user) ?: Reminder::create($user);
            // Data to be used on the email view
            $data = array(
                'user' => $user,
                //'forgotPasswordUrl' => URL::route('forgot-password-confirm', $user->getResetPasswordCode()),
                'forgotPasswordUrl' => URL::route('forgot-password-confirm', [$user->id, $reminder->code]),
            );

            // Send the activation code through email
            Mail::send('emails.forgot-password', $data, function ($m) use ($user) {
                $m->to($user->email, $user->first_name . ' ' . $user->last_name);
                $m->subject('Account Password Recovery');
            });
        } catch (UserNotFoundException $e) {
            // Even though the email was not found, we will pretend
            // we have sent the password reset code through email,
            // this is a security measure against hackers.
        }

        //  Redirect to the forgot password
        return Redirect::to(URL::previous())->with('success', Lang::get('auth/message.forgot-password.success'));
    }

    /**
     * Forgot Password Confirmation page.
     *
     * @param  string $passwordResetCode
     * @return View
     */
    public function getForgotPasswordConfirm($userId, $passwordResetCode = null)
    {
        if (!$user = Sentinel::findById($userId)) {
            // Redirect to the forgot password page
            return Redirect::route('forgot-password')->with('error', Lang::get('auth/message.account_not_found'));
        }

        if($reminder = Reminder::exists($user))
        {
            if($passwordResetCode == $reminder->code)
            {
                return View::make('forgotpwd-confirm', compact(['userId', 'passwordResetCode']))->with('frontarray',$this->frontarray);
            }
            else{
                return 'code does not match';
            }
        }
        else
        {
            return 'does not exists';
        }


        // Show the page
     //   return View::make('forgotpwd-confirm', compact(['userId', 'passwordResetCode']));
    }

    /**
     * Forgot Password Confirmation form processing page.
     *
     * @param  string $passwordResetCode
     * @return Redirect
     */
    public function postForgotPasswordConfirm(Request $request, $userId, $passwordResetCode = null)
    {

        $user = Sentinel::findById($userId);
        if (!$reminder = Reminder::complete($user, $passwordResetCode, $request->get('password'))) {
            // Ooops.. something went wrong
            return Redirect::route('login')->with('error', Lang::get('auth/message.forgot-password-confirm.error'));
        }

        // Password successfully reseted
        return Redirect::route('login')->with('success', Lang::get('auth/message.forgot-password-confirm.success'));
    }

    /**
     * Contact form processing.
     * @param Request $request
     * @return Redirect
     */
    public function postContact(Request $request)
    {

        $subscribes=$request->get('subscribe');
        $subscribed='';
        if(count($subscribes))
        foreach($subscribes as $s){
            $subscribed =$s;
        }

        //echo $subscribed;exit;
        

        // Data to be used on the email view
        $data = array(
            'contact-name' => $request->get('contact-name'),
            'contact-email' => $request->get('contact-email'),
            'contact-msg' => $subscribed,
        );

        if(($data['contact-name']=='') || ($data['contact-email']=='')){
            
             return redirect()->route("home")->with('error','Please fill the form!!');

         }

         Newsletter::subscribe($data['contact-email'], ['FNAME'=>$data['contact-name'], 'MMERGE3'=>$subscribed]);

        // Send the activation code through email
        Mail::send('emails.contact', compact('data'), function ($m) use ($data) {
            $m->from($data['contact-email'], $data['contact-name']);
            $m->to('karki.kuber@gmail.com', 'Event Day Planner');
            $m->subject('Received a mail from ' . $data['contact-name']);

        });

        //Redirect to contact page
        return Redirect::to("/")->with('success','Thankyou!!');
    }

    /**
     * Carrer form processing.
     * @param Request $request
     * @return Redirect
     */
    public function postCareer(Request $request)
    {

        
        

        // Data to be used on the email view
        $data = array(
            'name' => $request->get('name'),
            'expertised' => $request->get('expertised'),
            'email' => $request->get('email'),
            'location' => $request->get('location'),
            'message' => $request->get('message'),
            );

        if(($data['name']=='') || ($data['location']=='') || ($data['email']=='') || ($data['expertised']=='')){
            
             return redirect()->route("home")->with('error','Please fill the form!!');

         }

        // Newsletter::subscribe($data['contact-email'], ['FNAME'=>$data['contact-name'], 'MMERGE3'=>$subscribed]);

        // Send the activation code through email
        Mail::send('emails.career', compact('data'), function ($m) use ($data) {
            $m->from('info@eventdayplanner.com', "Event Day Planner");
            $m->to('info@eventdayplanner.comm', 'Eventdayplanner');
            $m->cc('karki.kuber@gmail.com', 'Eventdayplanner');
            $m->subject('Carrer contact mail from Eventdayplanner');

        });

        //Redirect to contact page
        return Redirect::to("/")->with('success','Thankyou!!');
    }

    /**
     * Investor form processing.
     * @param Request $request
     * @return Redirect
     */
    public function postInvestor(Request $request)
    {



        
        

        // Data to be used on the email view
        $data = array(
            'name' => $request->get('name'),
            'company' => $request->get('company'),
            'email' => $request->get('email'),
            //'location' => $request->get('location'),
            'message' => $request->get('message'),
            );

       

        if(($data['name']=='') || ($data['email']=='') || ($data['company']=='')){
            
             return redirect()->route("home")->with('error','Please fill the form!!');

         }

        // Newsletter::subscribe($data['contact-email'], ['FNAME'=>$data['contact-name'], 'MMERGE3'=>$subscribed]);

        // Send the activation code through email
        Mail::send('emails.investor', compact('data'), function ($m) use ($data) {
            $m->from('info@eventdayplanner.com', "Event Day Planner");
            $m->to('info@eventdayplanner.com', 'Eventdayplanner');
            $m->cc('karki.kuber@gmail.com', 'Eventdayplanner');
            $m->subject('Inversor contact mail from Eventdayplanner');

        });

        //Redirect to contact page
        return Redirect::to("/")->with('success','Thankyou!!');
    }

    /**
     * Partner form processing.
     * @param Request $request
     * @return Redirect
     */
    public function postPartner(Request $request)
    {

        
        

        // Data to be used on the email view
        $data = array(
            'name' => $request->get('name'),
            'company' => $request->get('company'),
            'email' => $request->get('email'),
            //'location' => $request->get('location'),
            'message' => $request->get('message'),
            );

        if(($data['name']=='') || ($data['email']=='') || ($data['company']=='')){
            
             return redirect()->route("home")->with('error','Please fill the form!!');

         }

        // Newsletter::subscribe($data['contact-email'], ['FNAME'=>$data['contact-name'], 'MMERGE3'=>$subscribed]);

        // Send the activation code through email
        Mail::send('emails.partner', compact('data'), function ($m) use ($data) {
            $m->from('info@eventdayplanner.com', "Event Day Planner");
            $m->to('info@eventdayplanner.com', 'Eventdayplanner');
            $m->cc('karki.kuber@gmail.com', 'Eventdayplanner');
            $m->subject('Partner contact mail from Eventdayplanner');

        });

        //Redirect to contact page
        return Redirect::to("/")->with('success','Thankyou!!');
    }

    /**
     * Logout page.
     *
     * @return Redirect
     */
    public function getLogout()
    {
        // Log the user out
        Sentinel::logout();

        // Redirect to the users page
        return Redirect::to('login')->with('success', 'You have successfully logged out!');
    }



}
