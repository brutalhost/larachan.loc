@extends('layouts.app')

@section('content')
    @if(!empty(auth()->user()->email_verified_at))
        <p>Thank you for verifying your email address. Your email has been successfully verified.</p>
        <p>You can now access all the features and functionalities of our website.</p>
    @else
        <p>To access all the features and functionalities of our website, please verify your email address.</p>
        <p>An email with a verification link has been sent to your registered email address. Please check your inbox and
            click on the verification link to complete the email verification process.</p>
        <p>If you haven't received the verification email, please check your spam folder.</p>
        <x-form action="{{ route('verification.send') }}" submit="Click here to resend the verification email"></x-form>
    @endif
@endsection
