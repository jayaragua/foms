<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

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

Route::get('/', function () {
    return view('auth.login');	
});

Auth::routes();


// Equipment
Route::get('equipment', [App\Http\Controllers\equipmentController::class, 'viewEquipment']);
Route::get('/api/getEquipList', [App\Http\Controllers\equipmentController::class, 'getEquipList']);
Route::post('app/SaveEquipment', [App\Http\Controllers\equipmentController::class, 'SaveEquipment']);
Route::post('app/DeleteEquipment/{id}', [App\Http\Controllers\equipmentController::class, 'DeleteEquipment']);
Route::post('app/SaveEditEquipment', [App\Http\Controllers\equipmentController::class, 'SaveEditEquipment']);


// trip ticket
Route::get('trip-ticket', [App\Http\Controllers\tripTicketController::class, 'viewTripTicket']);
Route::get('/api/getTripTicketList', [App\Http\Controllers\tripTicketController::class, 'getTripTicketList']);
Route::get('/api/getProduct', [App\Http\Controllers\tripTicketController::class, 'getProduct']);
Route::get('/api/getDriver', [App\Http\Controllers\tripTicketController::class, 'getDriver']);
Route::get('/api/getVehicle', [App\Http\Controllers\tripTicketController::class, 'getVehicle']);
Route::get('/api/getPlaceVisited', [App\Http\Controllers\tripTicketController::class, 'getPlaceVisited']);
Route::get('/api/getVehicleSpec/{id}', [App\Http\Controllers\tripTicketController::class, 'getVehicleSpec']);
Route::post('app/SaveTripTicket', [App\Http\Controllers\tripTicketController::class, 'SaveTripTicket']);
Route::post('app/SaveTripEditTicket', [App\Http\Controllers\tripTicketController::class, 'SaveTripEditTicket']);
Route::post('app/DeleteTripTicket/{id}', [App\Http\Controllers\tripTicketController::class, 'DeleteTripTicket']);

// Vehicle
Route::get('vehicle', [App\Http\Controllers\vehicleController::class, 'viewVehicle']);
Route::get('/api/getVecList', [App\Http\Controllers\vehicleController::class, 'getVecList']);
Route::post('app/SaveEquipment', [App\Http\Controllers\vehicleController::class, 'SaveEquipment']);
Route::post('app/DeleteEquipment/{id}', [App\Http\Controllers\vehicleController::class, 'DeleteEquipment']);
Route::post('app/SaveEditEquipment', [App\Http\Controllers\vehicleController::class, 'SaveEditEquipment']);

//user
//user controller
Route::get('/api/getUser', [App\Http\Controllers\userController::class, 'getUser']);
Route::post('app/create_user',[App\Http\Controllers\userController::class, 'addUser']);
// Route::get('/logout','userController@logout');
Route::get('user', [App\Http\Controllers\userController::class, 'view_profile']); 
Route::post('app/editUser', [App\Http\Controllers\userController::class, 'edituser']); 

Route::post('app/delete_user/{id}',[App\Http\Controllers\userController::class, 'delete_user']);


// //change password
// Route::post('app/changepass',[App\Http\Controllers\attendanceController::class, 'changepass']);    


Route::get('/api/getprog', [App\Http\Controllers\tesStudController::class, 'getprog']); 



//student profile
Route::get('student', [App\Http\Controllers\tesStudController::class, 'viewstudent']);
// Route::get('/api/getStudents', [App\Http\Controllers\tesStudController::class, 'getStudents']);
Route::get('getStudents', [App\Http\Controllers\tesStudController::class, 'getStudents']);
// Route::get('category', 'Api\CategoryController@getAll');
Route::get('student-filter', [App\Http\Controllers\tesStudController::class, 'getBySearch']);

Route::get('student-filterYear', [App\Http\Controllers\tesStudController::class, 'student_filterYear']);


Route::get('student-filterYearSearch', [App\Http\Controllers\tesStudController::class, 'student_filterYearSearch']);

Route::get('getStudentschk', [App\Http\Controllers\tesStudController::class, 'getStudentschk']);

Route::get('student-filterYearCheckbox', [App\Http\Controllers\tesStudController::class, 'student_filterYearCheckbox']);


Route::get('/api/exportall', [App\Http\Controllers\tesStudController::class, 'exportall']);
Route::get('/api/exportallFilter', [App\Http\Controllers\tesStudController::class, 'exportallFilter']);

Route::get('/api/exportallFiltercheckbox', [App\Http\Controllers\tesStudController::class, 'exportallFiltercheckbox']);
Route::get('/api/exportallcheckbox', [App\Http\Controllers\tesStudController::class, 'exportallcheckbox']);




//forward grantees
Route::post('app/forwardGrantees', [App\Http\Controllers\tesStudController::class, 'forwardGrantees']);
Route::post('app/EditGrantees', [App\Http\Controllers\tesStudController::class, 'EditGrantees']);
Route::post('app/forwardIndiGrantee/{studid}', [App\Http\Controllers\tesStudController::class, 'forwardIndiGrantee']);


Route::get('/api/getActiveTerm', [App\Http\Controllers\tesStudController::class, 'getActiveTerm']);
Route::get('/api/checkForward', [App\Http\Controllers\tesStudController::class, 'checkForward']);
Route::get('/api/getSchTerm', [App\Http\Controllers\tesStudController::class, 'getSchTerm']);



Route::post('app/changeStaLock/{term}', [App\Http\Controllers\tesStudController::class, 'changeStaLock']);
Route::post('app/changeStaUnLock/{term}', [App\Http\Controllers\tesStudController::class, 'changeStaUnLock']);

Route::post('app/changeStaLockPrev/{term}', [App\Http\Controllers\tesStudController::class, 'changeStaLockPrev']);
Route::post('app/changeStaUnLockPrev/{term}', [App\Http\Controllers\tesStudController::class, 'changeStaUnLockPrev']);

Route::post('app/OnAction/{forward}', [App\Http\Controllers\tesStudController::class, 'OnAction']);

Route::post('app/removeGrantee/{studid}/{term}', [App\Http\Controllers\tesStudController::class, 'removeGrantee']);

//TES STUDENTS

//semester
Route::get('tes-student', [App\Http\Controllers\tesStudController::class, 'viewtesStudent']);




Route::get('/api/getSem2', [App\Http\Controllers\tesStudController::class, 'getSem']);
// Route::get('/api/gettesStud/{term}', [App\Http\Controllers\tesStudController::class, 'gettesStud']);
Route::get('/api/getTesStudents/{term}', [App\Http\Controllers\tesStudController::class, 'getTesStudents']);

Route::get('/api/getTesStudentsNotEnrol/{term}', [App\Http\Controllers\tesStudController::class, 'getTesStudentsNotEnrol']);


Route::get('/api/getStudInfoDtls/{stud}', [App\Http\Controllers\tesStudController::class, 'getStudInfoDtls']);

Route::get('not-enrolled', [App\Http\Controllers\tesStudController::class, 'viewtesStudentNotEnrolAY']);

Route::post('app/uploadLoa', [App\Http\Controllers\tesStudController::class, 'uploadLoa']);




//AY
// Route::get('tes-student-AY', [App\Http\Controllers\tesStudController::class, 'viewtesStudentAY']);


// logs
// tes fund hdr
Route::get('logs', [App\Http\Controllers\tesfundController::class, 'viewlogs']);
Route::get('getlogs', [App\Http\Controllers\tesfundController::class, 'getlogs']);



// tes fund hdr
Route::get('tes-fund', [App\Http\Controllers\tesfundController::class, 'viewtesFund']);

Route::get('/api/getTESFund', [App\Http\Controllers\tesfundController::class, 'getTESFund']);

Route::get('/api/geturl', [App\Http\Controllers\tesfundController::class, 'geturl']);



//tesfund
Route::post('app/SaveFund', [App\Http\Controllers\tesfundController::class, 'SaveFund']);
Route::post('app/SaveEditFund', [App\Http\Controllers\tesfundController::class, 'SaveEditFund']);

Route::post('app/cancel/{id}', [App\Http\Controllers\tesfundController::class, 'cancel']);

Route::post('app/UncancelFund/{id}', [App\Http\Controllers\tesfundController::class, 'UncancelFund']);

Route::post('app/Utilized/{id}', [App\Http\Controllers\tesfundController::class, 'Utilized']);

Route::post('app/Unutilized/{id}', [App\Http\Controllers\tesfundController::class, 'Unutilized']);





Route::post('app/DeleteFund/{id}', [App\Http\Controllers\tesfundController::class, 'DeleteFund']);
Route::post('tes-fund-disbursement/app/DeleteFundDis/{id}', [App\Http\Controllers\tesfundController::class, 'DeleteFundDis']);





Route::get('tes-fund-disbursement', [App\Http\Controllers\tesfundController::class, 'viewtesFundDtl']);

Route::get('tes-fund-disbursement/{id}', [App\Http\Controllers\tesfundController::class, 'viewtesFundDtl1']);

Route::get('/api/getTESFund/{id}', [App\Http\Controllers\tesfundController::class, 'getTESFundDis']);

Route::get('/api/getTESFundExport/{id}', [App\Http\Controllers\tesfundController::class, 'getTESFundExport']);

Route::get('/api/getTESFundDisburse/{id}', [App\Http\Controllers\tesfundController::class, 'getTESFundDisburse']);

Route::get('/api/getTESFundAdminCost/{id}', [App\Http\Controllers\tesfundController::class, 'getTESFundDisAdminCost']);
Route::get('/api/getTESFundDisTESCost/{id}', [App\Http\Controllers\tesfundController::class, 'getTESFundDisTESCost']);



Route::post('tes-fund-disbursement/app/SaveFundDis', [App\Http\Controllers\tesfundController::class, 'SaveFundDis']);
Route::post('tes-fund-disbursement/app/SaveEditFundDis', [App\Http\Controllers\tesfundController::class, 'SaveEditFundDis']);





//tesdocuments
Route::get('tesdocs', [App\Http\Controllers\tesDocController::class, 'viewtesDocs']);

Route::get('/api/getdocs', [App\Http\Controllers\tesDocController::class, 'getDocsScholar']);
Route::get('/api/getdoctypelist', [App\Http\Controllers\tesDocController::class, 'getdoctypelist']);


Route::post('app/SaveDocs', [App\Http\Controllers\tesDocController::class, 'SaveDocs']);

Route::post('app/SaveEditDocs', [App\Http\Controllers\tesDocController::class, 'SaveEditDocs']);

Route::post('app/Deletedoc/{id}', [App\Http\Controllers\tesDocController::class, 'Deletedoc']);

// Route::get('/api/getdoctypelist', [App\Http\Controllers\tesDocController::class, 'getdoctypelist']);

Route::post('app/SaveDocstype', [App\Http\Controllers\tesDocController::class, 'SaveDocstype']);

Route::post('app/Deletedoctype/{id}', [App\Http\Controllers\tesDocController::class, 'Deletedoctype']);



//COR
Route::get('/api/getStudCOR/{term}/{id}', [App\Http\Controllers\tesStudController::class, 'getStudCOR']);


Route::get('/api/getStudTotUnits2/{term}/{id}', [App\Http\Controllers\tesStudController::class, 'getStudTotUnits']);
// Route::get('/api/getStudTotUnits2/{term}', 'corStudController@getStudTotUnits');


//grade
Route::get('/api/getStudGrade/{term}/{id}', [App\Http\Controllers\tesStudController::class, 'getStudGrade']);
Route::get('/api/getStudGWA/{term}/{id}', [App\Http\Controllers\tesStudController::class, 'getStudGWA']);


Route::get('tes-student-Stat', [App\Http\Controllers\tesStudController::class, 'viewtesStudentPayStat']);
Route::get('/api/getTesStudentsPayment/{term}', [App\Http\Controllers\tesStudController::class, 'getTesStudentsPayment']);



Route::post('app/EditGranteesPayment', [App\Http\Controllers\tesStudController::class, 'EditGranteesPayment']);



Route::get('/home', [HomeController::class, 'index'])->name('home');


Route::get('/home', [HomeController::class, 'index'])->name('auth');
// Route::get('/', 'HomeController@index')->middleware('auth');