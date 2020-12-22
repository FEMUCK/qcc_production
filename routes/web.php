<?php
use App\Http\Controllers\LanguageController;
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

//*! START QCC Route */

Route::get('/', 'UserController@userLogin')->name('user-login');
Route::get('/user-login', 'UserController@userLogin')->name('user-login');

// Route::get('/', function () {
//     return view('login');
// });

Route::post('/login-process', 'UserController@loginProcess')->name('login-process');
Route::get('/logout', 'UserController@Logout')->name('logout');
// Route::post('/login', 'UserController@chkAuthen');

// Route::get('logout', function () {
//     Session::flush();
//     // Session::regenerate();
//     Auth::logout();
//     // return view('user-login');
// });

// Route::get('/', 'PageController@homePage');
Route::get('/page-home', 'PageController@homePage')->name('home');
Route::get('/page-qcc-dashboard', 'PageController@qccDashboardPage')->name('page-qcc-dashboard');
Route::get('/page-qcc-register', 'PageController@qccRegisterPage')->name('page-qcc-register');
Route::get('/page-qcc-datatable', 'PageController@qccDataTablePage')->name('page-qcc-datatable');
Route::get('/page-qcc-users-list', 'PageController@qccUsersListPage')->name('page-qcc-users-list');
Route::get('/page-qcc-view/{groupyear}/{groupid}', 'PageController@qccView')->name('page-qcc-view');
Route::get('/page-qcc-edit/{groupyear}/{groupid}', 'PageController@qccEdit')->name('page-qcc-edit');
Route::get('/page-qcc-system-setting', 'PageController@qccSystemSetting')->name('page-qcc-system-setting');

// สำหรับ Dependent Dropdown View:page-qcc-users-list
Route::get('/faylist/{longno}', 'PageController@getFay');
// สำหรับ onkeyup 'addQccAuthForm' VIEW page-qcc-users-list
Route::get('/usersdata/{userid}', 'PageController@getUsersData')->name('usersdata');
// สำหรับการเพิ่มข้อมูลกิจกรรม QCC VIEW page-qcc-register
Route::post('addqcc', 'QccController@qccAdd')->name('addqcc');
// สำหรับการแก้ไขข้อมูลกิจกรรม QCC VIEW page-qcc-edit
Route::post('editqcc', 'QccController@qccEdit')->name('editqcc');
// สำหรับการลบข้อมูลกิจกรรม QCC VIEW page-qcc-datatable
Route::get('deleteqcc/{groupyear}/{groupid}', 'PageController@qccDelete')->name('deleteqcc');
// สำหรับการเพิ่มข้อมูล QCC User VIEW page-qcc-users-list
Route::post('addqccauth', 'PageController@addQccAuth')->name('addqccauth');
// สำหรับการลบข้อมูล QCC User VIEW page-qcc-users-list
Route::get('deleteqccauth/{userid}', 'PageController@deleteQccAuth')->name('deleteqccauth');

// สำหรับการ Export S012 User list VIEW : page-qcc-users-list
Route::get('page-qcc-users-list/export', 'ExportController@QccUsersS012ListExport')->name('page-qcc-users-list/export');
// สำหรับการ Export QCC list VIEW : page-qcc-datatable
Route::get('page-qcc-datatable/export', 'ExportController@QccDataListExport')->name('page-qcc-datatable/export');
// สำหรับการเปิดปิด Modules VIEW : page-qcc-system-setting
Route::post('updateannouncementmodulestatus', 'SystemsettingController@updateAnnouncementModuleStatus')->name('updateannouncementmodulestatus');
Route::post('updatecreatemodulestatus', 'SystemsettingController@updateCreateModuleStatus')->name('updatecreatemodulestatus');
Route::post('updateeditmodulestatus', 'SystemsettingController@updateEditModuleStatus')->name('updateeditmodulestatus');
Route::post('updatedeletemodulestatus', 'SystemsettingController@updateDeleteModuleStatus')->name('updatedeletemodulestatus');
Route::post('updatepresentationroundmodulestatus', 'SystemsettingController@updatePresentationRoundModuleStatus')->name('updatepresentationroundmodulestatus');
Route::post('updateprizeresultsmodulestatus', 'SystemsettingController@updatePrizeResultsModuleStatus')->name('updateprizeresultsmodulestatus');
// สำหรับการเปิดปิด Site Maintenance Modules VIEW : page-qcc-system-setting
Route::post('updatemaintenancemodulestatus', 'SystemsettingController@updateMaintenanceModuleStatus')->name('updatemaintenancemodulestatus');
Route::get('/page-qcc-maintenance', 'MiscController@QccMaintenancePage')->name('page-qcc-maintenance');
Route::get('/page-qcc-403', 'MiscController@Qcc403Page')->name('page-qcc-403');
Route::get('/page-qcc-access-denied', 'MiscController@QccAccessDenied')->name('page-qcc-access-denied');

// สำหรับ Update System year Onkeyup VIEW : page-qcc-system-setting
Route::post('updateqccsystemyear', 'SystemsettingController@updateQccSystemYear')->name('updateqccsystemyear');
// สำหรับ Update System Start Date Onchange VIEW : page-qcc-system-setting
Route::post('updateqccsystemstrtdate', 'SystemsettingController@updateQccSystemStrtDate')->name('updateqccsystemstrtdate');
// สำหรับ Update System End Date Onchange VIEW : page-qcc-system-setting
Route::post('updateqccsystemenddate', 'SystemsettingController@updateQccSystemEndDate')->name('updateqccsystemenddate');

// สำหรับแสดงค่าจำนวนผลงานแยกประเภทแยกตามสายรอง VIEW : page-qcc-dashboard
Route::get('gethorizontalbarchartdata','PageController@getHorizontalBarChartData')->name('gethorizontalbarchartdata');
// สำหรับแสดงค่าต่างๆแยกประเภทแยกตามสายรอง VIEW : page-qcc-dashboard
Route::get('getverticalbarchartdata','PageController@getVerticalBarChartData')->name('getverticalbarchartdata');
// สำหรับแสดงค่าจำนวนผลงานแยกตามสายรอง VIEW : page-qcc-dashboard
Route::get('getpolarchartdata','PageController@getPolarChartData')->name('getpolarchartdata');

// ไว้เรียกค่า Dependent Dropdown form DB VIEW : page-qcc-register, page-qcc-edit
Route::get('subknowledgelist/{mainknowledgeid}', 'PageController@getDependentDropdownSubKnowledgeList');

//*! END QCC Route */

// locale route
Route::get('lang/{locale}',[LanguageController::class, 'swap']);
