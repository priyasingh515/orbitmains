@extends('admin.layouts.app')

@section('content')

<section class="content-header">					
    <div class="container-fluid my-2">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Student List</h1>
            </div>
            {{-- <div class="col-sm-6 text-right">
                <a href="{{route('evaluate.create')}}" class="btn btn-primary">Add About</a>
            </div> --}}
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
                            <th>Name</th>
                            <th>Email</th>
                            <th>Answer Sheets Count</th>
                            <th width="100">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i =1;?>
                        @foreach ($student as $students)
                        <tr>
                            <td>{{$i++}}</td>
                            <td>{{$students->name}}</td>
                            <td> {{$students->email}}</td>
                            <td><a href="{{route('student.view',$students->id)}}">{{$students->pending_count}}</a></td>
                            
                            <td>
                                <a href="{{route('student.view',$students->id)}}">
                                    Click Here
                                </a>
                               
                            </td>
                        </tr>
                        @endforeach
                        
                    </tbody>
                </table>										
            </div>
          
        </div>
    </div>
    <!-- /.card -->
</section>

@endsection

@section('customJs')

@endsection