@extends('layouts.merchant')

@section('title', 'Profile')
@section('header', 'Profile Saya')

@section('content')

<div class="max-w-4xl space-y-6">

    <div class="p-6 bg-white shadow rounded-xl">
        <h3 class="text-lg font-semibold mb-4">Informasi Profile</h3>

        @include('profile.partials.update-profile-information-form')
    </div>

    <div class="p-6 bg-white shadow rounded-xl">
        <h3 class="text-lg font-semibold mb-4">Ubah Password</h3>

        @include('profile.partials.update-password-form')
    </div>

    <div class="p-6 bg-white shadow rounded-xl border border-red-200">
        <h3 class="text-lg font-semibold mb-4 text-red-600">Hapus Akun</h3>

        @include('profile.partials.delete-user-form')
    </div>

</div>

@endsection