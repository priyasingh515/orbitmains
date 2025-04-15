@extends('admin.layouts.app')

@section('content')

<section class="content-header">					
    <div class="container-fluid my-2">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Student Message</h1>
            </div>
            <div class="col-sm-6 text-right">
                {{-- <a href="{{route('evaluate.create')}}" class="btn btn-primary">Add Evaluate</a> --}}
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->
</section>
<!-- Main content -->
<section class="content">
    <!-- Default box -->
    <div class="container-fluid">
        @include('admin.message')
        <div class="card">
            
            <div class="card-body table-responsive p-0">								
                <table class="table table-hover text-nowrap">
                    <thead>
                        <tr>
                            <th width="60">ID</th>
                            <th>Username</th>
                            <th>Email</th>
                            <th>Answer Sheet</th>
                            <th>Checked Sheet</th>
                            <th>Message</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i =1;?>
                        @foreach ($Message as $student)
                        <tr>
                            <td>{{$i++}}</td>
                            <td>{{$student->student_name}}</td>
                            <td>{{$student->student_email}}</td>
                            <td>
                                <a href="{{ url('public/'.$student->answer_sheet) }}" target="_blank">
                                    <img src="{{asset('public/assets/front/img/logos/pd.png')}}" alt="Answer Pdf" height="50" width="50">
                                </a>
                            </td>
                            <td>
                                <a href="{{ url('public/'.$student->check_file) }}" target="_blank">
                                    <img src="{{asset('public/assets/front/img/logos/pd.png')}}" alt="Answer Pdf" height="50" width="50">
                                </a>
                            </td>
                            <td>
                                {{-- {{ $student->description }} --}}
                                <a href="javascript:void(0);" class="btn btn-primary btn-sm view-description" data-description="{{ $student->description }}">
                                    View
                                </a>
                            </td>
                            
                            <td>
                                <a href="javascript:void(0);" class="edit-status" data-id="{{ $student->id }}" data-status="{{ $student->description }}">
                                    <svg class="filament-link-icon w-4 h-4 mr-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                        <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"></path>
                                    </svg>
                                </a>
                            </td>
                        </tr>
                        
                        @endforeach
                    
                    </tbody>
                    <div class="modal fade" id="descriptionModal" tabindex="-1" aria-labelledby="descriptionModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="descriptionModalLabel">Description</h5>
                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">&times;</button>
                            </div>
                            <div class="modal-body" id="modal-description">
                              <!-- Description will be injected here -->
                            </div>
                          </div>
                        </div>
                      </div>
                
                    <div class="modal fade" id="editStatusModal" tabindex="-1" aria-labelledby="editStatusModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editStatusModalLabel">Edit Reply Message</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">&times;</button>
                                </div>
                                <div class="modal-body">
                                    <form id="updateStatusForm">
                                        @csrf
                                        <input type="hidden" id="doubtId" name="doubt_id">
                                        
                                        <label for="status">Student Message</label>
                                        <textarea class="form-control" id="currentStatus" cols="30" rows="3" disabled></textarea>
                    
                                        <label for="newStatus" class="mt-2">Your Reply</label>
                                        <textarea class="form-control" id="newStatus" name="reply" cols="30" rows="5" required></textarea>
                    
                                        <div class="mt-3">
                                            <button type="submit" class="btn btn-primary">Update Reply</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </table>										
            </div>
          
        </div>
    </div>
    <!-- /.card -->
</section>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).on('click', '.view-description', function () {
        var description = $(this).data('description');
        $('#modal-description').text(description);
        $('#descriptionModal').modal('show');
    });
</script>

@endsection

@section('customJs')

<script>
    $(document).ready(function() {
        // Open modal and set data
        $(".edit-status").click(function() {
            let doubtId = $(this).data("id");
            let currentStatus = $(this).data("status");

            $("#doubtId").val(doubtId);
            $("#currentStatus").val(currentStatus);
            $("#newStatus").val(""); 
            $("#editStatusModal").modal("show");
        });

        // AJAX Form Submit
        $("#updateStatusForm").submit(function(e) {
            e.preventDefault();

            let formData = {
                _token: $('meta[name="csrf-token"]').attr("content"),
                doubt_id: $("#doubtId").val(),
                reply: $("#newStatus").val()
            };

            $.ajax({
                url: "/admin/send-reply",
                type: "POST",
                data: formData,
                success: function(response) {
                    alert("Reply Sent Successfully!");
                    location.reload();
                },
                error: function(error) {
                    console.log("Error:", error);
                }
            });
        });
    });
</script>


@endsection