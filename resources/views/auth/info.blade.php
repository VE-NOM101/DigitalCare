@if (Session::has('info'))
    <div class="alert alert-info text-center">
        <strong>{{ Session::get('info') }}</strong>
        <a class="btn btn-outline-primary" href="{{Session::get('form_link')}}">Register Now</a>
    </div>
@endif
