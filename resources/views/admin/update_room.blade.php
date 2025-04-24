<!DOCTYPE html>
<html>
  <head>
    <base href="/public">
    @include('admin.css')
    <style type="text/css">
        label {
            display: inline-block;
            width: 200px;
        }

        .div_deg {
            padding-top: 20px;
        }

        .div_center {
            padding-top: 30px;
        }

        .variation-group {
            border: 1px solid #ccc;
            padding: 15px;
            margin-bottom: 15px;
        }
    </style>
  </head>
  <body>
    @include('admin.header')
    @include('admin.sidebar')

    <div class="page-content">
        <div class="page-header">
            <div class="container-fluid">
                <div class="div_center">
                    <h1 style="font-size: 30px; font-weight: bold;">Update Room</h1>
                    <form action="{{ url('edit_room', $data->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="div_deg">
                            <label>Room Title</label>
                            <input type="text" name="title" value="{{ $data->room_title }}" required>
                        </div>

                        <div class="div_deg">
                            <label>Description</label>
                            <textarea name="description" required>{{ $data->description }}</textarea>
                        </div>

                        <div class="div_deg">
                            <label>Location</label>
                            <textarea name="location" required>{{ $data->location }}</textarea>
                        </div>

                        <div class="div_deg">
                            <label>Price</label>
                            <input type="number" name="price" value="{{ $data->price }}" required>
                        </div>

                        <div class="div_deg">
                            <label>Room Category</label>
                            <select name="type" required>
                                <option selected value="{{ $data->room_type }}">{{ ucfirst($data->room_type) }}</option>
                                <option value="office-space">Office Space</option>
                                <option value="coworking">Coworking</option>
                                <option value="virtual-office">Virtual Space</option>
                                <option value="meeting-room">Meeting Rooms</option>
                            </select>
                        </div>

                        <div class="div_deg">
                            <label>Free Wifi</label>
                            <select name="wifi" required>
                                <option selected value="{{ $data->wifi }}">{{ ucfirst($data->wifi) }}</option>
                                <option value="yes">Yes</option>
                                <option value="no">No</option>
                            </select>
                        </div>

                        <div class="div_deg">
                            <label>Current Images</label>
                            <div style="display: flex; gap: 10px; flex-wrap: wrap;">
                                @foreach($data->images as $image)
                                    <div style="position: relative; display: inline-block; margin: 10px;">
                                        <img style="margin: auto; border: 1px solid #ccc;" width="100" src="{{ asset('room/' . $image->image) }}" alt="Room Image">
                                        <a href="{{ route('delete_room_image', $image->id) }}" 
                                        onclick="return confirm('Are you sure you want to delete this image?');" 
                                        style="position: absolute; top: 0; right: 0; background: red; color: white; padding: 2px 5px; text-decoration: none; border-radius: 50%;">
                                        X
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <div class="div_deg">
                            <label>Upload Images</label>
                            <input type="file" name="images[]" multiple>
                        </div>

                        <!-- Room Variations Section -->
                        <div class="variation-group">
                            <h3>Room Variations</h3>
                            <div id="variations-wrapper">
                                @foreach($data->variations as $index => $variation)
                                    <div class="variation-item">
                                        <label>Name</label>
                                        <input type="text" name="variations[{{ $index }}][name]" value="{{ $variation->name }}" required>

                                        <label>U-shape Capacity</label>
                                        <input type="number" name="variations[{{ $index }}][capacity_u_shape]" value="{{ $variation->capacity_u_shape }}">

                                        <label>Double U-shape Capacity</label>
                                        <input type="number" name="variations[{{ $index }}][capacity_double_u_shape]" value="{{ $variation->capacity_double_u_shape }}">

                                        <label>Theatre Capacity</label>
                                        <input type="number" name="variations[{{ $index }}][capacity_theatre]" value="{{ $variation->capacity_theatre }}">

                                        <label>Classroom Capacity</label>
                                        <input type="number" name="variations[{{ $index }}][capacity_classroom]" value="{{ $variation->capacity_classroom }}">

                                        <label>Round Table Capacity</label>
                                        <input type="number" name="variations[{{ $index }}][capacity_round_table]" value="{{ $variation->capacity_round_table }}">

                                        <label>Cocktail Capacity</label>
                                        <input type="number" name="variations[{{ $index }}][capacity_cocktail]" value="{{ $variation->capacity_cocktail }}">

                                        <label>Size</label>
                                        <input type="number" name="variations[{{ $index }}][size]" value="{{ $variation->size }}" required>

                                        <label>Price/hour</label>
                                        <input type="number" name="variations[{{ $index }}][price_per_hour]" value="{{ $variation->price_per_hour }}" required>
                                    </div>
                                @endforeach
                            </div>
                            <button type="button" id="add-variation">Add Variation</button>
                        </div>

                        <div class="div_deg">
                            <input class="btn btn-primary" type="submit" value="Update Room">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @include('admin.footer')
    <script>
        document.getElementById('add-variation').addEventListener('click', function() {
            const wrapper = document.getElementById('variations-wrapper');
            const newIndex = wrapper.children.length;
            const newItem = wrapper.children[0].cloneNode(true);
            Array.from(newItem.querySelectorAll('input')).forEach(input => {
                const name = input.name.replace(/\[\d+\]/, `[${newIndex}]`);
                input.name = name;
                input.value = '';
            });
            wrapper.appendChild(newItem);
        });
    </script>
  </body>
</html>
