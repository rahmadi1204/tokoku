@if (App\Http\Controllers\Setting\AppController::appLogo())
    <img src="{{ asset('storage/app/images/app/' . App\Http\Controllers\Setting\AppController::appLogo()) . '?' . now() }}"
        alt="logo" width="200px">
@else
    <img src="{{ asset('storage/app/images/app/logo.png') }}" alt="logo" width="200px">
@endif
