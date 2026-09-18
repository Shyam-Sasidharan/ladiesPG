@props(['name','label','value'=>'','type'=>'text','required'=>false])
<label class="field"><span>{{ $label }} @if($required)<b>*</b>@endif</span><input type="{{ $type }}" name="{{ $name }}" value="{{ $type==='file' ? '' : old($name,$value) }}" {{ $required ? 'required':'' }} {{ $attributes }}>@error($name)<small class="field-error">{{ $message }}</small>@enderror</label>
