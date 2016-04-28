<?php
/**
 * Bareos Reporter
 * Application for managing Bareos Backup Email Reports
 *
 * Add Director
 *
 * @license The MIT License (MIT) See: LICENSE file
 * @copyright Copyright (c) 2016 Matt Clinton
 * @author Matt Clinton <matt@laralabs.uk>
 */
?>
@extends('layouts.app')

@section('head')
    <title>Add Director / Bareos Reporter</title>
@endsection

@section('content')
<div class="container content-container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                     <h3 class="panel-title">Add Director</h3>
                </div>

                <div class="panel-body">
                    <form class="form-add-director" method="POST" action="/directors/create">
                        {!! csrf_field() !!}
                        <div class="col-xs-4">
                            <div class="section-heading">
                                <h4>Bareos Director Details</h4>
                                <hr />
                            </div>
                            <div class="form-group">
                                <label for="director_name">Director Name:</label>
                                <input type="text" class="form-control" name="director_name" />
                            </div>
                            <div class="form-group">
                                <label for="director_ip">Director IP (FQDN):</label>
                                <input type="text" class="form-control" name="director_ip" />
                            </div>
                            <div class="form-group">
                                <label for="director_port">Director Port:</label>
                                <input type="text" class="form-control" name="director_port" placeholder="9101" />
                            </div>

                            <div class="section-heading" style="margin-top: 25px;">
                                <h4>Catalog Details</h4>
                                <hr />
                            </div>
                            <div class="form-group">
                                <label for="catalog_name">Catalog Name:</label>
                                <input type="text" class="form-control" name="catalog_name" />
                            </div>
                            <div class="form-group">
                                <label for="driver">Database Driver:</label>
                                <select id="driver-select" class="selectpicker form-control" name="driver">
                                    <option value="mysql">MySQL</option>
                                    <option value="pgsql">PostgreSQL</option>
                                    <option value="sqlite">SQLite</option>
                                </select>
                            </div>
                            <div id="mysql-wrap">
                                <div class="form-group">
                                    <label for="host-mysql">Host:</label>
                                    <input type="text" class="form-control" name="host-mysql" />
                                </div>
                                <div class="form-group">
                                    <label for="port-mysql">Port:</label>
                                    <input type="text" class="form-control" name="port-mysql" placeholder="3306" />
                                </div>
                                <div class="form-group">
                                    <label for="database-mysql">Database:</label>
                                    <input type="text" class="form-control" name="database-mysql" />
                                </div>
                                <div class="form-group">
                                    <label for="username-mysql">Username:</label>
                                    <input type="text" class="form-control" name="username-mysql" />
                                </div>
                                <div class="form-group">
                                    <label for="password-mysql">Password:</label>
                                    <input type="password" class="form-control" name="password-mysql" />
                                </div>
                                <div class="form-group">
                                    <label for="charset-mysql">Charset:</label>
                                    <select id="charset-select" class="selectpicker form-control" name="charset-mysql">
                                        @if(!empty($mysql_charsets))
                                            @foreach($mysql_charsets as $charset)
                                                @if($charset->CHARACTER_SET_NAME == 'utf8')
                                                    <option value="{{ $charset->CHARACTER_SET_NAME }}" selected="selected">{{ $charset->CHARACTER_SET_NAME }}</option>
                                                @else
                                                    <option value="{{ $charset->CHARACTER_SET_NAME }}">{{ $charset->CHARACTER_SET_NAME }}</option>
                                                @endif
                                            @endforeach
                                        @else
                                            <option value="-1">No Charsets Loaded</option>
                                        @endif
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="collation-mysql">Collation:</label>
                                    <select id="collation-select" class="selectpicker form-control" name="collation-mysql">
                                        @if(!empty($mysql_collations))
                                            @foreach($mysql_collations as $collation)
                                                @if($collation->COLLATION_NAME == 'utf8_general_ci')
                                                    <option value="{{ $collation->COLLATION_NAME }}" selected="selected">{{ $collation->COLLATION_NAME }}</option>
                                                @else
                                                    <option value="{{ $collation->COLLATION_NAME }}">{{ $collation->COLLATION_NAME }}</option>
                                                @endif
                                            @endforeach
                                        @else
                                            <option value="-1">No Collations Loaded</option>
                                        @endif
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="prefix-mysql">Prefix:</label>
                                    <input type="text" class="form-control" name="prefix-mysql" />
                                </div>
                                <div class="form-group">
                                    <label for="strict-mysql">SQL Strict:</label>
                                    <select id="strict-select" class="selectpicker form-control" name="strict-mysql" >
                                        <option value="false" selected="selected">No</option>
                                        <option value="true">Yes</option>
                                    </select>
                                </div>
                                <input type="hidden" class="form-control" name="engine" value="null" />
                            </div>
                            <div id="pgsql-wrap">
                                <div class="form-group">
                                    <label for="host-pgsql">Host:</label>
                                    <input type="text" class="form-control" name="host-pgsql" />
                                </div>
                                <div class="form-group">
                                    <label for="port-pgsql">Port:</label>
                                    <input type="text" class="form-control" name="port-pgsql" />
                                </div>
                                <div class="form-group">
                                    <label for="database-pgsql">Database:</label>
                                    <input type="text" class="form-control" name="database-pgsql" />
                                </div>
                                <div class="form-group">
                                    <label for="username-pgsql">Username:</label>
                                    <input type="text" class="form-control" name="username-pgsql" />
                                </div>
                                <div class="form-group">
                                    <label for="password-pgsql">Password:</label>
                                    <input type="password" class="form-control" name="password-pgsql" />
                                </div>
                                <div class="form-group">
                                    <label for="charset-pgsql">Charset:</label>
                                    <select id="charset-select" class="selectpicker form-control" name="charset-pgsql">
                                        @if(!empty($pgsql_charsets))
                                            @foreach($pgsql_charsets as $charset)
                                                @if($charset->name == 'UTF8')
                                                    <option value="{{ $charset->name }}" selected="selected">{{ $charset->name }}</option>
                                                @else
                                                    <option value="{{ $charset->name }}">{{ $charset->name }}</option>
                                                @endif
                                            @endforeach
                                        @else
                                            <option value="-1">No Charsets Loaded</option>
                                        @endif
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="prefix-pgsql">Prefix:</label>
                                    <input type="text" class="form-control" name="prefix-pgsql" />
                                </div>
                                <div class="form-group">
                                    <label for="schema-pgsql">Schema:</label>
                                    <input type="text" class="form-control" name="schema-pgsql" value="public" />
                                </div>
                            </div>
                            <div id="sqlite-wrap">
                                <div class="form-group">
                                    <label for="database-sqlite">Database Path:</label>
                                    <input type="text" class="form-control" name="database-sqlite" />
                                </div>
                                <div class="form-group">
                                    <label for="prefix-sqlite">Prefix:</label>
                                    <input type="text" class="form-control" name="prefix-sqlite" />
                                </div>
                            </div>
                            <div class="form-group" style="margin-top: 30px;">
                                <button type="submit" class="btn btn-primary btn-lg" style="margin-right: 10px;">Save</button>
                                <button type="submit" class="btn btn-info btn-lg" disabled><i class="fa fa-btn fa-sign-in"></i>Test Connection</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection