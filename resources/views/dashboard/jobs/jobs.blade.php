@extends('layouts.appEmployee')

@section('content')
<div class="container">
    <div class="row">
        <div class="panel panel-default">
            <div class="panel-heading">Dashboard</div>


            <div class="panel-body">
            <p><strong>In Order:</strong> {{ $orderStatus[0] }}</p>
            <p><strong>In Progress:</strong> {{ $orderStatus[1] }}</p>
            <p><strong>Done:</strong> {{ $orderStatus[2] }}</p>
            <p><a href="{{ route('createJob') }}"><button class="btn btn-primary">Create Order</button></a></p>


            <hr>
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th><a id="date" onClick="pagsort($(this));">Date</a></th>
                            <th><a id="progress" onClick="pagsort($(this));">Status</a></th>
                            <th>Description</th>
                            <th>Employee</th>
                            <th>Client</th>
                            <th>Car</th>                        
                            <th><a id="pirority" onClick="pagsort($(this));">Pirority</a></th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($pagination as $key => $value)
                        <tr onclick="redir('{{ $value->id }}');">
                            <td>{{ $value->created_at}}</td>
                            <td>{{ $value->formattedProgress() }}</td>
                            <td>{{ $value->description}}</td>
                            <td>{{ $value->employeeInfo() }}</td>
                            <td>{{ $value->customerName() }}</td>
                            <td>{{ $value->carInfo() }}</td>
                            <td>{{ $value->formattedPirority() }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <div class="text-center">
                    {{ $pagination->appends(['swhat' => $swhat, 'hsorted' => $show])->links() }}
                </div>
                <script>
                    function redir(value){
                        window.location.href = "{{ url()->current() }}/"+value;
                    }

                    function pagsort(arg) {
                        var sTable = "{{ $swhat }}";
                        var howSort = "{{ $show }}";

                        if(howSort == 'asc'){
                            howSort = 'desc';
                        }else{
                            howSort = 'asc';
                        }

                        $(arg).attr('href', "{{ url()->current() }}?page=1&swhat="+arg[0].id+"&hsorted="+howSort);
                    }

                </script>
            </div>
        </div>
    </div>
</div>
@endsection
