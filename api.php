<php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;


          Route::prefix('new')->group(function () {
      
              Route::post('user', 'App\Http\Controllers\Web\Authenticated\API\NewUserController@verifyAndCreateUser')->name('new-user');
          });
