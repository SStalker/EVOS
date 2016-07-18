<div class="form-group">
    <label for="title">Name</label>
    {{ Form::text('name', null, ['class' => 'form-control']) }}
</div>

<div class="form-group">
    <label for="title">E-Mail</label>
    {{ Form::email('email', null, ['class' => 'form-control']) }}
</div>

@if(Request::route()->getName() == 'users.create')
    <div class="form-group">
        <label for="password">Passwort</label>
        <input type="password" class="form-control" name="password" id="password" placeholder="Passwort123 ist ein schlechtes Passwort!">
    </div>
@endif

@if(isset($user) && $user->id != Auth::user()->id)
    <div class="checkbox">
        <label>
            {{ Form::checkbox('isAdmin', null) }}
            ist Administrator?
        </label>
        <p class="help-block">
            Administratoren sind in der Lage neue Benutzer anzulegen, zu löschen sowie zu bearbeiten.
        </p>
    </div>
@endif

<div class="pull-right">
    {{ Form::submit("Speichern", ['class'=>'btn btn-primary']) }}
</div>