@extends('layout.base')

@section('content')
<main>
    <section id="login">
        <div class="center">
            <div class="card">
                <div class="card-header">
                    <h1 style="font-weight: normal;font-size: xx-large;color: #3e59e8">
                        Create Account
                    </h1>
                </div>
                <div class="card-content">
                    <form class="center-form" method="post">
                        @csrf
                        <div class="input-container">
                            <input required placeholder="Enter Username" name="username" type="text" class="primary-input">
                        </div>
                        <div class="input-container">
                            <input required placeholder="Enter Email" name="email" type="email" class="primary-input">
                        </div>
                        <div class="input-container">
                            <input required placeholder="Enter Password" name="password" type="password" class="primary-input">
                        </div>
                        <div class="input-container">
                            <input required placeholder="Conform Password" name="conform-password" type="password" class="primary-input">
                        </div>
                        <div class="button-container" style="width: 100%;display: flex;justify-content: center">
                            <button style="width: 80%" type="submit" class="primary-button">Create</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</main>
@endsection
