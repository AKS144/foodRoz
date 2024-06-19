<style type="text/css">
    .alert
    {
         position: relative;
        padding: 0.75rem 1.25rem;
        margin-bottom: 1rem;
        border: 1px solid transparent;
        border-radius: 0.25rem;
    }
</style>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script type="text/javascript">

setTimeout(function() {
    $('.alert').fadeOut('fast');
}, 8000);

</script>

 @if(Session::has('message'))
                    <div class="row d-print-none">
                        <div class="col-12">
                            <div class="alert alert-success" role="alert">{{ Session::get('message') }}</div>
                        </div>
                    </div>
                @endif
                 @if(Session::has('error'))
                    <div class="row d-print-none">
                        <div class="col-12">
                            <div class="alert alert-danger" role="alert">{{ Session::get('error') }}</div>
                        </div>
                    </div>
                @endif
                @if ($errors->any())
                    <div class="alert alert-danger d-print-none" role="alert">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
