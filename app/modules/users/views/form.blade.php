{{-- Form Template generated by SmartFormGenerator --}}

{{ Form::errors($errors) }}

@if (isset($user))
{{ Form::model($user, ['route' => ['users.update', $user->id], 'method' => 'PUT']) }}
@else
{{ Form::open(['url' => 'users']) }}
@endif
    {{ Form::smartText('username', t('Username')) }}

    {{ Form::smartEmail('email', t('Email')) }}

    {{ Form::smartText('first_name', t('First Name')) }}
    {{ Form::smartText('last_name', t('Last Name')) }}
    <div class="form-group">
        <label for="country">Gender</label>
        {{ Form::select('gender', array('0' => 'Unkown', '1' => 'Female', '2' => 'Male', '3' => 'Other')); }}
    </div>
    {{ Form::smartText('country_code', t('Country')) }}
    {{ Form::smartSelectForeign('country_code', 'Country') }}
    {{ Form::smartText('birthdate', t('Birthdate')) }}
    {{ Form::smartText('occupation', t('Occupation')) }}
    {{ Form::smartText('website', t('Website')) }}

    {{ Form::smartText('skype', t('Skype')) }}
    {{ Form::smartText('steam_id', t('Steam Id')) }}

    {{ Form::smartText('cpu', t('CPU')) }}
    {{ Form::smartText('graphics', t('Graphics')) }}
    {{ Form::smartText('ram', t('RAM')) }}
    {{ Form::smartText('motherboard', t('Motherboard')) }}
    {{ Form::smartText('drives', t('Drives')) }}
    {{ Form::smartText('display', t('Display')) }}
    {{ Form::smartText('mouse', t('Mouse')) }}
    {{ Form::smartText('keyboard', t('Keyboard')) }}
    {{ Form::smartText('headset', t('Headset')) }}
    {{ Form::smartText('mousepad', t('Mousepad')) }}

    {{ Form::smartText('game', t('Game')) }}
    {{ Form::smartText('food', t('Food')) }}
    {{ Form::smartText('drink', t('Drink')) }}
    {{ Form::smartText('music', t('Music')) }}
    {{ Form::smartText('film', t('Film')) }}

    {{ Form::smartTextarea('about', t('About')) }}
   
    {{ Form::actions(['submit' => trans('app.update')]) }}
{{ Form::close() }}