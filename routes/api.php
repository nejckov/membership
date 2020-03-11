<?php

use Illuminate\Http\Request;

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

/*
** USERS ROUTES
*/
Route::namespace('Api\User')->group(function() {
  Route::resource('users', 'UserController')->only(['index', 'store', 'update', 'show', 'destroy']);
  Route::resource('users.membershipYear.members', 'UserMembershipYearMemberController')->only(['index']);

  Route::post('currentUser', 'UserController@currentUser');
  Route::get('users/{id}/actions', 'UserController@actions');
});


/*
** ROLES ROUTES
*/
Route::namespace('Api\Role')->group(function() {
  Route::resource('roles', 'RoleController')->only(['index', 'show']);
  Route::resource('roles.users', 'RoleUserController')->only(['index']);
});

/*
** MEMBERS ROUTES
*/
Route::namespace('Api\Member')->group(function() {
    Route::resource('members', 'MemberController')->only(['index', 'store', 'show', 'update', 'destroy']);
    Route::resource('members.membershipyears', 'MemberMembershipYearController')->only(['index']);
    Route::resource('members.docs', 'MemberDocController')->only(['index']);
    Route::resource('members.posts', 'MemberPostController')->only(['index']);
    Route::resource('members.membershipYears.sections', 'MemberMembershipYearSectionController')->only(['index']);

    Route::get('members/{id}/actions', 'MemberController@actions');
    Route::get('membersbee', 'MemberController@getBirthday');
});


/*
** MEMBERSHIP ROUTES
*/
Route::namespace('Api\Membership')->group(function() {
    Route::resource('memberships', 'MembershipController')->only(['index', 'show', 'destroy']);
    Route::resource('memberships.sections', 'MembershipSectionController')->only(['index', 'update', 'destroy']);

    Route::get('calcAgeGroup', 'MembershipController@calcAgeGroup');
});


/*
** DOC ROUTES
*/
Route::namespace('Api\Doc')->group(function() {
    Route::resource('docs', 'DocController')->only(['index', 'store', 'show', 'update', 'destroy']);
    Route::resource('docs.members', 'DocMemberController')->only(['index', 'destroy']);
    Route::resource('docs.memberships', 'DocMembershipController')->only(['store']);
    Route::resource('docs.sections', 'DocSectionController')->only(['index']);
    Route::resource('docs.membershipYears', 'DocMembershipYearController')->only(['index']);
    Route::resource('docs.membershipyears.members', 'DocMembershipyearMemberController')->only(['destroy']);
});


/*
** MEMBERSHIP YEAR ROUTES
*/
Route::namespace('Api\MembershipYear')->group(function() {
    Route::resource('membershipYears', 'MembershipYearController')->only(['index', 'store', 'show', 'update', 'destroy']);
    Route::resource('membershipYears.members', 'MembershipYearMemberController')->only(['index', 'destroy']);
    Route::resource('membershipYears.docs', 'MembershipYearDocController')->only(['index']);
    Route::resource('membershipYears.sections', 'MembershipYearSectionController')->only(['index']);
    Route::resource('membershipYears.posts', 'MembershipYearPostController')->only(['index']);

    Route::get('membershipYears/{id}/actions', 'MembershipYearController@actions');
});


/*
** SECTION ROUTES
*/
Route::namespace('Api\Section')->group(function() {
    Route::resource('sections', 'SectionController')->only(['index', 'store', 'show', 'update', 'destroy']);
    Route::resource('sections.membershipYears.members', 'SectionMembershipYearMemberController')->only(['index']);

    Route::get('sections/{id}/actions', 'SectionController@actions');
});


/*
** POST ROUTES
*/
Route::namespace('Api\Post')->group(function() {
    Route::resource('posts', 'PostController')->only(['index', 'show', 'update']);
    Route::resource('posts.membershipYears.members', 'PostMembershipYearMemberController')->only(['index']);
});

/**
* AGE GROUP ROUTES
*/
Route::namespace('Api\AgeGroup')->group(function() {
    Route::resource('ageGroups', 'AgeGroupController')->only(['index', 'store', 'show', 'update', 'destroy']);
    Route::resource('ageGroups.membershipYears.members', 'AgeGroupMembershipYearMemberController')->only(['index']);

    Route::get('ageGroups/{id}/actions', 'AgeGroupController@actions');
});


/**
* COMPANY ROUTES
*/

Route::namespace('Api\Company')->group(function() {
    Route::resource('companies', 'CompanyController')->only(['index', 'store', 'show', 'update', 'destroy']);
    Route::resource('companies.users', 'CompanyUserController')->only(['index']);

    Route::get('companies/{id}/actions', 'CompanyController@actions');
});

/**
* FUNCTIONS ROUTES
*/

Route::namespace('Api\Fns')->group(function() {
  Route::resource('fns', 'FnsController')->only(['index', 'store', 'show', 'update', 'destroy']);

  Route::get('fns/{id}/actions', 'FnsController@actions');
});


/**
* COMMITTEE ROUTES
*/

Route::namespace('Api\Committee')->group(function() {
  Route::resource('committees', 'CommitteeController')->only(['index', 'store', 'show', 'update', 'destroy']);
});

/**
* ANALIZE ROUTES
*/

Route::namespace('Api\Analize')->group(function() {
  Route::resource('membershipyears/analyze', 'MembershipyearController')->only(['index']);
  Route::resource('membershipyears/{id}/posts/analyze', 'MembershipyearPostController')->only(['index']);
  Route::resource('membershipyears/{id}/sections/analyze', 'MembershipyearSectionController')->only(['index']);
  Route::resource('membershipyears/{id}/agegroups/analyze', 'MembershipyearAgeGroupController')->only(['index']);
});

/**
* COMPETITION ROUTES
*/

Route::namespace('Api\Competition')->group(function() {
  Route::resource('competitions', 'CompetitionController')->only(['index', 'store', 'show', 'update', 'destroy']);
  Route::resource('competitions.categories', 'CompetitionCategoryController')->only(['index']);
  Route::resource('competitions.images', 'CompetitionImageController')->only(['index']);
  Route::resource('competitions.comments', 'CompetitionCommentController')->only(['index']);

  Route::post('competitions/{id}/details', 'CompetitionController@updateDetails');
  Route::get('upcomingCompetitions', 'CompetitionController@upcomingCompetition');
  Route::get('pastCompetitions', 'CompetitionController@pastCompetition');
});

/**
* CATEGORY ROUTES
*/

Route::namespace('Api\Category')->group(function() {
  Route::resource('categories', 'CategoryController')->only(['store', 'show', 'update', 'destroy']);
  Route::resource('categories.results', 'CategoryResultController')->only(['index']);
});

/**
* RESULT ROUTES
*/

Route::namespace('Api\Result')->group(function() {
  Route::resource('results', 'ResultController')->only(['store', 'show', 'update', 'destroy']);
});

/**
* IMAGE ROUTES
*/

Route::namespace('Api\Image')->group(function() {
  Route::resource('images', 'ImageController')->only(['store', 'destroy']);

  Route::post('upload-image', 'ImageController@upload');
});

/**
* COMMENT ROUTES
*/

Route::namespace('Api\Comment')->group(function() {
  Route::resource('comments', 'CommentController')->only(['store', 'show', 'update', 'destroy']);
});
