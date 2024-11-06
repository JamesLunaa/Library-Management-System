<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Auth\ChangePasswordController;
use App\Http\Controllers\Admin\AddUserController;
use App\Http\Controllers\Admin\ApprovedListController;
use App\Http\Controllers\Admin\RequestInboxController;
use App\Http\Controllers\Admin\BorrowedBooksController;
use App\Http\Controllers\Admin\RecordsController;
use App\Http\Controllers\Admin\AttendanceController;
use App\Http\Controllers\Admin\AddBookController;
use App\Http\Controllers\Admin\RemoveBookController;
use App\Http\Controllers\Admin\RemoveUserController;
use App\Http\Controllers\Admin\SearchBookController;

//for users
use App\Http\Controllers\Users\UserBookController;
use App\Http\Controllers\Users\UserPageController;
use App\Http\Controllers\Users\RequestController;
use App\Http\Controllers\Users\UserBorrowedController;
use App\Http\Controllers\Users\UserRecordController;
use App\Http\Controllers\Users\FeedbackController;

//for dev
use App\Http\Controllers\Developer\devController;


Route::get('/', function () {
    return view('welcome'); 
})->name('login');

Route::get('/login', function () {
    return view('welcome'); // Assuming 'welcome' is your login page view
})->name('login');

Route::post('/logout', function () {
    Auth::logout();
    return redirect('/');
})->name('logout');

Route::post('/login', [LoginController::class, 'login'])->name('login');

// Admin Routes
Route::middleware(['auth', 'checkAccountLevel:librarian'])->group(function () {

    //Manage Book
    Route::get('/librarian/addBook', [AdminController::class, 'addBook'])->name('admin.addBook');
    Route::post('/librarian/addBook', [AddBookController::class, 'addBook']) ->name('addBook');
    Route::get('/librarian/removeBook', [RemoveBookController::class, 'removeBook'])->name('admin.removeBook');
    Route::post('/librarian/removeBook/search', [RemoveBookController::class, 'removeBook']) ->name('removeList');
    Route::post('/librarian/removeBook/delete', [RemoveBookController::class, 'deleteBook']) ->name('removeBooks');

    //Manage User
    Route::get('/librarian/addUser', [AdminController::class, 'addUser'])->name('admin.addUser');
    Route::post('/librarian/addUser', [AddUserController::class, 'addUser'])->name('admin.addUser.submit');
    Route::get('/librarian/removeUserList', [RemoveUserController::class, 'userList'])->name('admin.removeUser');
    Route::post('/librarian/removeUser', [RemoveUserController::class, 'userList'])->name('userList');
    Route::post('/librarian/deleteUser', [RemoveUserController::class, 'deleteUser'])->name('userDelete');

    //Manage Approved
    Route::get('/librarian/approvedList', [ApprovedListController::class, 'approvedList'])->name('admin.approvedList');
    Route::post('/librarian/approvedList', [ApprovedListController::class, 'approvedList'])->name('approvedList');
    Route::post('/librarian/markClaimed', [ApprovedListController::class, 'markClaimed'])->name('markClaimed');
    Route::post('/librarian/cancelRequest', [ApprovedListController::class, 'cancelRequest'])->name('cancelRequest');
    
    //Manage Attendance
    Route::get('/librarian/attendance', [AttendanceController::class, 'attendanceList'])->name('admin.attendance');
    Route::post('/librarian/attendance', [AttendanceController::class, 'attendanceList']) ->name('attendance');

    //Manage Borrowed Books
    Route::get('/librarian/borrowedBooks', [BorrowedBooksController::class, 'borrowedBooks'])->name('admin.borrowedBooks');
    Route::post('/librarian/borrowedBooks', [BorrowedBooksController::class, 'borrowedBooks']) ->name('borrowedBooks');
    Route::post('/librarian/markReturned', [BorrowedBooksController::class, 'markReturned']) ->name('markReturned');
    Route::post('/librarian/markLost', [BorrowedBooksController::class, 'markLost']) ->name('markLost');

    //Manage Password ^
    Route::get('/librarian/changePass', [AdminController::class, 'changePass'])->name('admin.changePass');
    Route::post('/librarian/changePass', [ChangePasswordController::class, 'changePassword'])->name('password.update');

    //Manage Records
    Route::get('/librarian/records', [RecordsController::class, 'recordList'])->name('admin.records');
    Route::post('/librarian/records', [RecordsController::class, 'recordList']) ->name('records');

    //Manage Request
    Route::get('/librarian/requestInbox', [RequestInboxController::class, 'requestInbox'])->name('admin.requestInbox');
    Route::post('/librarian/requestInbox', [RequestInboxController::class, 'requestInbox'])->name('requestInbox');
    Route::post('/librarian/approveRequest', [RequestInboxController::class, 'approveRequest'])->name('approveRequest');
    Route::post('/librarian/rejectRequest', [RequestInboxController::class, 'rejectRequest'])->name('rejectRequest');
    
    //Manage Book List
    Route::get('/librarian/searchBook', [SearchBookController::class, 'bookListAdmin'])->name('admin.searchBook');
    Route::post('/librarian/bookListAdmin', [SearchBookController::class, 'bookListAdmin']) ->name('bookListAdmin');
    Route::post('/librarian/changeStatus', [SearchBookController::class, 'changeStatus']) ->name('changeStat');
    Route::post('/librarian/ajaxSearch', [SearchBookController::class, 'ajaxSearch'])->name('ajax.bookSearch');
});

//User Routes
Route::middleware(['auth', 'checkAccountLevel:user'])->group(function () {
    
    //Manage Books
    Route::get('/user/searchBook', [UserBookController::class, 'bookList'])->name('user.searchBook');
    Route::post('/user/bookList', [UserBookController::class, 'bookList']) ->name('bookList');
    Route::get('/user/userBorrow', [UserBookController::class, 'borrow'])->name('user.borrow');
    Route::post('/user/borrow', [UserBookController::class, 'borrow']) ->name('borrow');
    Route::post('/user/thisBook', [UserBookController::class, 'thisBook']) ->name('thisBook');
    Route::get('/user/confirmBook', [UserBookController::class, 'confirmBook'])->name('confirmBook');
    Route::post('/user/ajaxSearch', [UserBookController::class, 'userAjaxSearch'])->name('user.ajax.bookSearch');

    //Manage Request
    Route::get('/user/requestStatus', [RequestController::class, 'requestList'])->name('user.requestStatus');
    Route::post('/user/cancelUserRequest', [RequestController::class, 'cancel'])->name('cancelUserRequest');

    //Manage Password
    Route::get('/user/changePass', [UserPageController::class, 'changePass'])->name('user.changePass');
    Route::post('/user/changePass', [ChangePasswordController::class, 'changePassword'])->name('user.password.update');
    
    //Manage Borrowed
    Route::get('/user/borrowedBooks', [UserBorrowedController::class, 'borrowedBook'])->name('user.borrowedBooks');
    
    //Manage Record
    Route::get('/user/userRecords', [UserRecordController::class, 'userRecord'])->name('user.records');
    Route::post('/user/userRecords', [UserRecordController::class, 'userRecord'])->name('userRecords');

    //Submit Feedback
    Route::get('/user/feedback', [UserPageController::class, 'feedback'])->name('user.feedback');
    Route::post('/user/feedback', [FeedbackController::class, 'sendFeedback'])->name('userFeedback');

});


//Developer Routes
Route::middleware(['auth', 'checkAccountLevel:developer'])->group(function () {
    Route::get('/user/developer', [devController::class, 'devAccess'])->name('developer.feedback');

});