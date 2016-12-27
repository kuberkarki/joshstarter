<?php
Route::group(['middleware' => 'web'], function () {
    /*
    |--------------------------------------------------------------------------
    | Application Routes
    |--------------------------------------------------------------------------
    |
    | Here is where you can register all of the routes for an application.
    | It's a breeze. Simply tell Laravel the URIs it should respond to
    | and give it the Closure to execute when that URI is requested.
    |
    */
Route::group(['prefix' => 'api'], function()
{
    // Customer API Routes
    Route::get('get-available-days/{ads_id}', 'APIController@GetAvailableDays');

    Route::get('get-appointments/{ads_id}', 'APIController@GetAppointments');

    // Admin API Routes
    Route::get('get-all-appointments', 'AdminAPIController@GetAllAppointments');
});

Route::post('payment', [
    'as'   => 'payment',
    'uses' => 'PaymentController@prepare',
]);

Route::post('payment-card', [
    'as'   => 'payment-card',
    'uses' => 'PaymentController@preparecard',
]);

Route::any('payment/done/{payumToken?}', [
    'as'   => 'payment.done',
    'uses' => 'PaymentController@done',
]);
   
/*Route::get('auth/github', 'Auth\AuthController@redirectToProvider');
Route::get('auth/github/callback', 'Auth\AuthController@handleProviderCallback');*/

//Social Login
/*Route::get('facebook/authorize', function() {
    return SocialAuth::authorize('facebook');
});

Route::get('google/authorize', function() {
    return SocialAuth::authorize('google');
});


Route::get('google/login', function() {
    try {
        SocialAuth::login('google');
    } catch (ApplicationRejectedException $e) {
        echo "here";
        // User rejected application
    } catch (InvalidAuthorizationCodeException $e) {
        echo "here1";
        // Authorization was attempted with invalid
        // code,likely forgery attempt
    }

    // Current user is now available via Auth facade
    $user = Auth::user();

    dd($user);

    return Redirect::intended();
});*/
Route::get('/auth/{provider?}',[
    'uses' => 'AuthController@getSocialAuth',
    'as'   => 'auth.getSocialAuth'
]);

Route::get('/businessauth/{provider?}',[
    'uses' => 'AuthController@getSocialAuthBusiness',
    'as'   => 'businessauth.getSocialAuth'
]);

Route::get('/freelancerauth/{provider?}',[
    'uses' => 'AuthController@getSocialAuthFreelancer',
    'as'   => 'freelancerauth.getSocialAuth'
]);

Route::get('/organizerauth/{provider?}',[
    'uses' => 'AuthController@getSocialAuthOrganizer',
    'as'   => 'organizerauth.getSocialAuth'
]);



Route::get('/auth/callback/{provider?}',[
    'uses' => 'AuthController@getSocialAuthCallback',
    'as'   => 'auth.getSocialAuthCallback'
]);

// usage inside a laravel route
Route::get('thumbnail/{image}', function($image)
{
    $img = Image::make(URL::to('/uploads/crudfiles/'.$image))->resize(260, 175);

    return $img->response('jpg');
});

// usage inside a laravel route
Route::get('thumbnail2/{image}', function($image)
{
    $img = Image::make(URL::to('/uploads/crudfiles/'.$image))->resize(358, 217);

    return $img->response('jpg');
});
   

    /**
     * Model binding into route
     */
    //Route::model('blogcategory', 'App\BlogCategory');
    //Route::model('blog', 'App\Blog');
    Route::model('newscategory', 'App\NewsCategory');
    Route::model('news', 'App\News');
    Route::get('page/{page_id}', array('as' => 'page', 'uses' => 'PagesController@showFrontend'));
    //Route::model('events', 'App\Event');
    //Route::model('file', 'App\File');
    //Route::model('task', 'App\Task');
    Route::model('users', 'App\User');

    Route::pattern('slug', '[a-z0-9- _]+');


   

    Route::group(array('middleware' => 'SentinelUser'), function () {
        Route::get('my-events', array('as' => 'my-events', 'uses' => 'EventsController@myevents'));
        Route::get('booking-management', array('as' => 'booking-management', 'uses' => 'AdsController@bookingmanagement'));
        Route::get('reviews-management', array('as' => 'reviews-management', 'uses' => 'AdsController@reviewsmanagement'));
        Route::get('events-reviews-management', array('as' => 'events-reviews-management', 'uses' => 'EventsController@reviewsmanagement'));

        Route::get('total-revenue', array('as' => 'total-revenue', 'uses' => 'AdsController@totalrevenue'));
        Route::get('edit-event/{event_id}', array('as' => 'edit-event', 'uses' => 'EventsController@showeditevent'));
        Route::post('edit-event/{event_id}', array('as' => 'edit-event', 'uses' => 'EventsController@editevent'));
       Route::get('delete-event/{event_id}', array('as' => 'delete-event', 'uses' => 'EventsController@deleteevent'));
       Route::get('messages', array('as' => 'messages', 'uses' => 'EventsController@showmessages'));

        Route::post('rate-ads', array('as' => 'rate-ads', 'uses' => 'AdsController@rateads'));
        Route::post('submit-review', array('as' => 'submit-review', 'uses' => 'AdsController@submitreview'));

        Route::post('submit-review-again', array('as' => 'submit-review-again', 'uses' => 'AdsController@submitreviewagain'));

        Route::post('submit-review-event', array('as' => 'submit-review-event', 'uses' => 'EventsController@submitreview'));

        Route::post('submit-review-event-again', array('as' => 'submit-review-eventagain', 'uses' => 'EventsController@submitreviewagain'));

    });

    
             Route::post('search', array('as' => 'search', 'uses' => 'AdsController@search'));

        //Route::get('ads-detail/{slug?}', array('as' => 'ads-detail', 'uses' => 'AdsController@adsdetail'));


     

    Route::group(array('prefix' => 'admin'), function () {

        # Error pages should be shown without requiring login
        Route::get('404', function () {
            return View('admin/404');
        });
        Route::get('500', function () {
            return View::make('admin/500');
        });

        # Lock screen
        Route::get('lockscreen', function () {
            return View::make('admin/lockscreen');
        });

        # All basic routes defined here
        Route::get('signin', array('as' => 'signin', 'uses' => 'AuthController@getSignin'));
        Route::post('signin', 'AuthController@postSignin');
        Route::post('signup', array('as' => 'signup', 'uses' => 'AuthController@postSignup'));
        Route::post('forgot-password', array('as' => 'forgot-password', 'uses' => 'AuthController@postForgotPassword'));
        Route::get('login2', function () {
            return View::make('admin/login2');
        });

        # Register2
        Route::get('register2', function () {
            return View::make('admin/register2');
        });
        Route::post('register2', array('as' => 'register2', 'uses' => 'AuthController@postRegister2'));

        # Forgot Password Confirmation
        Route::get('forgot-password/{userId}/{passwordResetCode}', array('as' => 'forgot-password-confirm', 'uses' => 'AuthController@getForgotPasswordConfirm'));
        Route::post('forgot-password/{userId}/{passwordResetCode}', 'AuthController@postForgotPasswordConfirm');

        # Logout
        Route::get('logout', array('as' => 'logout', 'uses' => 'AuthController@getLogout'));

        # Account Activation
        Route::get('activate/{userId}/{activationCode}', array('as' => 'activate', 'uses' => 'AuthController@getActivate'));
    });

    Route::group(array('prefix' => 'admin', 'middleware' => 'SentinelAdmin'), function () {
        # Dashboard / Index
        Route::get('/', array('as' => 'dashboard', 'uses' => 'JoshController@showHome'));


        # User Management
        Route::group(array('prefix' => 'users'), function () {
            Route::get('/', array('as' => 'users', 'uses' => 'UsersController@index'));
            Route::get('create', 'UsersController@create');
            Route::post('create', 'UsersController@store');
            Route::get('{userId}/delete', array('as' => 'delete/user', 'uses' => 'UsersController@destroy'));
            Route::get('{userId}/confirm-delete', array('as' => 'confirm-delete/user', 'uses' => 'UsersController@getModalDelete'));
            Route::get('{userId}/restore', array('as' => 'restore/user', 'uses' => 'UsersController@getRestore'));
            Route::get('{userId}', array('as' => 'users.show', 'uses' => 'UsersController@show'));
            Route::post('{userId}/passwordreset', array('as' => 'passwordreset', 'uses' => 'UsersController@passwordreset'));

        });
        Route::resource('users', 'UsersController');

        Route::get('deleted_users', array('as' => 'deleted_users', 'before' => 'Sentinel', 'uses' => 'UsersController@getDeletedUsers'));

        # Group Management
        Route::group(array('prefix' => 'groups'), function () {
            Route::get('/', array('as' => 'groups', 'uses' => 'GroupsController@index'));
            Route::get('create', array('as' => 'create/group', 'uses' => 'GroupsController@create'));
            Route::post('create', 'GroupsController@store');
            Route::get('{groupId}/edit', array('as' => 'update/group', 'uses' => 'GroupsController@edit'));
            Route::post('{groupId}/edit', 'GroupsController@update');
            Route::get('{groupId}/delete', array('as' => 'delete/group', 'uses' => 'GroupsController@destroy'));
            Route::get('{groupId}/confirm-delete', array('as' => 'confirm-delete/group', 'uses' => 'GroupsController@getModalDelete'));
            Route::get('{groupId}/restore', array('as' => 'restore/group', 'uses' => 'GroupsController@getRestore'));
        });

        /*routes for news*/
        Route::group(array('prefix' => 'news'), function () {
            Route::get('/', array('as' => 'news', 'uses' => 'NewsController@index'));
            Route::get('create', array('as' => 'create/news', 'uses' => 'NewsController@create'));
            Route::post('create', 'NewsController@store');
            Route::get('{news}/edit', array('as' => 'update/news', 'uses' => 'NewsController@edit'));
            Route::post('{news}/edit', 'NewsController@update');
            Route::get('{news}/delete', array('as' => 'delete/news', 'uses' => 'NewsController@destroy'));
            Route::get('{news}/confirm-delete', array('as' => 'confirm-delete/news', 'uses' => 'NewsController@getModalDelete'));
            Route::get('{news}/restore', array('as' => 'restore/news', 'uses' => 'NewsController@getRestore'));
            Route::get('{news}/show', array('as' => 'news/show', 'uses' => 'NewsController@show'));
            Route::post('{news}/storecomment', array('as' => 'restore/news', 'uses' => 'NewsController@storecomment'));
        });

        /*routes for News category*/
        Route::group(array('prefix' => 'newscategory'), function () {
            Route::get('/', array('as' => 'newscategories', 'uses' => 'NewsCategoryController@index'));
            Route::get('create', array('as' => 'create/newscategory', 'uses' => 'NewsCategoryController@create'));
            Route::post('create', 'NewsCategoryController@store');
            Route::get('{newscategory}/edit', array('as' => 'update/newscategory', 'uses' => 'NewsCategoryController@edit'));
            Route::post('{newscategory}/edit', 'NewsCategoryController@update');
            Route::get('{newscategory}/delete', array('as' => 'delete/newscategory', 'uses' => 'NewsCategoryController@destroy'));
            Route::get('{newscategory}/confirm-delete', array('as' => 'confirm-delete/newscategory', 'uses' => 'NewsCategoryController@getModalDelete'));
            Route::get('{newscategory}/restore', array('as' => 'restore/newscategory', 'uses' => 'NewsCategoryController@getRestore'));
        });


        //tasks section
        /*Route::post('task/create', 'TaskController@store');
        Route::get('task/data', 'TaskController@data');
        Route::post('task/{task}/edit', 'TaskController@update');
        Route::post('task/{task}/delete', 'TaskController@delete');*/


        # Remaining pages will be called from below controller method
        # in real world scenario, you may be required to define all routes manually

        Route::get('{name?}', 'JoshController@showView');

    });

#FrontEndController
    Route::get('login', array('as' => 'login', 'uses' => 'FrontEndController@getLogin'));
    Route::post('login', 'FrontEndController@postLogin');
    Route::get('register', array('as' => 'register', 'uses' => 'FrontEndController@getRegister'));
    Route::post('register', 'FrontEndController@postRegister');

    Route::get('register-business', array('as' => 'register-business', 'uses' => 'FrontEndController@getRegisterBusiness'));
    Route::post('register-business', 'FrontEndController@postRegisterBusiness');

    Route::get('register-freelancer', array('as' => 'register-freelancer', 'uses' => 'FrontEndController@getRegisterFreelancer'));
    Route::post('register-freelancer', 'FrontEndController@postRegisterFreelancer');

    Route::get('register-event-organizer', array('as' => 'register-event-organizer', 'uses' => 'FrontEndController@getRegisterEventOrganizer'));
    Route::post('register-event-organizer', 'FrontEndController@postRegisterEventOrganizer');


    Route::get('activate/{userId}/{activationCode}', array('as' => 'activate', 'uses' => 'FrontEndController@getActivate'));
    Route::get('forgot-password', array('as' => 'forgot-password', 'uses' => 'FrontEndController@getForgotPassword'));
    Route::post('forgot-password', 'FrontEndController@postForgotPassword');
# Forgot Password Confirmation
    Route::get('forgot-password/{userId}/{passwordResetCode}', array('as' => 'forgot-password-confirm', 'uses' => 'FrontEndController@getForgotPasswordConfirm'));
    Route::post('forgot-password/{userId}/{passwordResetCode}', 'FrontEndController@postForgotPasswordConfirm');
# My account display and update details
    Route::group(array('middleware' => 'SentinelUser'), function () {
        Route::get('my-account', array('as' => 'my-account', 'uses' => 'FrontEndController@myAccount'));
        Route::get('portfolio', array('as' => 'portfolio', 'uses' => 'FrontEndController@portfolio'));
        Route::put('my-account', 'FrontEndController@update');
    });
    Route::get('logout', array('as' => 'logout', 'uses' => 'FrontEndController@getLogout'));
# contact form
   /* Route::post('contact', array('as' => 'contact', 'uses' => 'FrontEndController@postContact'));
    Route::post('partner', array('as' => 'partner', 'uses' => 'FrontEndController@postPartner'));
    Route::post('investor', array('as' => 'investor', 'uses' => 'FrontEndController@postInvestor'));
    Route::post('career', array('as' => 'career', 'uses' => 'FrontEndController@postcareer'));*/

#frontend views
   /* Route::get('/', array('as' => 'home', function () {
        //return View::make('index');
        return View::make('index');
    }));*/

    Route::get('/',array('as'=>'home','uses'=>'FrontEndController@home'));

    /*Route::get('blog', array('as' => 'blog', 'uses' => 'BlogController@getIndexFrontend'));
    Route::get('blog/{slug}/tag', 'BlogController@getBlogTagFrontend');
    Route::get('blogitem/{slug?}', 'BlogController@getBlogFrontend');
    Route::post('blogitem/{blog}/comment', 'BlogController@storeCommentFrontend');*/

    Route::get('news', array('as' => 'news', 'uses' => 'NewsController@getIndexFrontend'));
    Route::get('news/{slug}/tag', 'NewsController@getNewsTagFrontend');
    Route::get('newsitem/{slug?}', 'NewsController@getNewsFrontend');

    Route::post('newsitem/{news}/comment', 'NewsController@storeCommentFrontend');
    Route::get('events', array('as' => 'events', 'uses' => 'EventsController@getIndexFrontend'));
    Route::get('events/{slug}/tag', 'EventsController@getEventTagFrontend');
    Route::get('event/{slug?}', 'EventsController@getEventFrontend');
    Route::post('event/{events}/comment', 'EventsController@storeCommentFrontend');

    Route::get('list-ads/{slug?}', array('as' => 'list-ads', 'uses' => 'AdsController@ads'));
    Route::get('ads-detail/{slug?}', array('as' => 'ads-detail', 'uses' => 'AdsController@adsdetail'));



    Route::group(array('middleware' => 'SentinelUser'), function () {
        Route::get('my-account-business', array('as' => 'my-account-business', 'uses' => 'FrontEndController@myAccountBusiness'));
        Route::get('my-account-freelancer', array('as' => 'my-account-freelancer', 'uses' => 'FrontEndController@myAccountFreelancer'));
        Route::get('my-account-event-organizer', array('as' => 'my-account-event-organizer', 'uses' => 'FrontEndController@myAccountEventOrganizer'));


    Route::group(['prefix' => 'messages'], function () {
    Route::get('/', ['as' => 'messages', 'uses' => 'MessagesController@index']);
    Route::get('create', ['as' => 'messages.create', 'uses' => 'MessagesController@create']);
    Route::post('/', ['as' => 'messages.store', 'uses' => 'MessagesController@store']);
    Route::post('storefrontend', ['as' => 'messages.storefrontend', 'uses' => 'MessagesController@storefrontend']);
    Route::post('storefrontend-event', ['as' => 'messages.storefrontend-event', 'uses' => 'MessagesController@storefrontendevent']);

    Route::get('{id}', ['as' => 'messages.show', 'uses' => 'MessagesController@show']);
    Route::put('{id}', ['as' => 'messages.update', 'uses' => 'MessagesController@update']);
});
    });

     Route::group(array('middleware' => 'SentinelBusiness'), function () {
        Route::get('ads', array('as'=>'ads','uses'=>'AdsController@indexFrontend'));

        Route::get('manage-ads/{ad_id}', array('as'=>'manage-ads','uses'=>'AdsController@manageads'));
        Route::get('manage-reviews/{ad_id}', array('as'=>'manage-reviews','uses'=>'AdsController@managereviews'));
        Route::get('view-reviews/{ad_id}', array('as'=>'view-reviews','uses'=>'AdsController@viewereviews'));
       
        Route::get('create-ads', array('as' => 'create-ads', 'uses' => 'AdsController@createFrontend'));
        Route::post('ads', 'AdsController@storeFrontend');
       // Route::put('ads', 'AdsController@editads');
        Route::get('edit-ads/{ad_id}', array('as' => 'edit-ads', 'uses' => 'AdsController@showeditads'));
        Route::patch('edit-ads/{ad_id}', array('as' => 'edit-ads', 'uses' => 'AdsController@editads'));
        Route::get('delete-ads/{ad_id}', array('as' => 'delete-ads', 'uses' => 'AdsController@deleteads'));
        Route::post('delete-ads-image', array('as' => 'delete-ads-image', 'uses' => 'AdsController@deleteadsimage'));
        Route::post('delete-ads-price', array('as' => 'delete-ads-price', 'uses' => 'AdsController@deleteadsprice')) ;
        Route::get('ajax-ads-detail/{id}/{date}', array('as' => 'ajax-ads-detail', 'uses' => 'AdsController@ajaxadsdetail'));

    });

    Route::group(array('middleware' => 'SentinelFreelancer'), function () {
        Route::get('ads', array('as'=>'ads','uses'=>'AdsController@indexFrontend'));
        Route::get('create-ads', array('as' => 'create-ads', 'uses' => 'AdsController@createFrontend'));
        Route::post('ads', 'AdsController@storeFrontend');
        Route::get('edit-ads/{ad_id}', array('as' => 'edit-ads', 'uses' => 'AdsController@showeditads'));
        Route::patch('edit-ads/{ad_id}', array('as' => 'edit-ads', 'uses' => 'AdsController@editads'));
        //Route::get('manage-reviews/{ad_id}', array('as'=>'manage-reviews','uses'=>'AdsController@managereviews'));
        //Route::get('view-reviews/{ad_id}', array('as'=>'view-reviews','uses'=>'AdsController@viewereviews'));
    });

     route::group(array('middleware' => 'SentinelEventOrganizer'), function () {
         Route::get('create-event-menu', array('as' => 'create-event-menu', 'uses' => 'EventsController@createEventMenuFrontend'));
        Route::get('create-event', array('as' => 'create-event', 'uses' => 'EventsController@createEventFrontend'));
        Route::post('events', 'EventsController@storeFrontend');
        Route::put('event', 'EventsController@update');
         Route::get('event-view-reviews/{event_id}', array('as'=>'event-view-reviews','uses'=>'EventsController@viewereviews'));
    });

     Route::group(array('prefix' => 'ads', 'middleware' => 'SentinelUser'), function () {
             Route::get('/', array('as'=>'ads','uses'=>'AdsController@indexFrontend'));
            
            Route::get('book', array('as' => 'book', 'uses' => 'AdsController@getbook'));
            Route::post('bookings', array('as' => 'bookings', 'uses' => 'AdsController@submitbook'));
            Route::get('manage-ads/{ad_id}', array('as'=>'manage-ads','uses'=>'AdsController@manageads'));

     });

     Route::group(array('prefix' => 'ads'), function () {
            Route::get('details/{ads}', array('as' => 'details', 'uses' => 'AdsController@adsdetail'));
            Route::get('ajax-booking-detail/{id}', array('as' => 'ajax-booking-detail', 'uses' => 'AdsController@ajaxadsbookingdetail'));
            Route::get('ajax-booking-management-detail/{id}/{date}', array('as' => 'ajax-booking-management-detail', 'uses' => 'AdsController@ajaxadsbookingmanagementdetail'));
            Route::post('book', array('as' => 'book', 'uses' => 'AdsController@postbook'));


     });

    Route::get('{name?}', 'JoshController@showFrontEndView');


# End of frontend views

});
