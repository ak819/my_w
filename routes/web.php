<?php
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\URL;
use App\Http\Controllers\LocalizationController;
use App\Http\Controllers\DashboardController;
/// admin ////////
use App\Http\Controllers\manage\BannerController;
use App\Http\Controllers\manage\AgentController;
use App\Http\Controllers\manage\BlogController;
use App\Http\Controllers\manage\ServiceController;
use App\Http\Controllers\manage\TestimonialController;
use App\Http\Controllers\manage\PropertyController;
use App\Http\Controllers\manage\CurrencyController;
use App\Http\Controllers\manage\PropertyType;
use App\Http\Controllers\manage\PropertyImagesController;
use App\Http\Controllers\manage\ListYourPropertyController as ListYourProperty;
use App\Http\Controllers\manage\EnquiriesController;
use App\Http\Controllers\manage\CitiesController;
use App\Http\Controllers\manage\CommunitiesController;
use App\Http\Controllers\manage\ContactInfoController;
use App\Http\Controllers\manage\ChangePasswordController;
use App\Http\Controllers\manage\UsersController;
use App\Http\Controllers\manage\ImageController;
use App\Http\Controllers\manage\PropertyEvaluationController;
use App\Http\Controllers\manage\PageMediaController;
use App\Http\Controllers\manage\SeourlController;
/////// user /////////
use App\Http\Controllers\web\HomeController;
use App\Http\Controllers\web\BlogsController;
use App\Http\Controllers\web\WebBannerController;
use App\Http\Controllers\web\WebTestimonialsController;
use App\Http\Controllers\web\WebAgentsController;

use App\Http\Controllers\web\PropertyController as webPropertyController;
use App\Http\Controllers\web\CommunitiesController as webCommunitiesController;
use App\Http\Controllers\web\ServicesController as webServicesController;
use App\Http\Controllers\PropertyCrawler;
use App\Http\Controllers\SitemapXmlController;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;


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
Auth::routes([
    'register' => false, // Registration Routes...
    'reset' => false, // Password Reset Routes...
    'verify' => false, // Email Verification Routes...
  ]);

Route::get('/database-backup', [DashboardController::class, 'backupDatabase'])->name('data-backup')->middleware('auth');
Route::resource('manage/banner', BannerController::class)->middleware(['auth']);
Route::resource('manage/agent', AgentController::class)->middleware('auth');
Route::resource('manage/blog', BlogController::class)->middleware('auth');
Route::resource('manage/service', ServiceController::class)->middleware('auth');
Route::resource('manage/testimonial', TestimonialController::class)->middleware('auth');
Route::resource('manage/property', PropertyController::class)->middleware('auth');
Route::resource('manage/currency',CurrencyController::class)->middleware('auth');
Route::resource('manage/propertytype',PropertyType::class)->middleware('auth');
Route::resource('manage/listyourproperty', ListYourProperty::class)->middleware('auth');
Route::get('manage/followup-listyourproperty/{IFollowup}/{guid}', [ListYourProperty::class, 'updatePropertyDetail'])->name('editpropertydetail')->middleware('auth');
Route::post('manage/note-listyourproperty', [ListYourProperty::class, 'updatePropertyListNote'])->name('editpropertynote')->middleware('auth');
Route::resource('manage/enquiries', EnquiriesController::class)->middleware('auth');
Route::get('manage/contact-enquires', [EnquiriesController::class, 'contactenquiries'])->name('contact-enquiries')->middleware('auth');
Route::post('manage/note-enquiries', [EnquiriesController::class, 'updatePropertyEnquiryNote'])->name('editenquireynote')->middleware('auth');
Route::resource('manage/cities', CitiesController::class)->middleware('auth');
Route::resource('manage/communities', CommunitiesController::class)->middleware('auth');
Route::resource('manage/contactinfo', ContactInfoController::class)->middleware('auth');
Route::get('manage/password',[ChangePasswordController::class,'index'])->name('changepassword')->middleware('auth');
Route::post('change-password',[ChangePasswordController::class,'store'])->name('change.password')->middleware('auth');
Route::resource('manage/users', UsersController::class)->middleware('auth');
Route::get('change-userpassword/{guid}',[UsersController::class,'changeUserPassword'])->name('change.user.password')->middleware('auth');
Route::post('set-userpassword',[UsersController::class,'updateUserPassword'])->name('set.user.password')->middleware('auth');
Route::get('/property-updates', [PropertyController::class, 'propertyUpdateList'])->name('show-property-updates')->middleware('auth');
Route::post('/property-update-list', [PropertyController::class, 'getPropertyUpdateList'])->name('property-update-list')->middleware('auth');
Route::post('/submit-property-update', [PropertyController::class, 'storePropertyUpdate'])->name('submit-property-update')->middleware('auth');
Route::get('/signature-reports', [PropertyController::class, 'propertyUpdateLogsList'])->name('property-updates-reports')->middleware('auth');
Route::post('/import-excel-customfields', [PropertyController::class, 'importExcelCustomFields'])->name('import-excel-customfields')->middleware('auth');
Route::get('/import-customfields', [PropertyController::class, 'importCustomFields'])->name('import-customfields')->middleware('auth');
Route::get('property/reset-status', [PropertyController::class,'resetStatus'])->name('property.reset.status')->middleware('auth');
Route::resource('web/webbanner', WebBannerController::class)->middleware('auth');
Route::resource('web/webtestimonial', WebTestimonialsController::class)->middleware('auth');
Route::resource('web/webagent', WebAgentsController::class)->middleware('auth');
Route::post('/addlistproperty', [webPropertyController::class, 'storeListProperty'])->name('addnewproperty');
Route::get('/services', [webServicesController::class, 'index'])->name('services');
Route::post('services/requestInfo', [webServicesController::class, 'createEnquiry'])->name('service-rquestInfo');
Route::post('contactinfo', [HomeController::class, 'createContactEnquiry'])->name('contact-info');
Route::resource('manage/propertyImages', PropertyImagesController::class)->middleware('auth');
Route::post('/propertylist', [PropertyController::class, 'getPropertyList'])->name('propertylist')->middleware('auth');
Route::get('manage/hero-banner',[ImageController::class,'listHeroBanners'])->name('hero-banners-list')->middleware('auth');
Route::get('manage/hero-banner/{guid}/edit',[ImageController::class,'editHeroBanner'])->name('hero-banner.edit')->middleware('auth');
Route::put('manage/hero-banner/{guid}/update',[ImageController::class,'updateHeroBanner'])->name('hero-banner.update')->middleware('auth');
Route::get('manage/aboutus-image',[ImageController::class,'listAboutImages'])->name('about-images-list')->middleware('auth');
Route::get('manage/aboutus-image/{guid}/edit',[ImageController::class,'editAboutImage'])->name('about-image.edit')->middleware('auth');
Route::put('manage/aboutus-image/{guid}/update',[ImageController::class,'updateAboutImage'])->name('about-image.update')->middleware('auth');
Route::get('manage/service-enquires', [EnquiriesController::class, 'service_enquiries'])->name('service-enquiries')->middleware('auth');
Route::post('manage/contact-enquiry/update',[EnquiriesController::class,'updateContactEqNote'])->name('contact-enquiry.update')->middleware('auth');
Route::put('manage/contact-enquiry/{guid}/update',[EnquiriesController::class,'updateContactEqFollowup'])->name('contact-enquiry.followup')->middleware('auth');
Route::get('manage/contact-enquiry/destroy/{guid}',[EnquiriesController::class,'destroyContactEq'])->name('contact-enquiry.destroy')->middleware('auth');
Route::get('manage/enquiries/destroy/{guid}', [EnquiriesController::class, 'destroy'])->name('distroyenquiries')->middleware('auth');
Route::post('manage/service-enquiry/update',[EnquiriesController::class,'updateServiceEqNote'])->name('service-enquiry.update')->middleware('auth');
Route::put('manage/service-enquiry/{guid}/update',[EnquiriesController::class,'uupdateServiceEqFollowup'])->name('service-enquiry.followup')->middleware('auth');
Route::get('manage/service-enquiry/destroy/{guid}',[EnquiriesController::class,'destroyServiceEq'])->name('service-enquiry.destroy')->middleware('auth');
Route::resource('manage/evaluation', PropertyEvaluationController::class)->middleware('auth');
Route::get('manage/evaluation-enquires', [EnquiriesController::class, 'evaluation_enquiries'])->name('evaluation-enquiries')->middleware('auth');
Route::post('manage/evaluation-enquiry/update',[EnquiriesController::class,'updateEvaluationEqNote'])->name('evaluation-enquiry.update')->middleware('auth');
Route::put('manage/evaluation-enquiry/{guid}/update',[EnquiriesController::class,'updateEvaluationFollowup'])->name('evaluation-enquiry.followup')->middleware('auth');
Route::get('manage/evaluation-enquiry/destroy/{guid}',[EnquiriesController::class,'destroyEvaluationEq'])->name('evaluation-enquiry.destroy')->middleware('auth');
Route::resource('manage/media', PageMediaController::class)->middleware('auth');
Route::resource('manage/seourl', SeourlController::class)->middleware(['auth']);
//////////////////////////////// web//////////////////////////////////////////////////

// Route::group(['prefix' => '{lang?}','prefix' => '{adtype?}', 'middleware' =>['locale','setcurrency'], 'where' => ['lang' => "en|ar",'adtype' => "sale|rent"],], function () {
//   Route::get('/search-properties', [webPropertyController::class, 'getProperties'])->name('search-properties');
// });

    Route::group(['prefix' => '{lang?}', 'middleware' =>['locale','setcurrency'], 'where' => ['lang' => "en|ar"]], function () {
        Route::get('/', [HomeController::class, 'index'])->name('home');
        Route::get('/about-us', [HomeController::class, 'getAboutUs'])->name('about-us');
        Route::get('/contact-us', [HomeController::class, 'getContactUs'])->name('contact-us');
        // Route::get('/property/sale/{property_type}', [webPropertyController::class, 'ShowAllSale'])->name('all-sale-type');
        // Route::get('/property/rent/{property_type}', [webPropertyController::class, 'ShowAllRent'])->name('all-rent-type');
        //Route::get('/property/sale', [webPropertyController::class, 'ShowAllSale'])->name('all-sale');
        //Route::get('/property/rent', [webPropertyController::class, 'ShowAllRent'])->name('all-rent');
        Route::get('property/{addtype}/{type?}/{city?}/{locations?}', [webPropertyController::class, 'getProperties'])->where('addtype','sale|rent')->name('search-properties');
        Route::get('/blogs', [BlogsController::class, 'index'])->name('blogs');
        Route::get('/blogs/detail/{title}', [BlogsController::class, 'blogDetails'])->name('blogdetails');
        Route::get('/our-services', [webServicesController::class, 'index'])->name('our-services');
        Route::get('/services/{title}',[webServicesController::class, 'servicesDetails'])->name('servicesdetails');
        Route::get('/{adtype}/{category}/{propertytitle}/{refno}', [webPropertyController::class, 'getPropertyDetails'])->name('property-details');
        Route::get('/listproperty', [webPropertyController::class, 'listNewProperty'])->name('addproperty');
        Route::get('compare', [webPropertyController::class, 'getCompareProperty'])->name('compare');
        Route::get('/featured-properties', [webPropertyController::class, 'ShowFeatured'])->name('all-feautred-properties');
        Route::get('/exclusive-properties', [webPropertyController::class, 'ShowExclusive'])->name('all-exclusive-properties');
        Route::get('/property-evaluation', [webPropertyController::class, 'showEvaluationForm'])->name('property-evaluation');
        Route::post('/submit-property-evaluation', [webPropertyController::class, 'storeEvaluationForm'])->name('add-evaluation');
        Route::get('/{adtype}/{propertytitle}/{guid}', function () {
            
            try {
                $current_url=URL::current();
            $urlarray=explode('/',$current_url);
            $lang=$urlarray[3];
            $guid=$urlarray[6];
            $slug="";
            if($lang=='ar')
            {
             $slug=DB::table('properties as p')->where('p.Guid','=',$guid)
             ->Join('propety_agents as pa', 'pa.ID', '=', 'p.AgentID')
             ->get(['SlugAr AS Slug','AdType','pa.PluralAr AS Plural','PropertyRefNo']);
             $urlarray[4]=config('constants.AdTypeRevAr.'.$slug[0]->AdType);
            }else{
              $slug=DB::table('properties as p')->where('p.Guid','=',$guid)
             ->Join('propety_agents as pa', 'pa.ID', '=', 'p.AgentID')
             ->get(['Slug','AdType','PropertyRefNo','pa.Plural']);
             $urlarray[4]=config('constants.AdTypeRev.'.$slug[0]->AdType);
            }
            $urlarray[5]=$slug[0]->Plural;
            $urlarray[6]=urlencode($slug[0]->Slug);
            $urlarray[7]=$slug[0]->PropertyRefNo;
            $url=implode('/',$urlarray);
            return redirect($url);
            } catch (\Throwable $th) {
                //abort(404);
                return redirect()->route('home');
            }
            
        });

       
    });

  
Route::get('lang/{locale}', [LocalizationController::class, 'langChange'])->name('changelang');
Route::get('currency/{currency}', [LocalizationController::class, 'changeCurrency'])->name('change-currency');
Route::get('/admin', [DashboardController::class, 'index'])->name('admin');
Route::get('/propertyCrawler', [PropertyCrawler::class, 'index']);
Route::post('property/requestInfo', [webPropertyController::class, 'createEnquiry'])->name('rquestInfo');
Route::post('property/setcomparelist', [webPropertyController::class, 'addCompareProperty'])->name('setcomparelist');
Route::post('property/remove-compare-item', [webPropertyController::class, 'removeCompareProperty'])->name('removefromcompare');
Route::get('property/showcomparelist', [webPropertyController::class, 'showCompareProperty'])->name('showcomparelist');
Route::delete('property/removecomparelist', [webPropertyController::class, 'deleteCompareProperty'])->name('removecomparelist');
Route::get('/sitemap.xml', [SitemapXmlController::class, 'index']);
Route::post('/locationlist', [webCommunitiesController::class, 'getLocationList'])->name('locationlist');
Route::post('/muli-locationlist', [webCommunitiesController::class, 'getMultipleLocationList'])->name('muli-locationlist');
Route::get('/convert-to-json', function () {
  return  App\Models\Property::paginate(5);
});
Route::get('/short/{shortURLKey}', '\AshAllenDesign\ShortURL\Controllers\ShortURLController');
Route::post('/property-socialmedia', [webPropertyController::class, 'getProperyShareLinks'])->name('sharelink');
Route::post('/blog-socialmedia', [BlogsController::class, 'getBlogShareLinks'])->name('share-blog-link');
Route::get('backup', [HomeController::class, 'sendBackUpEmail']);

Route::get('download/{filename}', function($filename)
{
    // Check if file exists in app/storage/file folder
    $file_path = storage_path() .'/app/backup/'. $filename;
    if (file_exists($file_path))
    {
        // Send Download
        return Response::download($file_path, $filename, [
            'Content-Length: '. filesize($file_path)
        ]);
    }
    else
    {
        // Error
        exit('Requested file does not exist on our server!');
    }
})
->where('filename', '[A-Za-z0-9\-\_\.]+');

Route::get('clear_cache', function () {
    \Artisan::call('optimize');
    \Artisan::call('config:clear');
    \Artisan::call('view:clear');
    \Artisan::call('cache:clear');
    
    dd("Cache is cleared");
    
    });
    Route::get('config_cache', function () {
    
    \Artisan::call('config:cache');
    \Artisan::call('view:cache');
    \Artisan::call('route:cache');
    
    dd("Cache is configured");
    
    });
    

Route::get('/create-property-slug', [PropertyController::class, 'genrateManualSlugs'])->middleware('auth');
