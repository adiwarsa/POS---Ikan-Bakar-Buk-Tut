@php
if($errors->has($attributes["name"])) {
$class = "form-control is-invalid";
} else {
$class = "form-control";
}
if($attributes["placeholder"]) {
$placeholder = str()->ucfirst(str()->replace('_', ' ', $attributes['placeholder']));
} else {
$placeholder = str()->ucfirst(str()->replace('_', ' ', $attributes['name']));
}
@endphp

<textarea {{ $attributes->merge(["class" => $class]) }} placeholder="{{ $placeholder }}">{{ $value }}</textarea>