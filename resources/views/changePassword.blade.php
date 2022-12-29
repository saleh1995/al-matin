@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
          <div class="card mb-4">
            <div class="card-header bg-warning font-weight-bold" style="font-size: 17px">{{ __('translate.change_password') }}</div>
            
            <div class="card-body">
              @if (isset($vacationRequests) && !$vacationRequests->isEmpty())
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
                    
                  </tbody>
                </table>
                @else
                  {{ __('translate.no_vacation_requests') }}
                @endif
              </div>
          </div>
        </div>
    </div>
</div>
@endsection
