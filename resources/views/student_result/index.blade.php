@extends('layout.layout')

@section('content')
<style>
  .uper {
    margin-top: 40px;
  }
</style>
<div class="card uper">
  <div class="card-header">
    <h2>Student Result</h2>
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

    <div class="row">
      <div class="col-2">
        <label>Student Name:</label>
      </div>
      <div class="col-5">
        <input class="form-control" type='text' id="stud_id" value="{{ $studentInfo }}" readonly>
      </div>
    </div>

    <br>

    <div class="row">
      <div class="col-2">
        <label>Average Result</label>
      </div>
      <div class="col-5">
        <input class="form-control" type='text' id="avg_mark" value="{{ round($avg,2) }}" readonly>
      </div>
    </div>

    <br>

    <div class="row">
      <div class="col-2">
      </div>
      <div class="col-5">
        <a class="btn btn-primary" href="{{ url('index')}}">Back To Student Page</a>
      </div>
    </div>

    <br>

    <a align="left" class="btn btn-primary col-2" data-toggle="modal" data-target="#add" style="color:white">Add</a>
    <br><br>

    <table class="display nowrap table table-hover">
      <thead class="thead">
        <tr>
          <td>Course</td>
          <td>Mark</td>
          <td>Action</td>
        </tr>
      </thead>

      <tbody>
          @foreach ($studentResult as $sr)
          <tr>
              <td>{{ $sr->course }}</td>
              <td>{{ $sr->mark }}</td>
              <td>
                  <span class="d-inline-block" tabindex="0" data-toggle="tooltip" title="Edit" id="tooltip_edit">
                      <button class="btn btn-warning btn" data-toggle="modal"           
                          data-target="#edit"
                          data-id="{{ $sr->result_id }}"
                          data-course="{{ $sr->course }}"
                          data-mark="{{ $sr->mark }}">
                            Edit
                        </button>
                    </span>
                    <span class="d-inline-block" tabindex="0" data-toggle="tooltip" title="Delete" id="tooltip_edit">
                      <form action="{{ route('delete-studentResult', $sr->result_id)}}" method="post">
                        @csrf
                        @method('post')
                        <button class="btn btn-danger" type="submit">Delete</button>
                      </form>
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
              <h3 class="col-12 modal-title text-center" id="myModalLabel">Add Student Result</h3>
              <div style="margin-left: -20%">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span style="color: #6c757d" aria-hidden="true" class="fas fa-times"></span>
                  </button>
              </div>
          </div>
          <form action="{{ route('add-studentResult')}}" method="post">
            @csrf
            @method('post')
            <input type="hidden" name="sID" value={{ $s_ID }}>
              <div class="modal-body">
                  <div class="container">
                    <div class="row">
                      <div class='form-group col'>
                          <label>Student Name:</label>
                           <input class="form-control" type='text' name="student_name" value="{{ $studentInfo }}" readonly>
                      </div>
                    </div>
                    <div class="row">
                      <div class='form-group col'>
                          <label>Course:</label>
                           <input class="form-control" type='text' name="course" required>
                      </div>
                    </div>
                    <div class="row">
                      <div class='form-group col'>
                          <label>Mark:</label>
                           <input class="form-control" type='text' name="mark" required>
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
              <h3 class="col-12 modal-title text-center" id="myModalLabel">Edit Student Result</h3>
              <div style="margin-left: -20%">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span style="color: #6c757d" aria-hidden="true" class="fas fa-times"></span>
                  </button>
              </div>
          </div>
          <form action="{{ route('edit-studentResult')}}" method="post">
            @csrf
            @method('post')
            <input type="hidden" name="sID" value={{ $s_ID }}>
              <div class="modal-body">
                  <input type="hidden" name="result_id" id="edit_id">
                  <div class="container">
                    <div class="row">
                      <div class='form-group col'>
                          <label>Student Name:</label>
                           <input class="form-control" type='text' name="student_name" value="{{ $studentInfo }}" readonly>
                      </div>
                    </div>
                    <div class="row">
                      <div class='form-group col'>
                          <label>Course:</label>
                           <input class="form-control" type='text' name="course" id="edit_course" required>
                      </div>
                    </div>
                    <div class="row">
                      <div class='form-group col'>
                          <label>Mark:</label>
                           <input class="form-control" type='text' name="mark" id="edit_mark" required>
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
      var edit_COURSE = button.data('course')
      var edit_MARK = button.data('mark')

      var modal = $(this)
      modal.find('.modal-body #edit_id').val(edit_ID);
      modal.find('.modal-body #edit_course').val(edit_COURSE);
      modal.find('.modal-body #edit_mark').val(edit_MARK);

  });

</script>
@endsection