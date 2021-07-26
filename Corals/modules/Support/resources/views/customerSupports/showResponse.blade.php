

@foreach($customerSupport->responses as $response)

<div class="card l px-md-5 ">
<div class="card-body">
    <h5 class="card-title">{{$response->auther()}} <small class="text-muted"> replied {{$response->created_at->diffForHumans()}}</small></h5>

    <p class="card-text">{{$response->response}}</p>
   
  </div>
   
  </div>    
 <hr>

    
   @endforeach
    
    


    
    
