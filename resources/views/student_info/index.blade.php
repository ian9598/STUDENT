@extends('layout.layout')

@section('content')
<style>
  .uper {
    margin-top: 40px;
  }
</style>
<div class="card uper">
  <div class="card-header">
    <h2>Student Table</h2>
  </div>
  <div class="card-body">
    @if ($errors->any())
      <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
        </ul>
      </div><br/>
    @endif
    <div class="row">
      <div class="col-md-12">
          @if ($message = Session::get('success'))
          <div class="alert alert-info shadow my-3" role="alert" id="success-alert">
              <strong>{{ $message }}</strong>
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
              </button>
          </div>
          @endif

          @if ($message = Session::get('error'))
          <div class="alert alert-danger shadow my-3" role="alert" id="danger-alert">
              <strong>{{ $message }}</strong>
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
              </button>
          </div>
          @endif
          <div role="alert" id="status_message"></div>
      </div>
      
  </div>

    <a align="left" class="btn btn-primary col-2" data-toggle="modal" data-target="#add" style="color:white">Add</a>
    <br><br>

    <table class="display nowrap table table-hover">
      <thead class="thead">
        <tr>
          <td>Student ID</td>
          <td>Student Name</td>
          <td>Gender</td>
          <td>IC</td>
          <td>Average</td>
          <td>Action</td>
        </tr>
      </thead>

      <tbody>
          @foreach ($student as $s)
          <tr>
              <td>{{ $s->student_id }}</td>
              <td>{{ $s->student_name }}</td>
              <td>{{ $s->gender }}</td>
              <td>{{ $s->ic }}</td>
              <td>{{ round($s->avgMark,2) }}</td>
              <td>
                  <span class="d-inline-block" tabindex="0" data-toggle="tooltip" title="Edit" id="tooltip_edit">
                      <button class="btn btn-warning btn" data-toggle="modal"           
                          data-target="#edit"
                          data-id="{{ $s->student_id }}"
                          data-name="{{ $s->student_name }}"
                          data-gender="{{ $s->gender }}"
                          data-ic="{{ $s->ic }}">
                            Edit
                        </button>
                    </span>
                    <span class="d-inline-block" tabindex="0" data-toggle="tooltip" title="Delete" id="tooltip_edit">
                      <form action="{{ route('delete-studentInfo', $s->student_id)}}" method="post">
                        @csrf
                        @method('post')
                        <button class="btn btn-danger" type="submit">Delete</button>
                      </form>
                    </span>
                    <span class="d-inline-block" tabindex="0" data-toggle="tooltip" title="Result" id="tooltip_edit">
                      <a class="btn btn-primary" href="{{ route('studResult', $s->student_id)}}">
                        Result
                      </a>
                  </span>
                </td>
            </tr>
          @endforeach
      </tbody> 
    </table>
      
  </div>
</div>


{{-- add modal --}}
<div class="modal fade" id="add" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content bg-light">
          <div class="modal-header">
              <h3 class="col-12 modal-title text-center" id="myModalLabel">Add Student Form</h3>
              <div style="margin-left: -20%">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span style="color: #6c757d" aria-hidden="true" class="fas fa-times"></span>
                  </button>
              </div>
              <!--<button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </button>-->
          </div>
          <form action="{{ route('add-studentInfo')}}" method="post">
            @csrf
            @method('post')
              <div class="modal-body">
                  <div class="container">
                      <div class="row">
                          <div class='form-group col'>
                              <label>Student ID:</label>
                              <input class="form-control" type='text' name="student_id" required>
                          </div>
                      </div>
                      <div class="row">
                          <div class='form-group col'>
                              <label>Student Name:</label>
                              <input class="form-control" type='text' name="student_name" required>
                          </div>
                      </div>
                      <div class="row">
                          <div class='form-group col'>
                            <label>Gender:</label><br>
                            <label class="radio-inline mr-2">
                              <input type="radio" name="gender" value="Male"> Male
                            </label>
                            <label class="radio-inline ml-2">
                              <input type="radio" name="gender" value="Female"> Female
                            </label>
                          </div>
                      </div>
                      <div class="row">
                        <div class='form-group col'>
                            <label>IC:</label>
                            <input class="form-control" type='text' name="ic" required>
                        </div>
                    </div>
                  </div>
              </div>
              <div class="modal-footer">
                  <button type="submit" class="btn btn-primary">Submit</button>
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
              </div>
          </form>
      </div>
  </div>
</div>

{{-- edit modal --}}
<div class="modal fade" id="edit" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content bg-light">
          <div class="modal-header">
              <h3 class="col-12 modal-title text-center" id="myModalLabel">Edit Student Form</h3>
              <div style="margin-left: -20%">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span style="color: #6c757d" aria-hidden="true" class="fas fa-times"></span>
                  </button>
              </div>
              <!--<button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </button>-->
          </div>
          <form action="{{ route('edit-studentInfo')}}" method="post">
              @csrf
              @method('post')
              <div class="modal-body">
                  <div class="container">
                      <div class="row">
                          <div class='form-group col'>
                              <label>Student ID:</label>
                              <input class="form-control" type='text' name="student_id" id="edit_id" readonly>
                          </div>
                      </div>
                      <div class="row">
                          <div class='form-group col'>
                              <label>Student Name:</label>
                              <input class="form-control" type='text' name="student_name" id="edit_name"  required>
                          </div>
                      </div>
                      <div class="row">
                          <div class='form-group col'>
                            <label>Gender:</label><br>
                            <label class="radio-inline mr-2">
                              <input type="radio" name="gender" value="Male" id="edit_male"> Male
                            </label>
                            <label class="radio-inline ml-2">
                              <input type="radio" name="gender" value="Female" id="edit_female"> Female
                            </label>
                          </div>
                      </div>
                      <div class="row">
                        <div class='form-group col'>
                            <label>IC:</label>
                            <input class="form-control" type='text' name="ic" id="edit_ic" required>
                        </div>
                    </div>
                  </div>
              </div>
              <div class="modal-footer">
                  <button type="submit" class="btn btn-primary">Submit</button>
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
              </div>
          </form>
      </div>
  </div>
</div>

<script>

    $('#edit').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget) 
        var edit_ID = button.data('id')
        var edit_NAME = button.data('name')
        var edit_IC = button.data('ic')
        var edit_GENDER = button.data('gender')

        var modal = $(this)
        modal.find('.modal-body #edit_id').val(edit_ID);
        modal.find('.modal-body #edit_name').val(edit_NAME);
        modal.find('.modal-body #edit_ic').val(edit_IC);

        if(edit_GENDER == "Male")
          $("#edit_male").attr('checked', true);
        else if(edit_GENDER == "Female")
          $("#edit_female").attr('checked', true);
    });

</script>
@endsection