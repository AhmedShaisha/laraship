
  <div class="modal-content">
    <div class="modal-body">      
    <div class="table-responsive-sm">   
    <table class="table table-striped ">
        <thead>
            <tr>
              <th>Note</th>
              <th>Status</th>
              <th>Created at</th>
              <th>Updated at</th>
            </tr>
          </thead>
          <tbody>
   @forelse ($approveRequests as $approveRequest)
   <tr>
    
   <td>{{$approveRequest->note}}</td>
   <td>
      @if ($approveRequest->status == 'pending')
      <h4> <span class="label label-info">Pending</span></h4> 
      @elseif ($approveRequest->status == 'accepted')
      <h4> <span class="label label-success">Accepted</span></h4> 
      @elseif ($approveRequest->status == 'review')
      <h4><span class="label label-warning">Send back for update</span></h4> 
      @else
      <h4><span class="label label-danger">Rejected</span></h4>   
      @endif
  </td>
   <td>{{$approveRequest->created_at->format('d M, yy')}}</td>
   <td>{{$approveRequest->updated_at->format('d M, yy')}}</td>
   
   </tr>
    
    @empty
    <h1>No Requests yet</h1>   
    @endforelse
    </tbody>
    </table>
    </div>
    </div>
</div>

    
    
