@extends('userBase')

@section('title','Purchase History')

@section('content')

<div style="margin-bottom: 50px">

</div>
<div style="margin-top: 25px; width: 1000px; margin: 0 auto">
    <table class="table table-hover">
        <thead class="bg-success">
          <tr>
            <th scope="col">Transaction History</th>
          </tr>
        </thead>

        <tbody class="shadow-lg">
            @foreach ($order as $o)
            <tr class="">
                <td><a href="{{url('historyDetail/'. $o->id)}}">{{$o->created_at}}</a></td>
            </tr>
            @endforeach
        </tbody>
      </table>
</div>



@endsection