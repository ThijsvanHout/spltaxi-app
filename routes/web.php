<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\DriverController;
use App\Http\Controllers\DriverBookingController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PageDetailController;
use App\Http\Controllers\PageDataController;
use App\Http\Controllers\WhatsAppWebhookController;

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

Route::post('/', [PageDataController::class, 'reserve'])->name('reserve');
Route::get('/', [PageDataController::class, 'getreserve']);

/*
Route::get('/', function () {
    return view('frontend/home');
});
Route::get('/en', function () {
    return view('frontend/homeen');
});
Route::get('/he', function () {
    return view('frontend/homehe');
});
*/



Route::middleware(['admin'])->group(function () {
    Route::get('/admin', [AdminController::class, 'index']);
    Route::post('/admin/logout', [AdminController::class, 'logout'])->name('admin.logout');
    Route::resource('admin/bookings', 'App\Http\Controllers\BookingController');
    Route::resource('admin/drivers', 'App\Http\Controllers\DriverController');
    Route::get('/admin/completed-bookings', [BookingController::class, 'completedBookings'])->name('completedbookings');
	Route::post('/admin/completed-bookings/filter', [BookingController::class, 'filter'])->name('bookings-filter');
	Route::post('/admin/completed-bookings/filterPeriod', [BookingController::class, 'filterPeriod'])->name('bookings-filterPeriod');
    Route::post('admin/booking-status', [BookingController::class, 'bookingStatus'])->name('admin/bookingStatus');
    /*
    Route::get('/admin/bookings/add', function(){
        return view('layouts/addbookings');
    });
    Route::get('/admin/bookings', [BookingController::class, 'index'])->name('bookings.index');
    Route::get('/admin/bookings/edit', function(){
        return view('layouts/editbookings');
    });
    Route::get('/admin/bookings/delete', function(){
        return view('layouts/deletebookings');
    });
    */
	
	Route::delete('/admin/bookings/{id}', 'BookingController@destroy')->name('bookings.destroy');

	Route::get('admin/bookings/{id}/copy2', [BookingController::class, 'copy2'])->name('copy2');
	Route::get('admin/bookings/{id}/retFlight', [BookingController::class, 'retFlight'])->name('retFlight');
	Route::get('admin/bookings/completed-bookings/onaccountComp', [BookingController::class, 'onaccountCompleted'])->name('onaccountcompbookings');
	Route::get('admin/bookings/bookings/onaccount', [BookingController::class, 'onaccountNew'])->name('onaccountnewbookings');
	
	// Drivers	

	Route::get('/admin/drivers', [DriverController::class, 'index'])->name('admin.drivers');
    Route::get('/admin/drivers/add', function () {
        return view('layouts/adddrivers');
    });
    Route::post('/admin/drivers', [DriverController::class, 'store'])->name('drivers.store');
	Route::post('/admin/drivers/update-order', [DriverController::class, 'updateOrder'])->name('drivers.update-order');
    
    Route::get('/admin/drivers/delete', function () {
        return view('layouts/deletedrivers');
    });
    Route::post('admin/assign-driver', [DriverBookingController::class, 'create'])->name('admin/assign-driver');
	
	// Companies	
    Route::get('/admin/companies', [BookingController::class, 'showCompanies'])->name('admin.companies');
    Route::get('/admin/companies/add', function () {
        return view('layouts/addcompanies');
    });
    Route::post('/admin/companies', [BookingController::class, 'storeCompany'])->name('companies.store');
    Route::get('/admin/companies/delete', function () {
        return view('layouts/deletecompanies');
    });
	Route::get('admin/companies/{id}/edit', [BookingController::class, 'editCompany']);
	
	//whatsapp edit
	Route::get('admin/whatsapp/{id}/edit', [BookingController::class, 'editWhatsapp']);

	// Admin users	
    Route::get('/admin/admins', [AdminController::class, 'showAdmins'])->name('admin.admins');
	Route::get('/admin/admins/add', function () {
        return view('admin/addadmins');
    });
    Route::post('/admin/admins', [AdminController::class, 'storeAdmin'])->name('admins.store');
   /* Route::get('/admin/admins/delete', function () {
        return view('layouts/deletecadmins
    });*/
	Route::get('admin/admins/{id}/edit', [AdminController::class, 'editAdmin']);
	
	// Factuur
	Route::get('/admin/invoice', [BookingController::class, 'invoice'])->name('admin.invoice');
	Route::get('/admin/createinvoicecompany', [BookingController::class, 'createInvoicecompany'])->name('admin.createinvoicecompany');
	Route::get('/admin/createinvoiceclient', [BookingController::class, 'createInvoiceClient'])->name('admin.createInvoiceClient');
	Route::post('/admin/showinvoice', [BookingController::class, 'showinvoice'])->name('admin.showinvoice');
	Route::post('/admin/invoicecompany', [BookingController::class, 'invoicecompany'])->name('admin.invoicecompany');
	Route::post('/admin/invoiceclient', [BookingController::class, 'invoiceClient'])->name('admin.invoiceClient');
	Route::get('admin/invoice/{id}/edit', [BookingController::class, 'editInvoice'])->name('admin.editinvoice');
});
	
Route::get('/admin/login', [AdminController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [AdminController::class, 'login']);
Route::get('/admin/{id}/password', [AdminController::class, 'passwordForm'])->name('admin.passwordForm');
Route::post('/admin/password', [AdminController::class, 'password'])->name("admin.password");

// Route::get('/admin/details', function(){
//     return view('layouts/adddetails');
// });
Route::get('/admin/details', [PageDetailController::class, 'show']);
Route::post('/admin/details', [PageDetailController::class, 'details'])->name('details.save');
//Route::any('/admin/details', [PageDetailController::class, 'show']);
Route::post('/admin/update', [PageDetailController::class, 'update'])->name('details.update');
Route::post('/admin/destroy', [PageDetailController::class, 'destroy'])->name('details.destroy');

Route::get('/about', function () {
    return view('frontend/about');
});

Route::get('/aalsmeer', [PageDataController::class, 'aalsmeer'])->name('aalsmeer');
Route::get('/abcoude', [PageDataController::class, 'abcoude'])->name('abcoude');
Route::get('/amsterdam', [PageDataController::class, 'amsterdam'])->name('amsterdam');
Route::get('/diemen', [PageDataController::class, 'diemen'])->name('diemen');
Route::get('/duivendrecht', [PageDataController::class, 'duivendrecht'])->name('duivendrecht');
Route::get('/haarlem', [PageDataController::class, 'haarlem'])->name('haarlem');
Route::get('/ouderkerk', [PageDataController::class, 'ouderkerk'])->name('ouderkerk');
Route::get('/uithoorn', [PageDataController::class, 'uithoorn'])->name('uithoorn');

Route::post('/reserve', [PageDataController::class, 'reserve'])->name('reserve');
Route::get('/reserve', [PageDataController::class, 'getreserve']);


Route::post('/admin/bookings/adminstore', [BookingController::class, 'adminstore'])->name('bookings.adminstore');
Route::post('/bookings', [BookingController::class, 'store'])->name('bookings.store');
Route::post('/update', [BookingController::class, 'update'])->name('bookings.update');
Route::post('/drivers/update', [DriverController::class, 'update'])->name('drivers.update');
Route::post('/companies/update', [BookingController::class, 'updateCompany'])->name('companies.update');
Route::post('/invoice/update', [BookingController::class, 'updateInvoice'])->name('invoice.update');
Route::post('/admins/update', [AdminController::class, 'updateAdmin'])->name('admins.update');


Route::get('/send-whatsapp/{to}/{message}', [BookingController::class, 'sendWhatsAppMessage'])->name('send.whatsapp');
Route::get('/whatsapp/send', function() {
    $phone = request('phone');
    $message = request('message');
	
    // Verwijder alles behalve cijfers in telefoonnummer
    $phone = preg_replace('/\D/', '', $phone);

    // Bouw de WhatsApp URL
    $whatsapp_url = "https://api.whatsapp.com/send?phone={$phone}&text=" . urlencode($message);

    // Redirect direct naar WhatsApp
    return redirect($whatsapp_url);
	
})->name('whatsapp.send');



Route::get('driver-confirmation/{assign_id}', [DriverBookingController::class, 'show'])->name('driver-confirmation');
Route::get('user-confirmation/{assign_id}', [DriverBookingController::class, 'showUserConfirmation'])->name('user-confirmation');
Route::get('user-receipt/{assign_id}', [DriverBookingController::class, 'showUserReceipt'])->name('user-receipt');
Route::get('user-receipt-no-assign/{id}', [BookingController::class, 'showUserReceipt'])->name('user-receipt');
Route::get('user-receipt-email/{assign_id}', [DriverBookingController::class, 'userReceiptEmail'])->name('user-receipt-email');
Route::get('user-receipt-email-no-assign/{id}', [BookingController::class, 'userReceiptMail'])->name('user-receipt-email');
Route::get('user-receipt-edit/{assign_id}', [DriverBookingController::class, 'userReceiptEdit'])->name('user-receipt-edit');
Route::get('user-receipt-edit-no-assign/{id}', [BookingController::class, 'userReceiptEdit'])->name('user-receipt-edit');
Route::post('/driver-confirmation/{assign_id}/response', [DriverBookingController::class, 'respondBooking'])->name('driver-confirmation-response');

//Ophalen WhatsApp berichten
// Voor verificatie (GET-verzoek door WhatsApp)
Route::get('/whatsapp/webhook', [BookingController::class, 'whatsappVerify']);

// Voor ontvangen berichten (POST-verzoek door WhatsApp)
Route::post('/whatsapp/webhook', [BookingController::class, 'whatsappReceive']);

//ophalen mail berichten doorgestuurd vanaf whats app
Route::get('/fetch-mails', [BookingController::class, 'fetchOutlookMails']);



