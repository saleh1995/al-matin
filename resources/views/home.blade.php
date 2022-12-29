@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
          @if (isset($vacationRequests) && !$vacationRequests->isEmpty())
            <div class="card mb-4">
              <div class="card-header bg-warning font-weight-bold" style="font-size: 17px">{{ __('translate.vacation_requests') }}</div>

              <div class="card-body">
                <div class="">
                  <table class="table table-hover text-center">
                    <thead>
                      <tr>
                        <th scope="col">{{ __('translate.emp_id') }}</th>
                        <th scope="col">{{ __('translate.emp_name') }}</th>
                        <th scope="col">{{ __('translate.start_date') }}</th>
                        <th scope="col">{{ __('translate.end_date') }}</th>
                        <th scope="col">{{ __('translate.reasons') }}</th>
                        <th scope="col">{{ __('translate.emp_options') }}</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($vacationRequests as $vacationRequest)
                        <tr>
                          <td>{{ $vacationRequest->job_id }}</td>
                          <td>the Bird</td>
                          <td>{{ $vacationRequest->start_date }}</td>
                          <td>{{ $vacationRequest->end_date }}</td>
                          <td>{{ $vacationRequest->reasons }}</td>
                          <td class="row">
                            <a href="{{ route('vacations.accept', $vacationRequest->id) }}" class="btn btn-success col-md-5 offset-md-1 p-1 mb-md-0 mb-1">
                              <i class="fas fa-check"></i>
                            </a>
                            <a href="{{ route('vacations.deny', $vacationRequest->id) }}" class="btn btn-danger col-md-5 offset-md-1 p-1">
                              <i class="fas fa-times"></i>
                            </a>
                          </td>
                        </tr>
                      @endforeach
                      {{-- <tr>
                        <td>4820</td>
                        <td>صالح عماد الدين الحايك</td>
                        <td>25-12-2022</td>
                        <td>25-12-2022</td>
                        <td>Lorem ipsum dolor!</td>
                        <td class="row">
                          <a href="" class="btn btn-success col-md-5 offset-md-1 mb-md-0 mb-1">
                            <i class="fas fa-check"></i>
                          </a>
                          <a href="" class="btn btn-danger col-md-5 offset-md-1">
                            <i class="fas fa-times"></i>
                          </a>
                        </td>
                      </tr> --}}
                    </tbody>
                  </table>
                </div>

                <div class="col-lg-3">
                  <a class="btn btn-primary btn-block mb-1 mb-lg-0" href="{{ route('vacations') }}">{{ __('translate.vacation_requests') }}</a>
                </div>
              </div>
            </div>
          @endif
          
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
                  <div class="col-lg-3">
                    <a class="btn btn-primary btn-block mb-1 mb-lg-0" href="{{ route('salary') }}">{{ __('translate.salary') }}</a>
                  </div>
                  <div class="col-lg-3">
                    <a class="btn btn-primary btn-block mb-1 mb-lg-0" href="{{ route('evaluation') }}">{{ __('translate.evaluation') }}</a>
                  </div>
                  <div class="col-lg-3">
                    <a class="btn btn-primary btn-block mb-1 mb-lg-0" href="{{ route('vacation') }}">{{ __('translate.vacation') }}</a>
                  </div>
                  @if (Auth::user()->role >= 10 && Auth::user()->role != 20)
                    <div class="col-lg-3">
                      <a class="btn btn-primary btn-block mb-1 mb-lg-0" href="{{ route('user.departmentEmployees') }}">{{ __('translate.employees') }}</a>
                    </div>
                  @endif
                </div>
              </div>
          </div>
        </div>
    </div>
</div>
@endsection
