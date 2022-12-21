@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
      <form action="" class="col-12">
        <div class="input-group-block row">
          <div class="form-outline col-11 px-0">
            <input type="number" id="form1" class="form-control rounded-0" />
          </div>
          <button type="button" class="btn btn-primary col-1 px-0 rounded-0">
            <i class="fas fa-search"></i>
          </button>
        </div>
      </form>
  </div>
  <div class="row justify-content-center mt-2">
    <div class="jumbotron jumbotron-fluid col-12">
      <div class="container">
        <p class="lead text-center">{{ __('translate.find_employee') }}</p>
      </div>
    </div>

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
          <td>Mark</td>
          <td>Otto</td>
          <td style="width: 30%">
            <div class="row">
              <div class="col-md-6 py-1 py-md-0 px-1">
                <a class="btn btn-primary btn-block">{{ __('translate.edit') }}</a>
              </div>
              <div class="col-md-6 py-1 py-md-0 px-1">
                <a class="btn btn-danger btn-block">{{ __('translate.delete') }}</a>
              </div>
            </div>
          </td>
        </tr>
      </tbody>
    </table>

    <nav>
      <div class="nav nav-tabs" id="nav-tab" role="tablist">
        <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab"
          aria-controls="nav-home" aria-selected="true">Home</a>
        <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab"
          aria-controls="nav-profile" aria-selected="false">Profile</a>
        <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-contact" role="tab"
          aria-controls="nav-contact" aria-selected="false">Contact</a>
      </div>
    </nav>
    <div class="tab-content" id="nav-tabContent">
      <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">...</div>
      <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">...</div>
      <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">...</div>
    </div>
  </div>

  
</div>
@endsection