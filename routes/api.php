<?php

    use App\Http\Controllers\Api\BookingTransactionController;
    use App\Http\Controllers\Api\CityController;
    use App\Http\Controllers\Api\OfficeSpaceController;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Route;

    Route::get('/user', function (Request $request) {
        return $request->user();
    })->middleware('auth:sanctum');

    Route::middleware("api-key")->group(function () {

        Route::get("/city/{city:slug}", [CityController::class, 'show']);
        Route::apiResource("/cities", CityController::class);

        Route::get("/office/{officeSpace:slug}", [OfficeSpaceController::class, 'show']);
        Route::apiResource("/office-spaces", OfficeSpaceController::class);

        Route::post("/booking-transaction", [BookingTransactionController::class, 'store']);
        Route::post("/check-booking-transaction", [BookingTransactionController::class, 'booking_details']);
    });
