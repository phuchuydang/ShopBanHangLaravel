@extends('layout')
@section('content')

<div class="features_items">
    <h2 class="title text-center">New Items</h2>
    @foreach($all_video as $item => $videos)
    <div class="col-sm-4">
        <div class="product-image-wrapper">
            <div class="single-products">
                    <div class="productinfo text-center">
                        <form>
                            {{ csrf_field() }}
                          
                        </form>
                        <h2>{{ $videos->video_title }}</h2>
                        <p>{{ $videos->video_desc }}</p>
                          <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#watch-video-{{$videos->video_id}}">
                            <i class="fa fa-play" aria-hidden="true"></i>Watch Video
                          </button>
                          
                          <div class="modal fade" id="watch-video-{{$videos->video_id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                </div>
                                @php 
                                    $videos->video_link = substr($videos->video_link, 17);
                                @endphp
                                <div class="modal-body">
                                    <iframe width="100%" height="315" src="{{URL::to('https://www.youtube.com/embed/'.$videos->video_link)}}" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                </div>
                                <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                </div>
                            </div>
                            </div>
                        </div>
                        <script>
                            $(document).ready(function(){
                                $("#watch-video-{{$videos->video_id}}").on("hidden.bs.modal", function(){
                                    $("#watch-video-{{$videos->video_id}}").html("");
                                    location.reload();
                                });
                            });
                        </script>
                    </div>
            </div>
        </div>
    </div>  
       
    @endforeach
</a>
</div>
<ul class="pagination pagination-sm m-t-none m-b-none">
   {{$all_video->links()}}
</ul>


@endsection

