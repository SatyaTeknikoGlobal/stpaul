<?php
namespace App\Http\Controllers;


use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Helpers\CustomHelper;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/




//Route::any('/', 'HomeController@index');
///////////////////////////////////Merchants/////////////////////////////////////////


////////////////////////////////////////ADMIN//////////////////////////////////////////

Route::match(['get', 'post'], '/user-logout', 'Auth\LoginController@logout');


$ADMIN_ROUTE_NAME = CustomHelper::getAdminRouteName();

Route::match(['get', 'post'], 'admin/login', 'Admin\LoginController@index');


Route::match(['get', 'post'], 'admin/forget-password', 'Admin\LoginController@forget_password')->name('admin.forget_password');

Route::match(['get', 'post'], 'admin/reset', 'Admin\LoginController@reset')->name('admin.reset');




// Admin
Route::group(['namespace' => 'Admin', 'prefix' => $ADMIN_ROUTE_NAME, 'as' => $ADMIN_ROUTE_NAME.'.', 'middleware' => ['authadmin']], function() {




    Route::get('firebase','FirebaseController@index');







    Route::get('/logout', 'LoginController@logout')->name('logout');

    Route::match(['get','post'],'/profile', 'HomeController@profile')->name('profile');
    
    Route::match(['get','post'],'/setting', 'HomeController@setting')->name('setting');
    Route::match(['get','post'],'/upload', 'HomeController@upload')->name('upload');

    Route::match(['get','post'],'/change-password', 'HomeController@change_password')->name('change_password');

    Route::get('/', 'HomeController@index')->name('home');


    Route::match(['get','post'],'get_sub_cat', 'HomeController@get_sub_cat')->name('get_sub_cat');



    Route::group(['prefix' => 'settings', 'as' => 'settings', 'middleware' => ['allowedmodule:settings'] ], function() {

        Route::match(['get', 'post'], '/{setting_id?}', 'SettingsController@index')->name('.index');
        //Route::any('/{setting_id}', 'SettingsController@index')->name('.index');
    });




////Influencers
    Route::group(['prefix' => 'influencers', 'as' => 'influencers' , 'middleware' => ['allowedmodule:influencers'] ], function() {
        Route::get('/', 'InfluencersController@index')->name('.index');
        
        Route::get('/get_influencer', 'InfluencersController@get_influencer')->name('.get_influencer');

        Route::match(['get','post'],'/change_user_status', 'InfluencersController@change_user_status')->name('.change_user_status');

        Route::match(['get', 'post'], 'add', 'InfluencersController@add')->name('.add');
        Route::match(['get', 'post'], 'edit/{id}', 'InfluencersController@add')->name('.edit');
        Route::post('ajax_delete_image', 'InfluencersController@ajax_delete_image')->name('.ajax_delete_image');
        Route::match(['get','post'],'delete/{id}', 'InfluencersController@delete')->name('.delete');
        
        Route::match(['get','post'],'gallery/{id}', 'InfluencersController@gallery')->name('.gallery');

        Route::match(['get','post'],'gallerydelete/{id}', 'InfluencersController@gallerydelete')->name('.gallerydelete');
    });
    





////Gallery
    Route::group(['prefix' => 'galleries', 'as' => 'galleries' , 'middleware' => ['allowedmodule:galleries'] ], function() {
        Route::match(['get','post'],'/', 'GalleryController@index')->name('.index');
        Route::match(['get','post'],'delete/{id}', 'GalleryController@delete')->name('.delete');

    });
    

////Events
    Route::group(['prefix' => 'events', 'as' => 'events' , 'middleware' => ['allowedmodule:events'] ], function() {
        Route::get('/', 'EventController@index')->name('.index');
        Route::match(['get', 'post'], 'add', 'EventController@add')->name('.add');
        
        Route::get('/get_events', 'EventController@get_events')->name('.get_events');
        Route::match(['get', 'post'], 'edit/{id}', 'EventController@add')->name('.edit');
        Route::post('ajax_delete_image', 'EventController@ajax_delete_image')->name('.ajax_delete_image');
        Route::match(['get','post'],'delete/{id}', 'EventController@delete')->name('.delete');
        Route::match(['get','post'],'gallery/{id}', 'EventController@gallery')->name('.gallery');
        Route::match(['get','post'],'chats/{id}', 'EventController@chats')->name('.chats');
        Route::match(['get','post'],'questions', 'EventController@questionList')->name('.questions');
        Route::match(['get','post'],'question_add', 'EventController@add_question')->name('.question_add');
        Route::match(['get', 'post'], 'edit_question/{id}', 'EventController@add_question')->name('.edit_question');
        Route::match(['get', 'post'], 'user/{id}', 'EventController@event_user_list')->name('.user');
        Route::match(['get', 'post'], 'subscription/{event_id}', 'EventController@subscription')->name('.subscription');
        Route::match(['get', 'post'], 'get-joined-user', 'EventController@joined_user_list')->name('.get_joined_user');
        Route::match(['get', 'post'], 'subscribed-user', 'EventController@subscribed_user')->name('.subscribed_user');
        Route::match(['get', 'post'], 'get_sub_users', 'EventController@get_sub_users')->name('.get_sub_users');
        Route::match(['get', 'post'], 'get_message', 'EventController@get_message')->name('.get_message');
        Route::match(['get', 'post'], 'save_message', 'EventController@save_message')->name('.save_message');
        Route::match(['get', 'post'], 'question_answer/{id}', 'EventController@question_answer')->name('.question_answer');
        Route::match(['get', 'post'], 'answered_user_list', 'EventController@answered_user_list')->name('.answered_user_list');
        Route::match(['get', 'post'], 'question_ask', 'EventController@question_ask')->name('.question_ask');
        Route::get('/get_questions', 'EventController@get_questions')->name('.get_questions');
        Route::match(['get','post'],'gallerydelete/{id}', 'EventController@gallerydelete')->name('.gallerydelete');

        
        Route::match(['get','post'],'analysis/{id}', 'EventController@analysis')->name('.analysis');






    });



  ////Banner
    Route::group(['prefix' => 'banners', 'as' => 'banners' , 'middleware' => ['allowedmodule:banners'] ], function() {
        Route::match(['get','post'],'/', 'BannerController@index')->name('.index');
        Route::match(['get', 'post'], 'add', 'BannerController@add')->name('.add');
        Route::match(['get', 'post'], 'edit/{id}', 'BannerController@add')->name('.edit');
        Route::post('ajax_delete_image', 'BannerController@ajax_delete_image')->name('.ajax_delete_image');
        Route::match(['get','post'],'delete/{id}', 'BannerController@delete')->name('.delete');

    });



  ////Testimonial
    Route::group(['prefix' => 'testimonials', 'as' => 'testimonials' , 'middleware' => ['allowedmodule:testimonials'] ], function() {
        Route::match(['get','post'],'/', 'TestimonialController@index')->name('.index');
        Route::match(['get','post'],'get_testimonial', 'TestimonialController@get_testimonial')->name('.get_testimonial');
        Route::match(['get', 'post'], 'add', 'TestimonialController@add')->name('.add');
        Route::match(['get', 'post'], 'edit/{id}', 'TestimonialController@add')->name('.edit');
        Route::post('ajax_delete_image', 'TestimonialController@ajax_delete_image')->name('.ajax_delete_image');
        Route::match(['get','post'],'delete/{id}', 'TestimonialController@delete')->name('.delete');

    });

  ////Transactions
    Route::group(['prefix' => 'transactions', 'as' => 'transactions' , 'middleware' => ['allowedmodule:transactions'] ], function() {
        Route::match(['get','post'],'/', 'TransactionController@index')->name('.index');
        Route::match(['get', 'post'], 'add', 'TransactionController@add')->name('.add');
        Route::match(['get', 'post'], 'get_transactions', 'TransactionController@get_transactions')->name('.get_transactions');

        



        Route::match(['get', 'post'], 'edit/{id}', 'TransactionController@add')->name('.edit');
        Route::post('ajax_delete_image', 'TransactionController@ajax_delete_image')->name('.ajax_delete_image');
        Route::match(['get','post'],'delete/{id}', 'TransactionController@delete')->name('.delete');

    });



  ////notifications
    Route::group(['prefix' => 'notifications', 'as' => 'notifications' , 'middleware' => ['allowedmodule:notifications'] ], function() {
        Route::match(['get','post'],'/', 'NotificationController@index')->name('.index');
        Route::match(['get', 'post'], 'add', 'NotificationController@add')->name('.add');
        Route::match(['get', 'post'], 'get_transactions', 'NotificationController@get_transactions')->name('.get_transactions');
        Route::match(['get', 'post'], 'edit/{id}', 'NotificationController@add')->name('.edit');
        Route::post('ajax_delete_image', 'NotificationController@ajax_delete_image')->name('.ajax_delete_image');
        Route::match(['get','post'],'delete/{id}', 'NotificationController@delete')->name('.delete');

    });





  ////course
    Route::group(['prefix' => 'course', 'as' => 'course' , 'middleware' => ['allowedmodule:course'] ], function() {
        Route::match(['get','post'],'/', 'CourseController@index')->name('.index');
        Route::match(['get','post'],'get_course', 'CourseController@get_course')->name('.get_course');
        Route::match(['get', 'post'], 'add', 'CourseController@add')->name('.add');
        Route::match(['get', 'post'], 'edit/{id}', 'CourseController@add')->name('.edit');
        Route::match(['get', 'post'], 'change_status', 'CourseController@change_status')->name('.change_status');
        Route::post('ajax_delete_image', 'CourseController@ajax_delete_image')->name('.ajax_delete_image');
        Route::match(['get','post'],'delete/{id}', 'CourseController@delete')->name('.delete');

    });




  ////course
    Route::group(['prefix' => 'faqs', 'as' => 'faqs' , 'middleware' => ['allowedmodule:faqs'] ], function() {
        Route::match(['get','post'],'/', 'FaqController@index')->name('.index');
        Route::match(['get','post'],'get_faqs', 'FaqController@get_faqs')->name('.get_faqs');
        Route::match(['get', 'post'], 'add', 'FaqController@add')->name('.add');
        Route::match(['get', 'post'], 'edit/{id}', 'FaqController@add')->name('.edit');
        Route::match(['get', 'post'], 'change_status', 'FaqController@change_status')->name('.change_status');
        Route::post('ajax_delete_image', 'FaqController@ajax_delete_image')->name('.ajax_delete_image');
        Route::match(['get','post'],'delete/{id}', 'FaqController@delete')->name('.delete');

    });






  ////exams
    Route::group(['prefix' => 'exams', 'as' => 'exams' , 'middleware' => ['allowedmodule:exams'] ], function() {
        Route::match(['get','post'],'/', 'ExamController@index')->name('.index');
        Route::match(['get','post'],'get_exams', 'ExamController@get_exams')->name('.get_exams');
        Route::match(['get','post'],'import/{id}', 'ExamController@import')->name('.import');
        Route::match(['get','post'],'add_question/{exam_id}', 'ExamController@add_question')->name('.add_question');
        Route::match(['get','post'],'get_exam_question', 'ExamController@get_exam_question')->name('.get_exam_question');

        Route::match(['get','post'],'edit_question{question_id}', 'ExamController@edit_question')->name('.edit_question');
        
        Route::match(['get','post'],'change_status', 'ExamController@change_status')->name('.change_status');
        Route::match(['get','post'],'get_course', 'ExamController@get_course')->name('.get_course');
        Route::match(['get', 'post'], 'add', 'ExamController@add')->name('.add');
        Route::match(['get', 'post'], 'edit/{id}', 'ExamController@add')->name('.edit');
        Route::post('ajax_delete_image', 'ExamController@ajax_delete_image')->name('.ajax_delete_image');
        Route::match(['get','post'],'delete/{id}', 'ExamController@delete')->name('.delete');


        Route::match(['get','post'],'results/{exam_id}', 'ExamController@results')->name('.results');
        Route::match(['get','post'],'get_result_list{exam_id}', 'ExamController@get_result_list')->name('.get_result_list');


    });


////questions
    Route::group(['prefix' => 'questions', 'as' => 'questions' , 'middleware' => ['allowedmodule:questions'] ], function() {
        Route::match(['get','post'],'/', 'QuestionController@index')->name('.index');
        Route::match(['get','post'],'get_exams', 'QuestionController@get_exams')->name('.get_exams');
        Route::match(['get','post'],'import', 'QuestionController@import')->name('.import');
        Route::match(['get','post'],'add_question', 'QuestionController@add_question')->name('.add_question');
        Route::match(['get','post'],'get_questions', 'QuestionController@get_questions')->name('.get_questions');

        Route::match(['get','post'],'edit_question{question_id}', 'QuestionController@edit_question')->name('.edit_question');
        
        Route::match(['get','post'],'change_status', 'QuestionController@change_status')->name('.change_status');
        Route::match(['get','post'],'get_course', 'QuestionController@get_course')->name('.get_course');
        Route::match(['get', 'post'], 'add', 'QuestionController@add')->name('.add');
        Route::match(['get', 'post'], 'edit/{id}', 'QuestionController@add')->name('.edit');
        Route::post('ajax_delete_image', 'QuestionController@ajax_delete_image')->name('.ajax_delete_image');
        Route::match(['get','post'],'delete/{id}', 'QuestionController@delete')->name('.delete');

    });





////Subscription
    Route::group(['prefix' => 'subscription', 'as' => 'subscription' , 'middleware' => ['allowedmodule:subscription'] ], function() {
        Route::get('/', 'SubscriptionController@index')->name('.index');
        
        Route::get('/list', 'SubscriptionController@list')->name('.list');


        Route::get('/users_list', 'SubscriptionController@users_list')->name('.users_list');
        Route::get('/get_user', 'SubscriptionController@get_user')->name('.get_user');

        Route::match(['get','post'],'/assign_user', 'SubscriptionController@assign_user')->name('.assign_user');


        Route::match(['get','post'],'/assign/{sub_id}', 'SubscriptionController@assign')->name('.assign');


        Route::match(['get','post'],'/change_status', 'SubscriptionController@change_status')->name('.change_status');


        Route::match(['get', 'post'], 'add', 'SubscriptionController@add')->name('.add');
        Route::match(['get', 'post'], 'edit/{id}', 'SubscriptionController@add')->name('.edit');
        Route::post('ajax_delete_image', 'SubscriptionController@ajax_delete_image')->name('.ajax_delete_image');
        Route::match(['get','post'],'delete/{id}', 'SubscriptionController@delete')->name('.delete');
        
        Route::match(['get','post'],'gallery/{id}', 'SubscriptionController@gallery')->name('.gallery');

        Route::match(['get','post'],'gallerydelete/{id}', 'SubscriptionController@gallerydelete')->name('.gallerydelete');
    });
    





////Users
    Route::group(['prefix' => 'users', 'as' => 'users' , 'middleware' => ['allowedmodule:users'] ], function() {
        Route::get('/', 'UsersController@index')->name('.index');
        
        Route::get('/get_users', 'UsersController@get_users')->name('.get_users');


        Route::match(['get','post'],'/change_status', 'UsersController@change_status')->name('.change_status');


        Route::match(['get', 'post'], 'add', 'UsersController@add')->name('.add');
        Route::match(['get', 'post'], 'export', 'UsersController@export')->name('.export');
        Route::match(['get', 'post'], 'edit/{id}', 'UsersController@add')->name('.edit');
        Route::post('ajax_delete_image', 'UsersController@ajax_delete_image')->name('.ajax_delete_image');
        Route::match(['get','post'],'delete/{id}', 'UsersController@delete')->name('.delete');
        
        Route::match(['get','post'],'gallery/{id}', 'UsersController@gallery')->name('.gallery');

        Route::match(['get','post'],'gallerydelete/{id}', 'UsersController@gallerydelete')->name('.gallerydelete');
    });
    


////Users
    Route::group(['prefix' => 'paid_user', 'as' => 'paid_user' , 'middleware' => ['allowedmodule:paid_user'] ], function() {

        Route::match(['get','post'],'/', 'PaidUsersController@index')->name('.index');
        
        Route::get('/get_paid_users', 'PaidUsersController@get_paid_users')->name('.get_paid_users');


        Route::match(['get','post'],'/change_status', 'PaidUsersController@change_status')->name('.change_status');


        Route::match(['get', 'post'], 'add', 'PaidUsersController@add')->name('.add');
        Route::match(['get', 'post'], 'export', 'PaidUsersController@export')->name('.export');
        Route::match(['get', 'post'], 'edit/{id}', 'PaidUsersController@add')->name('.edit');
        Route::post('ajax_delete_image', 'PaidUsersController@ajax_delete_image')->name('.ajax_delete_image');
        Route::match(['get','post'],'delete/{id}', 'PaidUsersController@delete')->name('.delete');
        
        Route::match(['get','post'],'gallery/{id}', 'PaidUsersController@gallery')->name('.gallery');

        Route::match(['get','post'],'gallerydelete/{id}', 'PaidUsersController@gallerydelete')->name('.gallerydelete');
    });
    




    
});

Route::match(['get','post'],'/', 'HomeController@index')->name('home');



Route::match(['get','post'],'/forget_password_update', 'HomeController@forget_password_update')->name('home.forget_password_update');
Route::match(['get','post'],'/send_otp', 'HomeController@send_otp')->name('home.send_otp');

Route::match(['get','post'],'/verify_otp', 'HomeController@verify_otp')->name('home.verify_otp');


Route::match(['get','post'],'/exam-list', 'HomeController@exam_list')->name('home.exam_list');
Route::match(['get','post'],'/exam-details/{exam_id}', 'HomeController@exam_details')->name('home.exam_details');
Route::match(['get','post'],'/about', 'HomeController@about')->name('home.about');
Route::match(['get','post'],'/contact', 'HomeController@contact')->name('home.contact');
Route::match(['get','post'],'/refund', 'HomeController@refund')->name('home.refund');
Route::match(['get','post'],'/login', 'HomeController@login')->name('home.login');
Route::match(['get','post'],'/terms', 'HomeController@terms')->name('home.terms');
Route::match(['get','post'],'/privacy', 'HomeController@privacy')->name('home.privacy');
Route::match(['get','post'],'/register', 'HomeController@register')->name('home.register');
Route::match(['get','post'],'/forgot_password', 'HomeController@forgot_password')->name('home.forgot_password');
Route::match(['get','post'],'/get_exam_details', 'HomeController@get_exam_details')->name('home.get_exam_details');
Route::match(['get','post'],'/thanku', 'HomeController@thanku')->name('home.thanku');
Route::match(['get','post'],'/exam-list-details/{course_id}', 'HomeController@exam_list_details')->name('home.exam_list_details');

Route::match(['get','post'],'/registration-process', 'HomeController@registration_process')->name('home.registration_process');
Route::match(['get','post'],'/faqs', 'HomeController@faqs')->name('home.faqs');
Route::match(['get','post'],'/contact-form', 'HomeController@contact_form')->name('home.contact_form');
Route::match(['get','post'],'/thankyou', 'HomeController@thankyou')->name('home.thankyou');

Route::group(['middleware' => ['auth'] ], function() {

    Route::match(['get','post'],'/profile', 'HomeController@profile')->name('home.profile');
    Route::match(['get','post'],'/dashboard', 'HomeController@dashboard')->name('home.dashboard');
    Route::match(['get','post'],'/logout', 'HomeController@logout')->name('home.logout');
    Route::match(['get','post'],'/my-exam', 'HomeController@my_exam')->name('home.my_exam');
    Route::match(['get','post'],'/upcoming-exam', 'HomeController@upcoming_exam')->name('home.upcoming_exam');
    Route::match(['get','post'],'/my-result', 'HomeController@my_result')->name('home.my_result');
    Route::match(['get','post'],'/exam_payment', 'HomeController@exam_payment')->name('home.exam_payment');

    Route::match(['get','post'],'/upload', 'HomeController@upload')->name('home.upload');
    Route::match(['get','post'],'/exam-instruction/{exam_id}', 'HomeController@exam_instruction')->name('home.exam_instruction');
    Route::match(['get','post'],'/exam-results/{exam_id}', 'HomeController@exam_results')->name('home.exam_results');

    
    Route::match(['get','post'],'/start-exam/{exam_id}', 'HomeController@start_exam')->name('home.start_exam');
    Route::match(['get','post'],'/result-details/{exam_id}', 'HomeController@result_details')->name('home.result_details');





});



Route::fallback(function () {

    return redirect(route('home'));
    // return view("front.404");

});