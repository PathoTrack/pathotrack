@extends('app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <?php if ($message == 'success') { ?>
                <h1 class="info-msg"><span class="fa fa-check-circle"></span>Your account is verified.</h1>
            <?php } elseif ($message == 'invalid') { ?>
                <h1 class="info-msg"><span class="fa fa-times-circle-o"></span>Invalid verification code.</h1>
            <?php } elseif ($message == 'expired') { ?>
                <h1 class="info-msg"><span class="fa fa-times-circle-o"></span>Verification code expired.</h1>
            <?php } ?>
        </div>
    </div>
</div>
@endsection