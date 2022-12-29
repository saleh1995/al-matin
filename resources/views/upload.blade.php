@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-xl-3 col-lg-3">
      <div class="list-group" id="list-tab" role="tablist">
        <a class="list-group-item list-group-item-action disabled text-center" data-toggle="list" href="#" role="tab">
          <strong>{{ __('translate.update_files') }}</strong>
        </a>
        <a class="list-group-item list-group-item-action active"  aria-selected="true" id="list-salary-list" data-toggle="list" href="#list-salary" role="tab" aria-controls="salary">{{ __('translate.salary_file') }}</a>
        <a class="list-group-item list-group-item-action "  aria-selected="false" id="list-evaluation-list" data-toggle="list" href="#list-evaluation" role="tab" aria-controls="evaluation">{{ __('translate.evaluation_file') }}</a>
        <a class="list-group-item list-group-item-action "  aria-selected="false" id="list-followUp-list" data-toggle="list" href="#list-followUp" role="tab" aria-controls="followUp">{{ __('translate.followUp_file') }}</a>
        <a class="list-group-item list-group-item-action "  aria-selected="false" id="list-employee-list" data-toggle="list" href="#list-employee" role="tab" aria-controls="employee">{{ __('translate.addEmployee_file') }}</a>
        <a class="list-group-item list-group-item-action "  aria-selected="false" id="list-penalty-list" data-toggle="list" href="#list-penalty" role="tab" aria-controls="penalty">{{ __('translate.penalty_file') }}</a>
        <a class="list-group-item list-group-item-action "  aria-selected="false" id="list-insurance-list" data-toggle="list" href="#list-insurance" role="tab" aria-controls="insurance">{{ __('translate.insurance_file') }}</a>
      </div>
    </div>
    <div class="col-xl-9 col-lg-9">
      @error('file')
        <div class="alert alert-danger">
            {{ $message }}
        </div>
      @enderror
      @if(session()->has('success'))
        <div class="alert alert-success">
            {{ session()->get('success') }}
        </div>
      @endif
      <div class="tab-content" id="nav-tabContent">
        <div class="tab-pane fade show active" id="list-salary" role="tabpanel" aria-labelledby="list-salary-list">
          <form method="POST" action="{{ route('salary.upload') }}" enctype="multipart/form-data">
            @csrf
            <section class="border p-4 d-flex justify-content-center mb-4">
              <div style="width: 65rem;padding-right:10px;padding-left:10px;">
                <div class="row">
                  <span class="alert alert-secondary"><strong>{{ __('translate.salary_file') }}</strong></span>
                </div>
                <div class="row">
                  <label class="form-label text-danger" for="customFile">{{ __('translate.file_size') }}</label>
                  <div class="custom-file">
                    <input type="file" class="custom-file-input" id="customFile" name="file" required accept=".xls, .xlsx">
                    <label class="custom-file-label" for="customFile">{{ __('translate.chose_file') }}</label>
                  </div>
                </div>
              </div>
            </section>
            <input type="submit" class="btn btn-primary btn-upload" value="{{ __('translate.upload_and_update') }}"/>
          </form>
        </div>
        <div class="tab-pane fade" id="list-evaluation" role="tabpanel" aria-labelledby="list-evaluation-list">
          <form method="POST" action="{{ route('evaluation.upload') }}" enctype="multipart/form-data">
            @csrf
            <section class="border p-4 d-flex justify-content-center mb-4">
              <div style="width: 65rem;padding-right:10px;padding-left:10px;">
                <div class="row">
                  <span class="alert alert-secondary"><strong>{{ __('translate.evaluation_file') }}</strong></span>
                </div>
                <div class="row">
                  <label class="form-label text-danger" for="customFile">{{ __('translate.file_size') }}</label>
                  <div class="custom-file">
                    <input type="file" class="custom-file-input" id="customFile" name="file" required accept=".xls, .xlsx">
                    <label class="custom-file-label" for="customFile">{{ __('translate.chose_file') }}</label>
                  </div>
                </div>
              </div>
            </section>
            <input type="submit" class="btn btn-primary btn-upload" value="{{ __('translate.upload_and_update') }}"/>
          </form>
        </div>
        <div class="tab-pane fade " id="list-followUp" role="tabpanel" aria-labelledby="list-followUp-list">
          <form method="POST" action="{{ route('followup.upload') }}" enctype="multipart/form-data">
            @csrf
            <section class="border p-4 d-flex justify-content-center mb-4">
              <div style="width: 65rem;padding-right:10px;padding-left:10px;">
                <div class="row">
                  <span class="alert alert-secondary"><strong>{{ __('translate.followUp_file') }}</strong></span>
                </div>
                <div class="row">
                  <label class="form-label text-danger" for="customFile">{{ __('translate.file_size') }}</label>
                  <div class="custom-file">
                    <input type="file" class="custom-file-input" id="customFile" name="file" required accept=".xls, .xlsx">
                    <label class="custom-file-label" for="customFile">{{ __('translate.chose_file') }}</label>
                  </div>
                </div>
              </div>
            </section>
            <input type="submit" class="btn btn-primary btn-upload" value="{{ __('translate.upload_and_update') }}"/>
          </form>
        </div>
        <div class="tab-pane fade " id="list-employee" role="tabpanel" aria-labelledby="list-employee-list">
          <form method="POST" action="{{ route('employees.upload') }}" enctype="multipart/form-data">
            @csrf
            <section class="border p-4 d-flex justify-content-center mb-4">
              <div style="width: 65rem;padding-right:10px;padding-left:10px;">
                <div class="row">
                  <span class="alert alert-secondary"><strong>{{ __('translate.addEmployee_file') }}</strong></span>
                </div>
                <div class="row">
                  <label class="form-label text-danger" for="customFile">{{ __('translate.file_size') }}</label>
                  <div class="custom-file">
                    <input type="file" class="custom-file-input" id="customFile" name="file" required accept=".xls, .xlsx">
                    <label class="custom-file-label" for="customFile">{{ __('translate.chose_file') }}</label>
                  </div>
                </div>
              </div>
            </section>
            <input type="submit" class="btn btn-primary btn-upload" value="{{ __('translate.upload_and_update') }}"/>
          </form>
        </div>
        <div class="tab-pane fade " id="list-penalty" role="tabpanel" aria-labelledby="list-penalty-list">
          <form method="POST" action="{{ route("penalty.upload") }}" enctype="multipart/form-data">
            @csrf
            <section class="border p-4 d-flex justify-content-center mb-4">
              <div style="width: 65rem;padding-right:10px;padding-left:10px;">
                <div class="row">
                  <span class="alert alert-secondary"><strong>{{ __('translate.penalty_file') }}</strong></span>
                </div>
                <div class="row">
                  <label class="form-label text-danger" for="customFile">{{ __('translate.file_size') }}</label>
                  <div class="custom-file">
                    <input type="file" class="custom-file-input" id="customFile" name="file" required accept=".xls, .xlsx">
                    <label class="custom-file-label" for="customFile">{{ __('translate.chose_file') }}</label>
                  </div>
                </div>
              </div>
            </section>
            <input type="submit" class="btn btn-primary btn-upload" value="{{ __('translate.upload_and_update') }}"/>
          </form>
        </div>
        <div class="tab-pane fade " id="list-insurance" role="tabpanel" aria-labelledby="list-insurance-list">
          <form method="POST" action="{{ route("insurance.upload") }}" enctype="multipart/form-data">
            @csrf
            <section class="border p-4 d-flex justify-content-center mb-4">
              <div style="width: 65rem;padding-right:10px;padding-left:10px;">
                <div class="row">
                  <span class="alert alert-secondary"><strong>{{ __('translate.insurance_file') }}</strong></span>
                </div>
                <div class="row">
                  <label class="form-label text-danger" for="customFile">{{ __('translate.file_size') }}</label>
                  <div class="custom-file">
                    <input type="file" class="custom-file-input" id="customFile" name="file" required accept=".xls, .xlsx">
                    <label class="custom-file-label" for="customFile">{{ __('translate.chose_file') }}</label>
                  </div>
                </div>
              </div>
            </section>
            <input type="submit" class="btn btn-primary btn-upload" value="{{ __('translate.upload_and_update') }}"/>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

  <script>
    // Add the following code if you want the name of the file appear on select
    $(".custom-file-input").on("change", function() {
      var fileName = $(this).val().split("\\").pop();
      $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
    });
  </script>
@endsection









