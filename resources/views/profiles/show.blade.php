@extends('layouts.app') 

@section('content')
    <div id="container">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ $user->name }}</div>

                <div class="card-body">
                    <div class="profile-info">
                        <div class="profile-picture">
                            <div class="user-picture-container">
                                <img src="{{ asset('storage/' . $user->picture) }}" alt="User Picture" class="user-picture">
                            </div>    
                        </div>
                        <div class="user-details">
                            <div id="email-update">
                                <p>Email: 
                                    <span id="email-display">{{ $user->email }}</span>
                                    @auth
                                    @if(auth()->user()->id == $user->id)
                                    <span id="edit-email">  
                                        <i class="fas fa-pen" onclick="showEmailInput()"></i>
                                    </span>
                                    @endif
                                    @endauth
                                    
                                </p>
                                <input type="text" id="email-input" value="{{ $user->email }}" style="display: none">
                                <button id="save-email" onclick="saveEmail({{ $user->id}} )" style="display: none">Save</button>
                            </div>

                            <p>Birthdate: {{ $user->birthdate ? $user->birthdate->format('d/m/Y') : 'N/A' }}</p>
                            <p>Registration Date: {{ $user->regdate ? $user->regdate->format('d/m/Y') : 'N/A' }}</p>
                            <p>Points: {{ $user->points }}</p>

                            @auth
                            @if(auth()->user()->id == $user->id)
                                <!-- Only show password inputs if the authenticated user is the same as the user whose profile is being viewed -->
                                <button id="edit-pass" onclick="showPassInput()">Change Password</button>
                                <div id="password-inputs" style="display: none;">       
                                    <input type="password" id="old-pass" placeholder="Old Password">
                                    <input type="password" id="new-pass" placeholder="New Password">
                                    <input type="password" id="new-pass-confirm" placeholder="Confirm New Password">
                                    <button id="save-pass" onclick="savePass({{ $user->id }})">Save</button>
                                </div>
                            @endif
                            @endauth

                        </div>
                    </div>
                    <div id="inline-sections">
                        <div class='content-type'>
                            <h3>Questions</h3>
                            <ul>
                                @forelse($user->questions as $question)
                                    <li><h4>{{ $question->title }}</h4></li>
                                        <li class='description'>{{ $question->content->description }}</li>
                                @empty
                                    <li>No questions available.</li>
                                @endforelse
                            </ul>
                        </div>
                        <div class='content-type'>
                            <h3>Answers</h3>
                            <ul>
                                @forelse($user->answers as $answer)
                                    <li>{{ $answer->content->description }}</li>
                                @empty
                                    <li class='description'>No answers available.</li>
                                @endforelse
                            </ul>
                        </div>
                        <div class='content-type'>
                            <h3>Comments</h3>
                            <ul>
                                @forelse($user->comments as $comment)
                                    <li>{{ $comment->content->description }}</li>
                                @empty
                                    <li>No comments available.</li>
                                @endforelse
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('js/profile.js') }}"></script>
@endsection
