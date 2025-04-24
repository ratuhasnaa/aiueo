<!DOCTYPE html>
<html>
<head>
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
                    <h1 style="font-size: 30px; font-weight: bold;">Add Rooms</h1>

                    <form action="{{ url('add_room') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="div_deg">
                            <label>Room Title</label>
                            <input type="text" name="title" required>
                        </div>
                        
                        <div class="div_deg">
                            <label>Description</label>
                            <textarea name="description" required></textarea>
                        </div>

                        <div class="div_deg">
                            <label>Location</label>
                            <textarea name="location" required></textarea>
                        </div>

                        <div class="div_deg">
                            <label>Price</label>
                            <input type="number" name="price" required>
                        </div>

                        <div class="div_deg">
                            <label>Room Category</label>
                            <select name="type" required>
                                <option selected value="office-space">Office Space</option>
                                <option value="coworking">Coworking</option>
                                <option value="virtual-office">Virtual Space</option>
                                <option value="meeting-room">Meeting Rooms</option>
                            </select>
                        </div>

                        <div class="div_deg">
                            <label>Free Wifi</label>
                            <select name="wifi" required>
                                <option selected value="yes">Yes</option>
                                <option value="no">No</option>
                            </select>
                        </div>

                        <div class="div_deg">
                            <label>Upload Images</label>
                            <input type="file" name="images[]" multiple>
                        </div>

                        <!-- Room Variations Section -->

                        <div class="variation-group">
    <h3>Room Variations</h3>
    <div id="variations-wrapper">
        <div class="variation-item">
            <label>Name</label>
            <input type="text" name="variations[0][name]" required>
            
            <label>U-shape Capacity</label>
            <input type="number" name="variations[0][capacity_u_shape]">

            <label>Double U-shape Capacity</label>
            <input type="number" name="variations[0][capacity_double_u_shape]">

            <label>Theatre Capacity</label>
            <input type="number" name="variations[0][capacity_theatre]">

            <label>Classroom Capacity</label>
            <input type="number" name="variations[0][capacity_classroom]">

            <label>Round Table Capacity</label>
            <input type="number" name="variations[0][capacity_round_table]">

            <label>Cocktail Capacity</label>
            <input type="number" name="variations[0][capacity_cocktail]">

            <label>Size</label>
            <input type="number" name="variations[0][size]" required>

            <label>Price/hour</label>
            <input type="number" name="variations[0][price_per_hour]" required>
        </div>
    </div>
    <button type="button" id="add-variation">Add Variation</button>
</div>

                       

                        <div class="div_deg">
                            <input class="btn btn-primary" type="submit" value="Add Room">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @include('admin.footer')


</body>
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
</html>
