<x-layouts.app>

@section('breadcrumb')
Pages
@endsection

@section('breadcrumb-active')
Account pages
@endsection

@section('page-title')
Profile Management
@endsection

<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            @include('profile.partials.update-profile-information-form')
            @include('profile.partials.update-password-form')
            @include('profile.partials.delete-user-form')
        </div>
    </div>
</div>
</x-layouts.app>