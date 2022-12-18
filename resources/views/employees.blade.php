@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-12">
      <div class="card">
        <div class="card-header bg-info text-white font-weight-bold" style="font-size: 17px">{{ __('translate.employees') }}</div>

        <div class="card-body">
          @if ($employees->first())
            <table class="table table-striped table-hover">
              <thead>
                <tr>
                  <th>{{ __('translate.emp_name') }}</th>
                  <th>{{ __('translate.emp_address') }}</th>
                  <th>{{ __('translate.emp_mobile') }}</th>
                  <th>{{ __('translate.emp_internal_phone') }}</th>
                </tr>
              </thead>
              <tbody>
                  @foreach ($employees as $employee)
                  <tr>
                    <td>{{ $employee->name }}</td>
                    <td>{{ $employee->address }}</td>
                    <td>{{ $employee->phone }}</td>
                    <td>{{ $employee->internal_phone }}</td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
              @else
                <tr><td>{{ __('translate.no_employees') }}</td></tr>
              @endif
        </div>
      </div>

      <div class="card mt-4 ">
        <div class="card-header bg-secondary text-white font-weight-bold" style="font-size: 17px">{{ __('translate.other_options') }}</div>
    
        <div class="card-body">
          <div class="row text-center">
            <div class="col-lg-4">
              <a class="btn btn-primary btn-block mb-1 mb-lg-0">{{ __('translate.back') }}</a>
            </div>
          </div>
        </div>
      </div>
        
    </div>
  </div>
</div>
@endsection