@extends('layout.base')

@section('content')
<div class="user-page">
    <nav class="nav-gradian">
        <div class="left-nav-section">
            <a href="/" style="text-decoration: none">
                <h1 style="font-weight: normal; font-size: 30px">Hi, <span style="color: #3E59E8">{{$user_data->username}}</span></h1>
            </a>
        </div>
        <div class="right-nav-section">
            <a class="nav-link" href="/users">Users</a>
            <a href="/logout" class="nav-link">Logout</a>
        </div>
    </nav>
    <main class="grid">
        @foreach ($all_user_data as $user)
        <section class="col">   
            <div class="card user-card">
                <div class="profile">
                    <img src="/img/robot.svg" alt="user-profile">
                </div>
                <h1>{{ $user->username }}</h1>
                <p>{{ $user->email }}</p>
                <div class="buttons">
                    <a href="/users/{{ $user->id }}" class="primary-button button">View</a>
                    <button class="primary-button danger">Remove</button>
                </div>
            </div>
        </section>
        @endforeach
    </main>
</div>
@endsection