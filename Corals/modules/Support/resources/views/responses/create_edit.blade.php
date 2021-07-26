
       
            {!! CoralsForm::openForm(null,['url'=>url($comment_url), 'method'=>'post','class'=>'','data-page_action'=>"closeModal"]) !!}
                
  
         {!! Form::hidden('customer_Support_id',$customerSupport->id) !!}
        
      
        
    <div class="row">
        <div class="col-md-12">
       
            <textarea name="response" class="form-control" placeholder="response" minlength="5" maxlength="2000" required rows="10">{{ old('response') }}</textarea>
            </div>
        </div>
    <div class="row">
        <div class="col-md-12">
 

                    {!! CoralsForm::formButtons(trans('Support::labels.reply',['title' =>'Support::labels.reply']), [], ['show_cancel' => false])  !!}
                    </div>
        </div>
                {!! CoralsForm::closeForm(null) !!} 
        
