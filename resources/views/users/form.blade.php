<div class="form-group">
    {!! Form::label('اسم المستخدم ') !!}

    {!! Form::text('name', null, [
    'class' => 'form-control',
    'placeholder' => 'أدخل اسم المستخدم',
]) !!}
    @error('name')
        <small style="display: block !important" class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </small>
    @enderror

</div>


<div class="form-group">
    {!! Form::label('البريد الألكتروني ') !!}
    {!! Form::text('email', null, [
    'class' => 'form-control',
    'placeholder' => 'أدخل البريد الألكتروني',
]) !!}
    @error('email')
        <small style="display: block !important" class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </small>
    @enderror
</div>

<div class="form-group">
    {!! Form::label('كلمة المرور ') !!}
    {!! Form::password('password', [
    'class' => 'form-control',
    'placeholder' => 'أدخل كلمة المرور',
]) !!}
    @error('password')
        <small style="display: block !important" class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </small>
    @enderror
</div>
<div class="form-group">
    {!! Form::label('تأكيد كلمة المرور ') !!}
    {!! Form::password('password_confirmation', [
    'class' => 'form-control',
    'placeholder' => 'أدخل تأكيد كلمة المرور',
]) !!}

</div>
@inject('listRoles', 'App\Models\Role')
<div class="form-groups overflow-hidden">
    {!! Form::label('أختر رتبة المستخدم') !!}
    {!! Form::select('listRoles[]', $listRoles::all()->pluck('display_name', 'id'), $id, ['class' => 'form-control', 'id' => 'formSelect', 'multiple']) !!}
    @error('listRoles')
        <small style="display: block !important" class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </small>
    @enderror
</div>

<div class="form-group">
    <button class="btn btn-info mt-3 mr-2 btn-md "> {{ $word }}</button>
</div>
