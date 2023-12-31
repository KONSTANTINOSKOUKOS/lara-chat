<x-layout title="Live Chat">
    @php
        $user = auth()->user();
    @endphp
    @auth
        Your username is {{ $user->name }}
    @endauth
    <ol id="msgs" x-arrange="append">
        @foreach ($messages as $msg)
            <x-message :mine="$msg->user->id == $user->id" :name="$msg->user->name">{{ $msg->content }}</x-message>
        @endforeach
    </ol>
    <form action="/" method="post" x-target="msgs" x-data @@ajax:success="$el.reset()">
        @csrf
        <input required type="text" name="content">
        <button type="submit">Send</button>
    </form>
    <form action="/logout" method="post">
        @csrf
        <button type="submit" class="btn btn-warning inline">Logout</button>
    </form>
    @php
        $av = $user->avatar_url;
    @endphp
    @if ($av)
        <img src="{{ $av }}" class="rounded-full w-16">
    @else
        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" viewBox="0 0 16 16">
            <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z" />
            <path fill-rule="evenodd"
                d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z" />
        </svg>
    @endif
    <button x-data x-on:click="alert('Hello World!')">Say Hi</button>
</x-layout>
