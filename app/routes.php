<?php

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



Route::get('/', array('uses' => 'HomeController@getIndex'));
Route::get('bug-dev', array('uses' => 'HomeController@getDevbug'));
Route::get('changelog', array('uses' => 'HomeController@getChangelog'));
Route::post('rapportera-bugg', array('uses' => 'BugController@postReport'));
Route::post('rapportera-ide', array('uses' => 'IdeaController@postIdea'));

Route::post('login', array('uses' => 'AuthController@postLogin'));
Route::get('logout', array('before' => 'auth', 'uses' => 'AuthController@logout'));
Route::get('registrering', array('before' => 'guest', 'uses' => 'AuthController@getRegister'));
Route::post('registrering', array('before' => 'guest', 'uses' => 'AuthController@postRegister'));

Route::get('notis-last', array('uses' => 'UserController@getNoticeRead'));
Route::put('chatt-last', array('uses' => 'ChatController@putRead'));

// Stad
Route::get('valj-stad', array('before' => 'round.is_active', 'uses' => 'UserController@getChooseTown'));
Route::post('valj-stad', array('before' => 'round.is_active', 'uses' => 'UserController@postChooseTown'));

// Quarter
Route::get('mitt-kvarter', array('before' => 'auth.has_town|auth.home_town|round.is_active' ,'uses' => 'QuarterController@getIndex'));
Route::post('mitt-kvarter/uppgradera-garage', array('before' => 'auth.has_town|auth.home_town|round.is_active' ,'uses' => 'QuarterController@postBuyGarage'));
Route::post('mitt-kvarter/uppgradera-fordon', array('before' => 'auth.has_town|auth.home_town|round.is_active' ,'uses' => 'QuarterController@postBuyVehicle'));
Route::post('mitt-kvarter/lasta-av-pa', array('before' => 'auth.has_town|auth.home_town|round.is_active' ,'uses' => 'QuarterController@postStorage'));

Route::post('mitt-kvarter/fabriker/inaktivera', array('before' => 'auth.has_town|auth.home_town|round.is_active' ,'uses' => 'FactoryController@postInactivateFactory'));
Route::post('mitt-kvarter/fabriker/aktivera', array('before' => 'auth.has_town|auth.home_town|round.is_active' ,'uses' => 'FactoryController@postActivateFactory'));
Route::post('mitt-kvarter/fabriker/hamta-varor', array('before' => 'auth.has_town|auth.home_town|round.is_active' ,'uses' => 'FactoryController@postDeliveryFactory'));
Route::post('mitt-kvarter/fabriker/uppgradera', array('before' => 'auth.has_town|auth.home_town|round.is_active' ,'uses' => 'FactoryController@postUpgradeFactory'));

// Resor
Route::get('resor', array('before' => 'auth.has_town|round.is_active' ,'uses' => 'TravelController@getIndex'));
Route::post('resor', array('before' => 'auth.has_town|round.is_active|csrf|no_ajax' ,'uses' => 'TravelController@postTravel'));

// Marknad
Route::get('marknad', array('before' => 'auth.has_town|round.is_active' ,'uses' => 'MarketController@getIndex'));
Route::post('marknad', array('before' => 'auth.has_town|round.is_active|csrf|no_ajax' ,'uses' => 'MarketController@postMarket'));

// Robberies
Route::get('baxa', array('before' => 'auth.has_town|round.is_active', 'uses' => 'RobController@getRobbing'));
Route::post('baxa', array('before' => 'auth.has_town|round.is_active|csrf|no_ajax', 'uses' => 'RobController@postRobbing'));

// Courses
Route::get('skolan', array('before' => 'auth.has_town|round.is_active', 'uses' => 'CourseController@getCourse'));
Route::post('skolan', array('before' => 'auth.has_town|round.is_active|csrf|no_ajax', 'uses' => 'CourseController@postCourse'));

// Garage
Route::get('garage', array('before' => 'auth.has_town|round.is_active', 'uses' => 'GarageController@getGarages'));
Route::post('garage', array('before' => 'auth.has_town|round.is_active|csrf|no_ajax', 'uses' => 'GarageController@postGarages'));

// Dealers
Route::get('handlare', array('before' => 'auth.has_town|round.is_active', 'uses' => 'DealerController@getDealer'));
Route::post('handlare', array('before' => 'auth.has_town|round.is_active|csrf|no_ajax', 'uses' => 'DealerController@postDealer'));

// Statistics
Route::get('topplista', array('uses' => 'StatisticController@getToplist'));

// Chat
Route::get('chatt', array('before' => 'auth', 'uses' => 'ChatController@getIndex'));
Route::get('skicka-chatt-meddelande', array('uses' => 'ChatController@postMessage'));


//Payment
Route::get('payment/classy/process', array('uses' => 'PaymentController@process'));


// Pedal Shop
Route::get('pedalshop', array('before' => 'auth', 'uses' => 'ShopController@getShop'));
Route::post('pedalshop', array('before' => 'auth', 'uses' => 'ShopController@postShop'));

// User profile
Route::get('anvandare/{id}', array('before' => 'auth.has_town', 'uses' => 'UserController@getProfile'));
Route::get('anvandare/{id}/redigera', array('before' => 'auth.has_town', 'as' => 'update_profile', 'uses' => 'UserController@getEditProfile'));
Route::put('anvandare/{id}/redigera', array('before' => 'auth.has_town', 'as' => 'update_profile', 'uses' => 'UserController@putEditProfile'));

// Forum
Route::get('forum', array('before' => 'auth', 'uses' => 'CategoryController@getIndex'));
Route::get('trad/{id}', array('before' => 'auth', 'uses' => 'ThreadController@getIndex'));
Route::post('svara', array('before' => 'auth', 'uses' => 'PostController@reply'));
Route::post('trad', array('before' => 'auth', 'uses' => 'ThreadController@postThread'));

Route::get('faq', 'FaqController@getIndex');
Route::get('guide', 'FaqController@getGuide');


// Club
Route::get('klubb', array('before' => 'auth|round.is_active', 'uses' => 'ClubController@getIndex'));
Route::get('klubb/{id}', array('before' => 'auth|round.is_active', 'uses' => 'ClubController@getClub'));
Route::get('klubb/ansok/{id}', array('before' => 'auth|round.is_active', 'uses' => 'ClubController@doClubApplication'));
Route::post('klubb/skapa', array('before' => 'auth|round.is_active', 'uses' => 'ClubController@create'));
Route::post('klubb/spara', array('before' => 'auth|round.is_active', 'uses' => 'ClubController@saveDescription'));
Route::post('klubb/riv-upp', array('before' => 'auth|round.is_active', 'uses' => 'ClubController@deleteClub'));
Route::get('klubb/lamna/{id}', array('before' => 'auth|round.is_active', 'uses' => 'ClubController@leaveClub'));
Route::post('klubb/meddelande', array('before' => 'auth|round.is_active', 'uses' => 'ClubController@postClubMessage'));
Route::post('klubb/acceptera_medlem', array('before' => 'auth|round.is_active', 'uses' => 'ClubController@acceptUser'));
Route::post('klubb/neka_medlem', array('before' => 'auth|round.is_active', 'uses' => 'ClubController@declineUser'));

// Meddelanden
Route::get('meddelanden', array('before' => 'auth', 'uses' => 'MessageController@getIndex'));
Route::get('meddelanden/{id}', array('before' => 'auth', 'uses' => 'MessageController@getIndexMember'));
Route::post('skicka-meddelande', array('before' => 'auth', 'uses' => 'MessageController@postMessage'));
Route::post('tabort-meddelande', array('before' => 'auth', 'uses' => 'MessageController@postDeleteMessage'));
Route::put('last-meddelanden', array('before' => 'auth', 'uses' => 'MessageController@putReadMessage'));

Route::post('paypal/ipn', array('uses' => 'PaypalController@ipn'));








// Cronjobs
Route::put('/hidden/thingies/terkam/ofTaQ21X821', array('uses' => 'MarketController@putCronUpdate'));