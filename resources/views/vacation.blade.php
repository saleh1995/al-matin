@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-10">
      @if (session('errors') != null && Session::has('errors'))
        <div class="alert alert-danger col-12 mt-3 text-center">
          @if (session('errors')->first('job_id') != null)
          {{ session('errors')->first('job_id') }}
          @elseif (session('errors')->first('start_date') != null)
          {{ session('errors')->first('start_date')}}
          @elseif ( session('errors')->first('end_date') != null)
          {{ session('errors')->first('end_date') }}
          @elseif ( session('errors')->first('vacation') != null)
          {{ session('errors')->first('vacation') }}
          @endif
        </div>
      @endif
      @if (isset($vacation))
        @if ($vacation->request_status == 1)
          <div class="alert alert-warning col-12 text-center">
            {{ __('translate.vacation_message_manager') }} 
            <a href="{{ route('vacation.deleteRequest', $vacation->id) }}" class="btn btn-outline-warning text-dark bg-light">{{ __('translate.cancel_vacation') }}</a>
          </div>
        @elseif ($vacation->request_status == 2)
          <div class="alert alert-warning col-12 text-center">
            {{ __('translate.vacation_message_HR') }}
            <a href="{{ route('vacation.deleteRequest', $vacation->id) }}" class="btn btn-outline-warning text-dark bg-light">{{ __('translate.cancel_vacation') }}</a>
          </div>
        @elseif ($vacation->request_status == 3)
          <div class="alert alert-success col-12 text-center">
            {{ __('translate.vacation_accepted') }}
          </div>
        @endif
      @else
        <div class="card">
          <div class="card-header bg-secondary text-white font-weight-bold text-center" style="font-size: 17px">{{ __('translate.vacation') }}</div>

          <div class="card-body">
            <form method="POST" action="{{ route('vacation.makeRequest') }}">
              @csrf

              <div class="form-group row">
                <label for="job_id" class="col-12 col-form-label {{ app()->getlocale() == 'ar' ? 'text-right' : 'text-left' }}">{{ __('translate.job_id') }}</label>

                <div class="col-12">
                  <input type="text" name="job_id" id="job_id" class="form-control" value="{{ $employee->job_id }}" readonly>
                </div>
              </div>

              <div class="form-group row">
                <label for="emp_manager" class="col-12 col-form-label {{ app()->getlocale() == 'ar' ? 'text-right' : 'text-left' }}">{{ __('translate.emp_manager') }}</label>

                <div class="col-12">
                  <input type="text" name="head_id" id="emp_manager" class="form-control" value="{{ $employee->manager->first()->name ?? '' }}" disabled>
                </div>
              </div>
              
              <div class="form-group row">
                <div class="col-6">
                  <div class="row">
                    <label for="start_date" class="col-12 col-form-label {{ app()->getlocale() == 'ar' ? 'text-right' : 'text-left' }}">{{ __('translate.start_date') }}</label>
      
                    <div class="col-12">
                      <input type="date" name="start_date" id="" class="form-control" value="{{ Carbon\Carbon::now()->format('Y-m-d') }}">
                    </div>
                  </div>
                </div>

                <div class="col-6">
                  <div class="row">
                    <label for="end_date" class="col-12 col-form-label {{ app()->getlocale() == 'ar' ? 'text-right' : 'text-left' }}">{{ __('translate.end_date') }}</label>
      
                    <div class="col-12">
                      <input type="date" name="end_date" id="" class="form-control" value="{{ Carbon\Carbon::now()->format('Y-m-d') }}">
                    </div>
                  </div>
                </div>
                <input type="hidden" name="today" value="{{ Carbon\Carbon::now()->format('Y-m-d') }}">
              </div>

              <div class="form-group row">
                <label for="reasons" class="col-12 col-form-label {{ app()->getlocale() == 'ar' ? 'text-right' : 'text-left' }}">{{ __('translate.reasons') }}</label>

                <div class="col-12">
                  <textarea name="reasons" id="reasons" cols="30" rows="4" class="form-control"></textarea>
                </div>
              </div>

              <div class="form-group row">
                <div class="col-6">
                  <a class="btn btn-primary btn-block text-cneter" href="{{ url('/') }}">{{ __('translate.back') }}</a>
                </div>
                <div class="col-6">
                  <button type="submit" class="btn btn-danger btn-block text-cneter">{{ __('translate.send') }}</button>
                </div>
              </div>
              
            </form>
          </div>
        </div>
      @endif
      
      
    </div>
  </div>
</div>
@endsection