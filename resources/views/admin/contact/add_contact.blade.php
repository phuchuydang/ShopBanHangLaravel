@extends('admin_layout')
@section('admin_content')
<div class="row">
    <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    ADD CONTACT US
                </header>
                <?php $message = Session::get('message');
                    if($message){
                        echo '<span class="text-alert">'.$message.'</span>';
                        Session::put('message',null);   
                    }
                ?>
                <div class="panel-body">
                    <div class="position-center">
                        <form role="form">
                            {{csrf_field()}}
                            
                        <div class="form-group">
                            <label for="exampleInputEmail1">Contact Info</label>
                            <input type="text" name="contact_info" class="form-control contact_info " id="exampleInputEmail1" placeholder="Enter product name" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Contact Map</label>
                            <textarea style="resize:none" rows="5"  class="form-control contact_map" id="exampleInputPassword1" required>
                            </textarea>
                        </div>
                        <div class="form-group" >
                            <label for="exampleInputEmail1">Contact Logo</label>
                            <input type="file" id="contact_image" class="contact_image" name="contact_image" accept="image/*" >
                            
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Contact Fanpage</label>
                            <input type="text" name="contact_fapnage" class="form-control contact_fapnage" id="exampleInputEmail1" placeholder="Enter product name" required>
                        </div>
                       
                        
                        <button type="button" name="add_contact" class="btn btn-info add_contact">Add Contact</button>
                    </form>
                    </div>

                </div>
            </section>

    </div>
</div>
<script type="text/javascript">
    $(document).ready(function(){
        $('.add_contact').click(function(){
            var contact_info = $('.contact_info').val();
            var contact_map = $('.contact_map').val();
            var contact_image = document.getElementById('contact_image').files[0];
            var contact_fanpage = $('.contact_fapnage').val();
            var _token = $('input[name="_token"]').val();
            var form_data = new FormData();
            form_data.append('contact_info',contact_info);
            form_data.append('contact_map',contact_map);
            form_data.append('contact_image',contact_image);
            form_data.append('contact_fanpage',contact_fanpage);
            form_data.append('_token',_token);
            $.ajax({
                url: "{{URL::to('/save-contact')}}",
                method: "POST",
                data: form_data,
                contentType: false,
                cache: false,
                processData: false,
                success: function(data){
                    swal ( "Congratulation" ,  "Add Contact Success" ,  "success" );
                    setTimeout(function(){
                        location.reload();
                    }, 1000);
                }
            });
        });
    });
</script>
@endsection