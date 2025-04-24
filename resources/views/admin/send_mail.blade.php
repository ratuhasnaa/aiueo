<!DOCTYPE html>
<html>
  <head> 

  <style type="text/css">

    label
    {
        display: inline-block;
        width: 200px;
    }

    .div_deg
    {
        padding-top: 20px;

    }
    .div_center
    {
        padding-top: 30px;

    }
</style>

    <base href="/public">
   @include('admin.css')
   
  </head>
  <body>
    @include('admin.header')
    

    @include('admin.sidebar')

    <div class="page-content">
        <div class="page-header">
          <div class="container-fluid">

          <center>

          <h1 style="font-size:20px; font-weight: bold;">Send mail to {{$data->name}}</h1>

          <form action="{{url('mail',$data->id)}}" method="POST">

          @csrf
            <div class="div_deg">
                <label>
                    Subject
                </label>
                <input type="text" name="subject" required>
            </div>
            
            <div class="div_deg">
                <label>
                   Body
                </label>
                <textarea name="body" required></textarea>
            </div>
            <div class="div_deg">
                <label>
                    Action Text
                </label>
                <input type="text" name="action_text" required>
            </div>

            <div class="div_deg">
                <label>
                    Action URL
                </label>
                <input type="text" name="action_url" required>
            </div>

            <div class="div_deg">
                <label>
                    End Line
                </label>
                <input type="text" name="endline" required>
            </div>

           
            <div class="div_deg">
                <input class="btn btn-primary" type="submit" value="Send Mail" required>
            </div>

            
        </form>
          </center>



          </div>
        </div>
    </div>
     

    @include('admin.footer')
  </body>
</html>