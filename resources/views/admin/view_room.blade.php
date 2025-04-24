<!DOCTYPE html>
<html>
<head>
    @include('admin.css')

    <style>
        .table_deg {
            border: 2px solid #ccc;
            margin: auto;
            width: 90%;
            text-align: center;
            margin-top: 40px;
            background-color: #f9f9f9;
        }

        .th_deg {
            background-color: skyblue;
            padding: 15px;
        }

        tr {
            border: 1.5px solid white;
        }

        td {
            padding: 10px;
        }

        .btn-see-more {
            background-color: #007bff;
            color: white;
            padding: 5px 10px;
            border-radius: 5px;
            text-decoration: none;
            cursor: pointer;
        }

        .btn-see-more:hover {
            background-color: #0056b3;
        }

        .modal-content {
            border-radius: 10px;
        }

        .modal-header {
            background-color: #007bff;
            color: white;
            border-radius: 10px 10px 0 0;
        }
    </style>
</head>
<body>
    @include('admin.header')
    @include('admin.sidebar')

    <div class="page-content">
        <div class="page-header">
            <div class="container-fluid">
                <h1 style="text-align: center; margin-bottom: 20px;">Room List</h1>
                <table class="table_deg">
                    <tr>
                        <th class="th_deg">Room Title</th>
                        <th class="th_deg">Description</th>
                        <th class="th_deg">Location</th>
                        <th class="th_deg">Wifi</th>
                        <th class="th_deg">Room Category</th>
                        <th class="th_deg">Image</th>
                        <th class="th_deg">Details</th>
                        <th class="th_deg">Delete</th>
                        <th class="th_deg">Update</th>
                    </tr>

                    @foreach ($data as $room)
<tr>
    <td>{{ $room->room_title }}</td>
    <td>{!! Str::limit($room->description, 100) !!}</td>
    <td>{{ $room->location }}</td>
    <td>{{ $room->wifi }}</td>
    <td>{{ $room->room_type }}</td>
    <td>
        @if($room->images->count() > 0)
            <img src="{{ asset('room/' . $room->images->first()->image) }}" width="100" alt="Room Image">
        @else
            No Images
        @endif
    </td>
    <td>
        <button class="btn-see-more" data-bs-toggle="modal" data-bs-target="#detailsModal{{ $room->id }}">
            See More Details
        </button>
    </td>
    <td>
        <a onclick="return confirm('Are you sure?');" class="btn btn-danger" href="{{ url('room_delete', $room->id) }}">Delete</a>
    </td>
    <td>
        <a class="btn btn-warning" href="{{ url('room_update', $room->id) }}">Update</a>
    </td>
</tr>

<!-- Modal -->
<div class="modal fade" id="detailsModal{{ $room->id }}" tabindex="-1" aria-labelledby="detailsModalLabel{{ $room->id }}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="detailsModalLabel{{ $room->id }}">Room Details: {{ $room->room_title }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p><strong>Description:</strong> {{ $room->description }}</p>
                <p><strong>Location:</strong> {{ $room->location }}</p>
                <p><strong>WiFi:</strong> {{ $room->wifi }}</p>
                <p><strong>Room Category:</strong> {{ $room->room_type }}</p>
                <p><strong>Seating Arrangements:</strong>
    @if($room->variations->count() > 0)
        @foreach($room->variations as $variation)
            <ul>
                @if($variation->capacity_u_shape)
                    <li>U-Shape: {{ $variation->capacity_u_shape }} persons</li>
                @endif
                @if($variation->capacity_double_u_shape)
                    <li>Double U-Shape: {{ $variation->capacity_double_u_shape }} persons</li>
                @endif
                @if($variation->capacity_theatre)
                    <li>Theatre: {{ $variation->capacity_theatre }} persons</li>
                @endif
                @if($variation->capacity_classroom)
                    <li>Classroom: {{ $variation->capacity_classroom }} persons</li>
                @endif
                @if($variation->capacity_round_table)
                    <li>Round Table: {{ $variation->capacity_round_table }} persons</li>
                @endif
                @if($variation->capacity_cocktail)
                    <li>Cocktail: {{ $variation->capacity_cocktail }} persons</li>
                @endif
            </ul>
        @endforeach
    @else
        Not Available
    @endif
</p>

                
                <div>
                    <strong>Images:</strong>
                    @if($room->images->count() > 0)
                        @foreach($room->images as $image)
                            <img src="{{ asset('room/' . $image->image) }}" width="100" alt="Room Image">
                        @endforeach
                    @else
                        <p>No Images</p>
                    @endif
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
@endforeach

                </table>
            </div>
        </div>
    </div>

    @include('admin.footer')

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
