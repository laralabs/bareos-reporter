<?php
/**
 * Bareos Reporter
 * Application for managing Bareos Backup Email Reports
 *
 * Add Contact
 *
 * @license The MIT License (MIT) See: LICENSE file
 * @copyright Copyright (c) 2016 Matt Clinton
 * @author Matt Clinton <matt@laralabs.uk>
 * @website http://www.laralabs.uk/
 */
?>
@extends('layouts.app')

@section('head-title')
    Add Contact / Bareos Reporter
@endsection

@section('content-header')
    <h1>Add Contact</h1>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-body">
                    <form class="form-add-contact" method="POST" action="/contacts/create">
                        {!! csrf_field() !!}
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6">
                            <div class="form-group{{ $errors->has('contact_name') ? ' has-error' : '' }}">
                                <label for="contact_name">Name:</label>
                                <input type="text" class="form-control" name="contact_name" value="{{ old('contact_name') }}"/>
                                @if ($errors->has('contact_name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('contact_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <label for="email">Email Address:</label>
                                <input type="text" class="form-control" name="email" value="{{ old('email') }}" />
                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group{{ $errors->has('contact_mobile') ? ' has-error' : '' }}">
                                <label for="contact_mobile">Mobile Number:</label>
                                <input type="text" class="form-control" name="contact_mobile" value="{{ old('contact_mobile') }}" />
                                @if ($errors->has('contact_mobile'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('contact_mobile') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group" style="margin-top: 30px;">
                                <button type="submit" class="btn btn-flat btn-primary"><strong>Save</strong></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
