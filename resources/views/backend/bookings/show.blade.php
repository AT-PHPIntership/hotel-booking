@extends('backend.layouts.main')
@section('title', __('Booking Room Detail'))
@section('content')
  <div class="container bootstrap snippet">
    <div class="panel-body inf-content">
      <div class="row">
        <div class="col-md-6 h4">
            <h2>{{ __('Food Information') }}</h2>
            <div class="table-responsive">
                <table class="table table-condensed table-responsive table-user-information">
                    <colgroup>
                        <col class="col-md-2">
                        <col class="col-md-6">
                    </colgroup>
                    <tbody>
                    <tr>
                        <td>
                            <strong>
                                <span class="glyphicon glyphicon-asterisk text-primary"></span>
                                {{ __('Identificacion') }}
                            </strong>
                        </td>
                        <td class="text-primary">
                          SSSSSS
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <strong>
                                <span class="glyphicon glyphicon-cutlery  text-primary"></span>
                                {{ __('Name') }}
                            </strong>
                        </td>
                        <td class="text-primary">
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <strong>
                                <span class="glyphicon glyphicon-bookmark text-primary"></span>
                            A
                            </strong>
                        </td>
                        <td class="text-primary">
                            B
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <strong>
                                <span class="glyphicon glyphicon-usd text-primary"></span>
                            C
                        </td>
                        <td class="text-primary">
                            D
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <strong>
                                <span class="glyphicon glyphicon-tasks text-primary"></span>
                                {{ __('Description') }}
                            </strong>
                        </td>
                        <td class="text-primary">
                            E
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <strong>
                                <span class="text-primary"></span>
                                {{ __('Action') }}
                            </strong>
                        </td>
                        <td>
                            <a href=""><span
                                        class="btn btn-primary">{{ __('Edit') }}</span></a>
                            <a href=""><span
                                        class="btn btn-danger">{{ __('Back') }}</span></a>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
      </div>
    </div>
  </div>
@endsection