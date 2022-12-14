@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header bg-secondary text-white font-weight-bold text-center" style="font-size: 17px">{{ __('translate.vacation') }}</div>

        <div class="card-body">
          <form method="POST" action="">
            @csrf

            <div class="form-group row">
              <label for="job_id" class="col-12 col-form-label {{ app()->getlocale() == 'ar' ? 'text-right' : 'text-left' }}">{{ __('translate.job_id') }}</label>

              <div class="col-12">
                <input type="text" name="job_id" id="" class="form-control" value="" disabled>
              </div>
            </div>

            <div class="form-group row">
              <label for="emp_manager" class="col-12 col-form-label {{ app()->getlocale() == 'ar' ? 'text-right' : 'text-left' }}">{{ __('translate.emp_manager') }}</label>

              <div class="col-12">
                <input type="text" name="emp_manager" id="" class="form-control" value="" disabled>
              </div>
            </div>
            
            <div class="form-group row">
              <div class="col-6">
                <div class="row">
                  <label for="start_date" class="col-12 col-form-label {{ app()->getlocale() == 'ar' ? 'text-right' : 'text-left' }}">{{ __('translate.start_date') }}</label>
    
                  <div class="col-12">
                    <input type="date" name="start_date" id="" class="form-control" value="">
                  </div>
                </div>
              </div>

              <div class="col-6">
                <div class="row">
                  <label for="end_date" class="col-12 col-form-label {{ app()->getlocale() == 'ar' ? 'text-right' : 'text-left' }}">{{ __('translate.end_date') }}</label>
    
                  <div class="col-12">
                    <input type="date" name="end_date" id="" class="form-control" value="">
                  </div>
                </div>
              </div>
            </div>

            <div class="form-group row">
              <label for="reasons" class="col-12 col-form-label {{ app()->getlocale() == 'ar' ? 'text-right' : 'text-left' }}">{{ __('translate.reasons') }}</label>

              <div class="col-12">
                <textarea name="" id="reasons" cols="30" rows="4" class="form-control"></textarea>
              </div>
            </div>

            <div class="form-group row">
              <div class="col-6">
                <div class="btn btn-primary btn-block text-cneter">{{ __('translate.back') }}</div>
              </div>
              <div class="col-6">
                <div class="btn btn-danger btn-block text-cneter">{{ __('translate.send') }}</div>
              </div>
            </div>
            
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection