<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CenterController;
use App\Http\Controllers\Admin\CityController;
use App\Http\Controllers\Admin\CountryController;
use App\Http\Controllers\Admin\MessageController;
use App\Http\Controllers\Auth\PatientRegisterController;
use App\Http\Controllers\DashboardProfileController;
use App\Http\Controllers\Front\FrontController;
use App\Http\Controllers\LocaleController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\Patient\PatientProfileController;
use App\Http\Controllers\Patient\RatingController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\User\AppointmentController as UserAppointmentController;
use App\Http\Controllers\User\OrderController as UserOrderController;
use App\Http\Controllers\User\PatientController as UserPatientController;
use App\Http\Controllers\User\ServiceController as UserServiceController;
use App\Http\Controllers\User\SettingController as UserSettingController;
use App\Http\Controllers\User\SiteController as UserSiteController;
use App\Http\Controllers\User\SliderController as UserSliderController;
use App\Http\Controllers\User\UserController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/register/pending', function () {
    return view('auth.pending');
})->name('register.pending');

// ✅ تسجيل المرضى — مسار منفصل عن تسجيل العيادات
Route::get('/register/patient', [PatientRegisterController::class, 'create'])->name('patient.register');
Route::post('/register/patient', [PatientRegisterController::class, 'store'])->name('patient.register.store');

require __DIR__.'/auth.php';

Route::get('/get-cities', [LocationController::class, 'getCitiesByCountry'])->name('get.cities');

// Admin routes
Route::group(['as' => 'admin.', 'prefix' => 'admin', 'middleware' => ['auth', 'role:admin']], function () {

    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

    Route::resource('category', CategoryController::class);
    Route::put('category-status/{id}', [CategoryController::class, 'changeStatus'])->name('category.status');

    Route::resource('country', CountryController::class);
    Route::put('country-status/{id}', [CountryController::class, 'changeStatus'])->name('country.status');

    Route::resource('city', CityController::class);
    Route::put('city-status/{id}', [CityController::class, 'changeStatus'])->name('city.status');

    Route::resource('center', CenterController::class);
    Route::put('center-status/{id}', [CenterController::class, 'changeStatus'])->name('center.status');

    Route::get('center/{id}/approve-license', [CenterController::class, 'approveLicense'])->name('center.approve-license');
    Route::get('center/{id}/reject-license',  [CenterController::class, 'rejectLicense'])->name('center.reject-license');

    Route::get('/message', [MessageController::class, 'index'])->name('message.index');
    Route::delete('/message/{id}', [MessageController::class, 'destroy'])->name('message.destroy');
});

Route::middleware(['auth', 'role:user'])->group(function () {
    Route::get('/dashboard', [UserController::class, 'dashboard'])->name('user.dashboard');
    Route::get('/pending-approval', function () {
        return view('user.pending-approval');
    })->name('user.pending');
});

Route::group(['as' => 'user.', 'middleware' => ['auth', 'role:user', 'license.approved']], function () {

    Route::get('general-setting', [UserSettingController::class, 'index'])->name('general-setting');
    Route::put('update-general-setting', [UserSettingController::class, 'updateGeneralSetting'])->name('update-general-setting');

    Route::get('site-setting', [UserSiteController::class, 'index'])->name('site-setting');
    Route::put('update-site-setting', [UserSiteController::class, 'updateSiteSetting'])->name('update-site-setting');

    Route::resource('patient', UserPatientController::class);

    Route::resource('service', UserServiceController::class);
    Route::put('service-status/{id}', [UserServiceController::class, 'changeStatus'])->name('service.status');

    Route::resource('slider', UserSliderController::class);

    Route::resource('order', UserOrderController::class, ['only' => ['index', 'edit', 'update']]);

    Route::resource('appointment', UserAppointmentController::class);
    Route::get('calendar', [UserAppointmentController::class, 'calendar'])->name('calendar');
    Route::get('calendar-appointments', [UserAppointmentController::class, 'calendar_appointments'])->name('calendar-appointments');
});

// Front routes
Route::get('/', [FrontController::class, 'home'])->name('site.show');
Route::get('/centers', [FrontController::class, 'centers'])->name('site.centers');
Route::get('/center/{ID}', [FrontController::class, 'center'])->name('site.center');
Route::post('/order', [FrontController::class, 'order'])->name('site.order');
Route::post('/contact', [FrontController::class, 'storem'])->name('contact.store');
Route::get('/get-cities/{countryId}', [FrontController::class, 'getCities']);
Route::get('/about', [FrontController::class, 'about'])->name('site.about');

Route::post('/locale/switch', [LocaleController::class, 'switch'])->name('locale.switch');

// ===== Patient (مريض) =====
Route::middleware(['auth', 'role:patient'])->group(function () {
    Route::get('/my-profile', [PatientProfileController::class, 'show'])->name('patient.profile');
    Route::post('/my-profile', [PatientProfileController::class, 'update'])->name('patient.profile.update');
    Route::post('/my-profile/password', [PatientProfileController::class, 'updatePassword'])->name('patient.profile.password');
    Route::post('/my-profile/delete', [PatientProfileController::class, 'destroy'])->name('patient.profile.destroy');

    Route::post('/rating', [RatingController::class, 'store'])->name('rating.store');
    Route::post('/rating/{centerId}/delete', [RatingController::class, 'destroy'])->name('rating.destroy');
});

// ===== Dashboard profile (admin + clinic) =====
Route::middleware('auth')->group(function () {
    Route::get('/my-account', [DashboardProfileController::class, 'show'])->name('dashboard.profile');
    Route::post('/my-account', [DashboardProfileController::class, 'update'])->name('dashboard.profile.update');
    Route::post('/my-account/password', [DashboardProfileController::class, 'updatePassword'])->name('dashboard.profile.password');
    Route::post('/my-account/delete', [DashboardProfileController::class, 'destroy'])->name('dashboard.profile.destroy');
});
