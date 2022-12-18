@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-info text-white font-weight-bold" style="font-size: 17px">{{ __('translate.employee_info') }}</div>

                <div class="card-body">
                    {{-- @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }} --}}

                    <table class="table table-condensed table-hover">
                        <tbody>
                          <tr>
                            <th scope="row">{{ __('translate.emp_id') }} : </th>
                            <td>{{ $user->job_id }}</td>
                          </tr>
                          <tr>
                            <th scope="row">{{ __('translate.emp_name') }} : </th>
                            <td>{{ $user->name }}</td>
                          </tr>
                          <tr>
                            <th scope="row">{{ __('translate.emp_address') }} : </th>
                            <td>{{ $user->address }}</td>
                          </tr>
                          <tr>
                            <th scope="row">{{ __('translate.emp_place_of_job') }} : </th>
                            <td>{{ $user->place_of_job }}</td>
                          </tr>
                          <tr>
                            <th scope="row">{{ __('translate.emp_mobile') }} : </th>
                            <td>{{ $user->phone }}</td>
                          </tr>
                          <tr>
                            <th scope="row">{{ __('translate.emp_manager') }} : </th>
                            <td>
                              {{ $user->manager->first()->name ?? "" }}
                            </td>
                          </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card mt-4 ">
                <div class="card-header bg-secondary text-white font-weight-bold" style="font-size: 17px">{{ __('translate.other_options') }}</div>

                <div class="card-body">
                  <div class="row text-center">
                    <div class="col-lg-4">
                      <a class="btn btn-primary btn-block mb-1 mb-lg-0">{{ __('translate.salary') }}</a>
                    </div>
                    <div class="col-lg-4">
                      <a class="btn btn-primary btn-block mb-1 mb-lg-0">{{ __('translate.evaluation') }}</a>
                    </div>
                    <div class="col-lg-4">
                      <a class="btn btn-primary btn-block mb-1 mb-lg-0">{{ __('translate.vacation') }}</a>
                    </div>
                  </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
