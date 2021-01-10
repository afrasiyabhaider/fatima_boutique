<!DOCTYPE html>
<html lang="en">
  <head>
   
  
     @include('admin.title')
    @include('admin.style')
	
    
  </head>

  <body>
   @include('admin.top')
<!--close-top-serch-->
<!--sidebar-menu-->
@include('admin.menu')



<div id="content">
  <div id="content-header">
    <div id="breadcrumb">  </div>
    <h1>Add Post</h1>
  </div>
  <div class="container-fluid"><hr>
    <div class="row-fluid">
      <div class="span12">
      @if(Session::has('error'))
      <div class="alert alert-error">
              <button class="close" data-dismiss="alert"><i class="icon-off"></i></button>
              {{ Session::get('error') }}
              </div>
      @endif
      
      @if(Session::has('success'))

	           
        <div class="alert alert-success">
              <button class="close" data-dismiss="alert"><i class="icon-off"></i></button>
               {{ Session::get('success') }}
              </div>

	@endif

        <div class="widget-box">
          <div class="widget-title"> <span class="icon"> <i class="icon-info-sign"></i> </span>
            <h5>Add Post</h5>
          </div>
          <div class="widget-content nopadding">
          <?php $url = URL::to("/"); ?> 
            <form class="form-horizontal" method="post"  name="basic_validate" id="formID" action="{{ route('admin.add-blog') }}" enctype="multipart/form-data" >
              {{ csrf_field() }}
              
              
              <div class="control-group">
                <label class="control-label">Post Title</label>
                <div class="controls">
                 <input id="name" class="validate[required] text-input span8"  name="post_title" value="" type="text">
						   @if ($errors->has('post_title'))
                                    <span class="help-block" style="color:red;">
                                        <strong>That post title is already exists</strong>
                                    </span>
                                @endif
                  
                </div>
              </div>
              
              
              
              <div class="control-group">
                <label class="control-label">Description</label>
                <div class="controls">
                <textarea id="post_desc" class="validate[required] text-input span8" name="post_desc">{{ old('post_desc') }}</textarea>
                  
                </div>
              </div>
              <input type="hidden" name="post_type" value="blog">
              
              <div class="control-group">
                <label class="control-label">Media Type</label>
                <div class="controls">
                
                   <select class="validate[required] span8"  name="media_type"  onChange="showDiv(this)">
						  <option value=""></option>
						  <?php 
						  $mediatype=array("image","mp3","video");
						  foreach($mediatype as $media){?>
						  <option value="<?php echo $media;?>"><?php echo $media;?></option>
						  <?php } ?>
						  </select>
                </div>
              </div>
              
              
              <div class="control-group" id="mediaurl">
                <label class="control-label">Youtube or Vimeo Url</label>
                <div class="controls">
                 <input id="video_url" class="validate[required] span8"  name="video_url" value="{{ old('video_url') }}" type="text">
						   <br/>( Example : https://www.youtube.com/watch?v=2MpUj-Aua48  OR https://vimeo.com/56282283 )
                        
                </div>
              </div>
              
             
              
               <div class="control-group" id="mediamp3">
                <label class="control-label">Mp3 Upload</label>
                <div class="controls">
                 <input type="file" id="audio_file" name="audio_file" class="validate[required] span8">
						  
						  @if ($errors->has('audio_file'))
                                    <span class="help-block" style="color:red;">
                                        <strong>{{ $errors->first('audio_file') }}</strong>
                                    </span>
                                @endif
                </div>
              </div>
              
              
               <div class="control-group" id="mediaimg">
                <label class="control-label">Image</label>
                <div class="controls">
                <input type="file" id="photo" name="photo" class="validate[required] span8">
						  
						  @if ($errors->has('photo'))
                                    <span class="help-block" style="color:red;">
                                        <strong>{{ $errors->first('photo') }}</strong>
                                    </span>
                                @endif
                </div>
              </div>
              
              
               <div class="control-group" id="mediaurl">
                <label class="control-label">Tags</label>
                <div class="controls">
               
                   <input id="tags" class="span8"  name="tags"  type="text" data-role="tagsinput">
					<p>(Example : blog post,latest post,popular blog,trending,social media )</p>   
                </div>
              </div>
              
              
              
					
              <?php $url = URL::to("/"); ?>
              <div class="form-actions">
                        <div class="span8">
                        <a href="<?php echo $url;?>/admin/blog" class="btn btn-primary">Cancel</a>
						  <?php if(config('global.demosite')=="yes"){?><button type="button" class="btn btn-success btndisable">Submit</button> 
								<span class="disabletxt">( <?php echo config('global.demotxt');?> )</span><?php } else { ?>
						  
                            <button id="send" type="submit" class="btn btn-success">Submit</button>
								<?php } ?>
                        </div>
              
            </form>
          </div>
        </div>
      </div>
    </div>
    
  </div>
</div>



</div>





    
	 @include('admin.footer')
  </body>
</html>
