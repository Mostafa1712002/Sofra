@inject('restaurants', 'App\Models\Restaurant')
<div class="form-group">
    {!! Form::label('اسم المطعم ') !!}

{!! Form::select("restaurant_id", $restaurants::all()->pluck("name","id") , null, ["id" => "formSelect" , "class" =>  " form-control"]) !!}
    @error('restaurant_id')
    <small style="display: block !important" class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </small>
    @enderror

</div>

<div class="form-group">
    {!! Form::label('الدفعه') !!}
    {!! Form::text('paid', null, [
    'class' => 'form-control',
    'placeholder' => 'أدخل الدفعه ',
    ]) !!}
    @error('paid')
    <small style="display: block !important" class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </small>
    @enderror
</div>

<div class="form-group">
    {!! Form::label('الملاحظات') !!}
    {!! Form::textarea('notes', null, [
    'class' => 'form-control',
    'placeholder' => 'أدخل الملاحظات ',
    ]) !!}
    @error('notes')
    <small style="display: block !important" class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </small>
    @enderror
</div>

<div class="form-group">
    {!! Form::label('تاريخ الدفع') !!}
    {!! Form::date('payment_date', null, [
    'class' => 'form-control',
    ]) !!}
    @error('payment_date')
    <small style="display: block !important" class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </small>
    @enderror
</div>


<div class="form-group">
    <button class="btn btn-info mt-3 mr-2 btn-md "> {{ $word }}</button>
</div>
