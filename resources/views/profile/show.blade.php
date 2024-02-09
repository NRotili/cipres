@extends('adminlte::page')

@section('title', 'Profile')

@section('content_header')
    <h1>Perfil</h1>
@stop

@section('js')
    
@stop

@section('content')
<div class="card">
<div class="card-body">
    <div>
            @if (Laravel\Fortify\Features::canUpdateProfileInformation())
                @livewire('profile.update-profile-information-form')

                <div class="hidden sm:block">
                    <div class="py-8">
                        <div class="border-t border-gray-200"></div>
                    </div>
                </div>
            @endif

            @if (Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::updatePasswords()))
                <div class="mt-10 sm:mt-0">
                    @livewire('profile.update-password-form')
                </div>

                <div class="hidden sm:block">
                    <div class="py-8">
                        <div class="border-t border-gray-200"></div>
                    </div>
                </div>
            @endif

            @if (Laravel\Fortify\Features::canManageTwoFactorAuthentication())
                <div class="mt-10 sm:mt-0">
                    @livewire('profile.two-factor-authentication-form')
                </div>

                <div class="hidden sm:block">
                    <div class="py-8">
                        <div class="border-t border-gray-200"></div>
                    </div>
                </div>
            @endif

            <div class="mt-10 sm:mt-0">
                @livewire('profile.logout-other-browser-sessions-form')
            </div>

            @if (Laravel\Jetstream\Jetstream::hasAccountDeletionFeatures())
            <div class="hidden sm:block">
                <div class="py-8">
                    <div class="border-t border-gray-200"></div>
                </div>
            </div>

                <div class="mt-10 sm:mt-0">
                    @livewire('profile.delete-user-form')
                </div>
            @endif
    </div>
</div>
</div>
    
@endsection