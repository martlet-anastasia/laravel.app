<h1>Welcome!</h1>

<form method="POST" action="{{ route('welcomeMail') }}">
    @csrf
    <input type="email" name="email" placeholder="Enter your email">
    <button type="submit">Send email</button>
</form>
