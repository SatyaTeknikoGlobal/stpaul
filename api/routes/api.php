<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::post('send_otp', 'ApiController@send_otp');



Route::post('verify_otp', 'ApiController@verify_otp');
Route::post('forget_password', 'ApiController@forget_password');



Route::post('send_otp_email', 'ApiController@send_otp_email');
Route::post('login', 'ApiController@login');
Route::post('login_password', 'ApiController@loginWithPassword');
Route::post('signup', 'ApiController@register');
Route::get('check_version ', 'ApiController@app_version');
Route::get('country_list ', 'ApiController@country_list');
Route::get('language_list ', 'ApiController@language_list');
Route::get('subcategory_list ', 'ApiController@subcategory_list');
Route::post('checkUsername ', 'ApiController@checkUsername');
Route::post('checkEmail ', 'ApiController@checkEmail');
Route::post('apply_referral_code ', 'ApiController@apply_referral_code');



Route::post('social_login ', 'ApiController@social_login');




Route::group(['middleware' => 'auth.jwt'], function () {
	Route::match(['get','post'],'logout', 'ApiController@logout');


	Route::match(['get','post'],'profile', 'ApiController@profile');

	Route::match(['get','post'],'notification_list', 'ApiController@notification_list');

	Route::match(['get','post'],'get_question', 'ApiController@get_question');



	Route::match(['get','post'],'submit_answer', 'ApiController@submit_answer');


	Route::match(['get','post'],'get_wallet', 'ApiController@get_wallet');



	Route::match(['get','post'],'influencer_details', 'ApiController@influencer_details')

	;
	Route::match(['get','post'],'influencer_list', 'ApiController@influencer_list');



	Route::match(['get','post'],'live_influencer_list', 'ApiController@live_influencer_list');
	Route::match(['get','post'],'question_winner_list', 'ApiController@question_winner_list');





	Route::match(['get','post'],'join_live', 'ApiController@join_live');



	Route::match(['get','post'],'chats', 'ApiController@chats');
	Route::match(['get','post'],'chat_submit', 'ApiController@chatSubmit');

	
	Route::match(['get','post'],'winers_list', 'ApiController@winers_list');
	
	Route::match(['get','post'],'my_participation', 'ApiController@my_participation');
	






	Route::match(['get','post'],'upcoming_events', 'ApiController@upcoming_events');



	Route::match(['get','post'],'gallery_list', 'ApiController@gallery_list');
	Route::match(['get','post'],'subscription_list', 'ApiController@subscription_list');
	Route::match(['get','post'],'wallet_history', 'ApiController@WalletHistory');



	Route::match(['get','post'],'edit_profile', 'ApiController@edit_profile');
	Route::match(['get','post'],'home', 'ApiController@home');
	Route::match(['get','post'],'event_details', 'ApiController@event_details');


	
	
	Route::match(['get','post'],'banners', 'ApiController@banners');
	Route::match(['get','post'],'my_profile', 'ApiController@my_profile');


	
	
	Route::match(['get','post'],'contactus', 'ApiController@contactus');
	Route::match(['get','post'],'privacypolicy', 'ApiController@privacypolicy');
	Route::match(['get','post'],'terms', 'ApiController@terms');

	Route::match(['get','post'],'add_wallet', 'ApiController@add_wallet');




});



