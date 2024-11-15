@extends('twill::layouts.form')
@section('contentFields')

    <x-twill::input
        name="title"
        label="Title"
        :max-length="100"
    />
@stop
