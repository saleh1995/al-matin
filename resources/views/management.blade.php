@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <form action="{{ route('user.showEmployee') }}" method="post" class="col-12">
      @csrf
      <div class="input-group-block row">
        <div class="form-outline col-11 px-0">
          <input type="text" name="job_id" class="form-control rounded-0 @error('job_id') is-invalid @enderror" placeholder="الرقم الوظيفي" value="{{ $employee->job_id ?? '' }}"/>
        </div>
        <button class="btn btn-primary col-1 px-0 rounded-0" type="submit">
          <i class="fas fa-search"></i>
        </button>
      </div>
      {{-- @error('job_id')
        <div class="input-group">
          <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
          </span>
        </div>
      @enderror --}}
    </form>
    @if ( Session::has('errors'))
      <div class="alert alert-danger col-12 mt-3 text-center">
        @if (session('errors')->first('job_id') != null)
        {{ session('errors')->first('job_id') }}
        @elseif (session('errors')->first('password') != null)
        {{ session('errors')->first('password')}}
        @elseif ( session('errors')->first('password_confirmation') != null)
        {{ session('errors')->first('password_confirmation') }}
        @endif
      </div>
    @elseif (Session::has('success'))
      <div class="alert alert-success col-12 mt-3 text-center">
        {{ session('success') }}
      </div>
    @endif
  </div>
  <div class="row justify-content-center mt-4">
  @if (!isset($employee))
    <div class="jumbotron jumbotron-fluid col-12">
      <div class="container">
        <p class="lead text-center">{{ __('translate.find_employee') }}</p>
      </div>
    </div>
  @else
    <table class="table col-12 text-center">
      <thead class="thead-dark">
        <tr>
          <th>{{ __('translate.emp_id') }}</th>
          <th>{{ __('translate.emp_name') }}</th>
          <th>{{ __('translate.emp_options') }}</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>{{ $employee->job_id }}</td>
          <td>{{ $employee->name }}</td>
          <td style="width: 30%">
            <div class="row">
              <div class="col-md-6 py-1 py-md-0 px-1">
                <a class="btn btn-primary btn-block" href="{{ route('user.edit', $employee->job_id) }}">{{ __('translate.edit') }}</a>
              </div>
              <div class="col-md-6 py-1 py-md-0 px-1">
                <a class="btn btn-danger btn-block" href="{{ route('user.delete', $employee->job_id) }}">{{ __('translate.delete') }}</a>
              </div>
            </div>
          </td>
        </tr>
      </tbody>
    </table>
    @if (isset($employeeEdit))
    <div class="col-12 px-0 mt-4">
      <ul class="nav nav-tabs nav-fill bg-white">
        <li class="nav-item">
          <a class="nav-link active" href="#employee-information" data-toggle="tab">{{ __('translate.employee_info') }}</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#change-password" data-toggle="tab">{{ __('translate.change_password') }}</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#missing-papers" data-toggle="tab">{{ __('translate.missing_papers') }}</a>
        </li>
        {{-- <li class="nav-item">
          <a class="nav-link disabled">Disabled</a>
        </li> --}}
      </ul>
      
      <div class="tab-content">
        <div role="tabpanel" class="tab-pane active in" id="employee-information"> 
          <div class="card">
            <div class="card-body">
              <form method="POST" action="{{ route('user.update') }}">
                @csrf
                <div class="form-row">
                  <div class="form-group col-md-6">
                    <label for="job_id">{{ __('translate.emp_id') }}</label>
                    <input type="text" class="form-control" id="job_id" name="job_id" readonly value="{{ $employeeEdit->job_id }}">
                  </div>
                  <div class="form-group col-md-6">
                    <label for="emp_name">{{ __('translate.emp_name') }}</label>
                    <input type="text" class="form-control" id="emp_name" name="name" value="{{ $employeeEdit->name }}">
                  </div>
                </div>
                <div class="form-row">
                  <div class="form-group col-md-4">
                    <label for="emp_address">{{ __('translate.emp_address') }}</label>
                    <input type="text" class="form-control" id="emp_address" name="address" value="{{ $employeeEdit->address }}">
                  </div>
                  
                  <div class="form-group col-md-4">
                    <label for="emp_place_of_job">{{ __('translate.emp_place_of_job') }}</label>
                    <input type="text" class="form-control" id="emp_place_of_job" name="place_of_job" value="{{ $employeeEdit->place_of_job }}">
                  </div>
                  <div class="form-group col-md-4">
                    <label for="emp_mobile">{{ __('translate.emp_mobile') }}</label>
                    <input type="text" class="form-control" id="emp_mobile" name="phone" value="{{ $employeeEdit->phone }}">
                  </div>
                  <div class="form-group col-md-4">
                    <label for="emp_manager_id">{{ __('translate.emp_manager_id') }}</label>
                    <input type="text" class="form-control" id="emp_manager_id" name="manager_id" value="{{ $employeeEdit->manager_id }}">
                  </div>
                  <div class="form-group col-md-4">
                    <label for="emp_internal_phone">{{ __('translate.emp_internal_phone') }}</label>
                    <input type="text" class="form-control" id="emp_internal_phone" name="internal_phone" value="{{ $employeeEdit->internal_phone }}">
                  </div>
                  <div class="form-group col-md-4">
                    <label for="emp_role">{{ __('translate.emp_role') }}</label>
                    <select id="emp_role" name="role" class="form-control">
                      @foreach ($roles as $role)
                        <option {{ $role->role == $employeeEdit->role ? 'selected' : '' }} value="{{ $role->role }}" class="h5">{{ $role->name }}</option>
                      @endforeach
                    </select>
                  </div>
                </div>
                {{-- <div class="form-group">
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="gridCheck">
                    <label class="form-check-label" for="gridCheck">
                      Check me out
                    </label>
                  </div>
                </div> --}}
                <button type="submit" class="btn btn-primary">{{ __('translate.save') }}</button>
              </form>
            </div>
          </div>
        </div>
        <div role="tabpanel" class="tab-pane fade" id="change-password"> 
          <div class="card">
            <div class="card-body">
              <form method="POST" action="{{ route('user.changePassword') }}">
                @csrf
                <div class="form-row">
                  <div class="form-group col-12">
                    <label for="job_id">{{ __('translate.emp_id') }}</label>
                    <input type="text" class="form-control" id="job_id" name="job_id" readonly value="{{ $employeeEdit->job_id }}">
                  </div>
                  <div class="form-group col-12">
                    <label for="password">{{ __('translate.new_password') }}</label>
                    <input type="text" class="form-control" id="password" name="password">
                  </div>
                  <div class="form-group col-12">
                    <label for="password_confirmation">{{ __('translate.password_confirmation') }}</label>
                    <input type="text" class="form-control" id="password_confirmation" name="password_confirmation">
                  </div>
                </div>
                <button type="submit" class="btn btn-primary">{{ __('translate.save') }}</button>
              </form>
            </div>
          </div>
        </div>
        <div role="tabpanel" class="tab-pane fade" id="missing-papers"> 
          @php
            $papers = [__('translate.not_received'), __('translate.received')];
          @endphp
          <div class="card">
            <div class="card-body">
              <form method="POST" action="{{ route('followup.update') }}">
                @csrf
                <div class="form-row">
                  <div class="form-group col-12">
                    <label for="job_id">{{ __('translate.emp_id') }}</label>
                    <input type="text" class="form-control" id="job_id" name="job_id" readonly value="{{ $employeeEdit->job_id }}">
                  </div>
                  <div class="form-group col-lg-3 col-md-4">
                    <label for="papers_id_photo">{{ __('translate.papers_id_photo') }}</label>
                    <select id="papers_id_photo" name="id_photo" class="form-control">
                      @foreach ($papers as $index => $paper)
                        <option {{ (isset($followUp) ? $index == $followUp->id_photo : false) ? 'selected' : '' }} value="{{ $index }}" class="h5">{{ $paper }}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="form-group col-lg-3 col-md-4">
                    <label for="papers_residence_document">{{ __('translate.papers_residence_document') }}</label>
                    <select id="papers_residence_document" name="residence_document" class="form-control">
                      @foreach ($papers as $index => $paper)
                        <option {{ (isset($followUp) ? $index == $followUp->residence_document : false) ? 'selected' : '' }} value="{{ $index }}" class="h5">{{ $paper }}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="form-group col-lg-3 col-md-4">
                    <label for="papers_no_conviction">{{ __('translate.papers_no_conviction') }}</label>
                    <select id="papers_no_conviction" name="no_conviction" class="form-control">
                      @foreach ($papers as $index => $paper)
                        <option {{ (isset($followUp) ? $index == $followUp->no_conviction : false) ? 'selected' : '' }} value="{{ $index }}" class="h5">{{ $paper }}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="form-group col-lg-3 col-md-4">
                    <label for="papers_individual_civil_record">{{ __('translate.papers_individual_civil_record') }}</label>
                    <select id="papers_individual_civil_record" name="individual_civil_record" class="form-control">
                      @foreach ($papers as $index => $paper)
                        <option {{ (isset($followUp) ? $index == $followUp->individual_civil_record : false) ? 'selected' : '' }} value="{{ $index }}" class="h5">{{ $paper }}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="form-group col-lg-3 col-md-4">
                    <label for="papers_personal_photos">{{ __('translate.papers_personal_photos') }}</label>
                    <select id="papers_personal_photos" name="personal_photos" class="form-control">
                      @foreach ($papers as $index => $paper)
                        <option {{ (isset($followUp) ? $index == $followUp->personal_photos : false) ? 'selected' : '' }} value="{{ $index }}" class="h5">{{ $paper }}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="form-group col-lg-3 col-md-4">
                    <label for="papers_certificate_copy">{{ __('translate.papers_certificate_copy') }}</label>
                    <select id="papers_certificate_copy" name="certificate_copy" class="form-control">
                      @foreach ($papers as $index => $paper)
                        <option {{ (isset($followUp) ? $index == $followUp->certificate_copy : false) ? 'selected' : '' }} value="{{ $index }}" class="h5">{{ $paper }}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="form-group col-lg-3 col-md-4">
                    <label for="papers_medical_report">{{ __('translate.papers_medical_report') }}</label>
                    <select id="papers_medical_report" name="medical_report" class="form-control">
                      @foreach ($papers as $index => $paper)
                        <option {{ (isset($followUp) ? $index == $followUp->medical_report : false) ? 'selected' : '' }} value="{{ $index }}" class="h5">{{ $paper }}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="form-group col-lg-3 col-md-4">
                    <label for="papers_military_notebook">{{ __('translate.papers_military_notebook') }}</label>
                    <select id="papers_military_notebook" name="military_notebook" class="form-control">
                      @foreach ($papers as $index => $paper)
                        <option {{ (isset($followUp) ? $index == $followUp->military_notebook : false) ? 'selected' : '' }} value="{{ $index }}" class="h5">{{ $paper }}</option>
                      @endforeach
                    </select>
                  </div>
                </div>
                <button type="submit" class="btn btn-primary">{{ __('translate.save') }}</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
    @endif
  @endif
  </div>

  
</div>
@endsection