<?php

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
header('Acess-Control-Allow-Origin:*');
header('Acess-Control-Allow-Method:POST,GET,OPTIONS,PUT,PATCH,DELETE');
header('Acess-Control-Allow-Headers:Content-Type,X-Auth-Token,Origin,Authorization,auth');



//Route::middleware('jwt.auth')->get('initial', function(Request $request) {
//
//    $user = auth()->user();
//    return response()->json([
//        'user'=>$user,
//        'test' => 'cen'
//    ]);
//});

//Route::group(['prefix'=>'guest'],function (){
//    Route::post('store',[
//        'as' => 'guest.store',
//        'uses' => 'Auth\AuthController@guestStore'
//    ]);
//});

Route::post('ownerRegister','Auth\AuthController@ownerStore');
Route::post('ownerLogin','Auth\AuthController@loginOwner');
Route::post('guestRegister','Auth\AuthController@guestStore');
Route::post('guestLogin','Auth\AuthController@loginGuest');
Route::get('initial','Auth\AuthController@initial');
Route::post('updateProfile','Auth\UpdateProfileController@updateProfile');
Route::post('changePassword','Auth\UpdateProfileController@changePassword');
Route::get('activate-email/{id}','UserController@activateEmail')->name('activate-email');
Route::get('activate-phone/{id}','UserController@activatePhone')->name('activate-phone');
Route::get('getFacility','FacilityController@getAll');
Route::get('getAllCity','CityController@getAllCity');
Route::get('getPropertyWithSlug', 'PropertyController@getPropertyWithSlug');
Route::get('getPaginateReview','ReviewController@getPaginateReview');

Route::post('getUser','UserController@getUser');
Route::get('getTags','TagController@getTags');
Route::post('synchronizeChat','ChannelController@synchronizeChat');


Route::post('getNearbyApartement','PropertyController@getNearbyApartement');
Route::post('getNearbyKost','PropertyController@getNearbyKost');
Route::post('sendChat','ChatController@create');
Route::post('getChat','ChannelController@getAllChat');

Route::group(['middleware'=>['jwt.auth']],function (){
    Route::post('emailVerification','UserController@emailVerification');
    Route::post('phoneVerification','UserController@phoneVerification');
});

Route::group(['prefix'=>'guest','middleware'=>['jwt.auth','checkRole:1']],
    function (){
        Route::post('addReport','ReportController@store');
        Route::post('addReview','ReviewController@store');
        Route::post('getFavorite','FavoriteController@getFavorite');
        Route::post('handleFavorite','FavoriteController@store');
        Route::post('getPropertyFavorite/{id}','UserController@getPropertyFavorite');
        Route::get('getViewHistory','HistoryController@index');
        Route::get('getFavoriteHistory','HistoryController@getFavoriteHistory');
        Route::get('getFollowing','FollowController@index');
        Route::post('search','FollowController@search');
        Route::post('getFollow','FollowController@getFollow');
        Route::post('follow','FollowController@store');
        Route::delete('unfollow/{id}','FollowController@destroy');
        Route::get('getAllChat','ChannelController@index');
        Route::post('checkChannel','ChannelController@checkChannel');
    });

Route::group(['prefix'=>'admin','middleware'=> ['jwt.auth','checkRole:3']],
    function (){
        Route::post('storeFacility','FacilityController@store');
        Route::get('getAllFacility','FacilityController@get');
        Route::delete('deleteFacility/{id}','FacilityController@destroy');
        Route::post('updateFacility','FacilityController@update');
        Route::get('searchFacility','FacilityController@search');
        Route::get('getAllGuest','UserController@getGuest');
        Route::get('searchGuest','UserController@searchGuest');
        Route::get('getAllOwner','UserController@getOwner');
        Route::get('searchOwner','UserController@searchOwner');
        Route::post('resetPassword','UserController@resetPassword');
        Route::post('banUser','UserController@banUser');
        Route::get('getAllPremium','PremiumController@getAll');
        Route::delete('deletePremium/{id}','PremiumController@destroy');
        Route::post('updatePremium','PremiumController@update');
        Route::post('addPremium','PremiumController@add');
        Route::get('searchPremium','PremiumController@search');
        Route::post('banProperties','PropertyController@ban');
        Route::post('addPost','PostController@store');
        Route::post('deletePost','PostController@deletePost');
        Route::post('addTag','TagController@store');
        Route::get('getReport','ReportController@index');
        Route::get('getTransaction','TransactionController@index');
        Route::get('analysisAdmin','UserController@adminAnalysis');
});

Route::group(['prefix'=>'owner','middleware'=> ['jwt.auth','checkRole:2']],
    function (){
        Route::post('addApartemen','PropertyController@addApartemen');
        Route::post('addKost','PropertyController@addKost');
        Route::post('buyPremium','TransactionController@store');
        Route::get('getAllApartement','UserController@getAllApartement');
        Route::get('getAllHouse','UserController@getAllHouse');
        Route::post('deleteProperty','PropertyController@deleteProperty');
        Route::get('getOwnerDetail','UserController@getOwnerDetail');
        Route::get('getHistoryTransaction','TransactionController@getHistoryTransaction');
        Route::get('getAllChat','ChannelController@index');

});
Route::group(['middleware'=> ['jwt.auth','getUser']],function (){
    Route::get('getPosts','PostController@index');
    Route::post('getPostWithSlug','PostController@getPostWithSlug');
    Route::get('getFourPost','PostController@getFourPost');
    Route::get('getPostWithTag/{id}','PostController@getPostWithTag');
});

Route::post('getFourApartement','PropertyController@getFourApartement');
Route::post('getFourKost','PropertyController@getFourKost');
Route::post('getAverageReview','ReviewController@getAverageReview');
Route::get('getRandomApartement','PropertyController@getRandomApartement');
Route::get('getRandomKost','PropertyController@getRandomKost');


Route::middleware('jwt.auth')->group(function(){
    Route::get('logout','Auth\AuthController@logout');
});
