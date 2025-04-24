<!DOCTYPE html>
<html>
  <head> 
   @include('admin.css')

   <style type="text/css">

.table_deg {
    border: 2px solid;
    margin: auto;
    width: 80%;
    text-align: center;
    margin-top: 40px; 
}

    .th_deg
    {
        background-color: skyblue;
        padding: 15px;

    }

    .table_deg td, .table_deg th {
    font-size: 0.9em; /* adjust the font size to make it smaller */
    padding: 5px; /* add some padding to make it look better */
}

    tr
    {
      border: 1.5px solid white;
    }

    td 
    {
      padding: 10px;
    }

   </style>
  </head>
  <body>
    @include('admin.header')
    

    @include('admin.sidebar')
     
    <div class="page-content">
        <div class="page-header">
          <div class="container-fluid">

          <table class="table_deg">
            <tr>
                <th class="th_deg">ID</th>
                <th class="th_deg">Room Title</th>
                <th class="th_deg">Customer Name</th>
                <th class="th_deg">Email</th>
                <th class="th_deg">Phone</th>
                <th class="th_deg">Arrival Time</th>
                <th class="th_deg">Leaving Time</th>
                <th class="th_deg">Payment Prove</th>
                <th class="th_deg">Status</th>
                <th class="th_deg"></th>
                <th class="th_deg">Confirm</th>
            </tr>
            
            @foreach($data as $data)
            <tr>
                <td>{{$data->room_id}}</td>
                <td>{{ optional($data->room)->room_title ?? 'No Room Assigned' }}</td>
                <td>{{$data->name}}</td>
                <td>{{$data->email}}</td>
                <td>{{$data->phone}}</td>
                <td>{{$data->start_time}}</td>
                <td>{{$data->end_time}}</td>
                <td>
                    @if($data->payment_proof)
                        <a href="{{ asset('storage/' . $data->payment_proof) }}" target="_blank">
                            <img src="{{ asset('storage/' . $data->payment_proof) }}" alt="Payment Proof" width="80">
                        </a>
                    @else
                        No proof uploaded
                    @endif
                </td>
                <td>
                    @if($data->status == 'approve')
                        <span style="color: skyblue;">Approved</span>
                    @elseif($data->status == 'reject')
                        <span style="color: red;">Rejected</span>
                    @elseif($data->status == 'waiting')
                        <span style="color: orange;">Waiting</span>
                    @elseif($data->status == 'payment')
                        <span style="color: teal;">Waiting for Payment</span>
                    @elseif($data->status == 'pending_confirmation')
                        <span style="color: green;">Pending Confirmation</span>
                    @else
                        <span style="color: gray;">Unknown</span>
                    @endif
                </td>

                <td>
                    <span style="padding-bottom: 10px; padding-top: 10px;">
                        <a class="btn btn-success"
                        href="{{url('approve_book',$data->id)}}">✔</a>
                    </span>
                    <a class="btn btn-warning" href="{{url('reject_book',$data->id)}}">✖</a>
                </td>
                <td>
                  <a class="btn btn-success" href="{{url('send_mail_direct', $data->id)}}">Confirm by Mail</a>
                </td>
                
            </tr>
            
            @endforeach

          </table>
        </div>
        </div>
    </div>
    @include('admin.footer')
  </body>
</html>