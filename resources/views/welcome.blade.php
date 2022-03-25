@extends('layout.base')

@section('content')
<div style="display: none" class="popups" id="popup">
    <div id="add-task-popup" style="display: none" class="popup">
        <button id="close">
            <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px" fill="white">
                <path d="M0 0h24v24H0V0z" fill="none"/>
                <path d="M18.3 5.71c-.39-.39-1.02-.39-1.41 0L12 10.59 7.11 5.7c-.39-.39-1.02-.39-1.41 0-.39.39-.39 1.02 0 1.41L10.59 12 5.7 16.89c-.39.39-.39 1.02 0 1.41.39.39 1.02.39 1.41 0L12 13.41l4.89 4.89c.39.39 1.02.39 1.41 0 .39-.39.39-1.02 0-1.41L13.41 12l4.89-4.89c.38-.38.38-1.02 0-1.4z"/>
            </svg>
        </button>
        <div class="card popup-card">
            <form method="post">
                @csrf
                <div class="input-container">
                    <input class="primary-input" name="task" type="text" placeholder="Task title" required>
                </div>
                <div class="input-container">
                    <textarea required placeholder="Enter discription" name="discription" cols="40" rows="10"></textarea>
                </div>
                <div class="button-container">
                    <button type="submit" style="width: 100px;" class="primary-button">Add</button>
                </div>
            </form>
        </div>
    </div>
    <div style="display: none" id="edit-task-popup" class="popup"></div>
</div>
<div class="home-page">
    <nav class="nav-gradian">
        <div class="left-nav-section">
            <h1 style="font-weight: normal; font-size: 30px">Hi, <span style="color: #3E59E8">Uday</span></h1>
        </div>
        <div class="right-nav-section">
            <a href="#" style="color: #1F212C;text-decoration: none">Logout</a>
        </div>
    </nav>
    <button id="add-task">
        <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px" fill="white">
            <path d="M0 0h24v24H0V0z" fill="none"/>
            <path d="M18 13h-5v5c0 .55-.45 1-1 1s-1-.45-1-1v-5H6c-.55 0-1-.45-1-1s.45-1 1-1h5V6c0-.55.45-1 1-1s1 .45 1 1v5h5c.55 0 1 .45 1 1s-.45 1-1 1z"/>
        </svg>
    </button>
    <main class="grid">
        <section class="next-task col">
            <div class="next-task-header task-header">
               <div class="header">Next Task</div>
            </div>
            <div class="next-task task">
                <div class="card task-card">
                    <button class="edit next-edit">
                        <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px" fill="#3E59E8">
                            <path d="M0 0h24v24H0V0z" fill="none"/>
                            <path d="M3 17.46v3.04c0 .28.22.5.5.5h3.04c.13 0 .26-.05.35-.15L17.81 9.94l-3.75-3.75L3.15 17.1c-.1.1-.15.22-.15.36zM20.71 7.04c.39-.39.39-1.02 0-1.41l-2.34-2.34c-.39-.39-1.02-.39-1.41 0l-1.83 1.83 3.75 3.75 1.83-1.83z"/>
                        </svg>
                    </button>
                    <h4>Testing</h4>
                    <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Dolorem eaque et asperiores eum aliquam nobis ullam, placeat consectetur reiciendis dolorum.</p>
                    <div class="task-card-bottom">
                        <div class="status-container">
                            <div class="status next-status"></div>
                            <div>Next Status</div>
                        </div>
                        <div class="timing">
                            Added on: <span class="next-time">Today</span>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="on-progress col">
            <div class="onprogress-task-header task-header">
                <div class="header">On Progress</div>
            </div>
            <div class="onprogress-task task"></div>
        </section>
        <section class="done col">
            <div class="done-task-header task-header">
                <div class="header">Done</div>
            </div>
            <div class="done-task task"></div>
        </section>
    </main>
</div>
@endsection
