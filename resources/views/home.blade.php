@extends('layouts.app')
@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-9">
            <div class="card">
                <div class="card-header">留言板</div>

                <div class="card-body">

                    @foreach($list as $key=>$val)
                          <div class="panel panel-primary">
                                <div class="panel-heading" >
                                      <span class="nickname" >留言者: {{$val -> name}}</span>
                                      <span >|</span>
                                      <span class="email" style="">邮箱:{{$val -> email}}</span>
                                      <span class="time" style="float: right;">时间: {{timeHandle($val->created_at)}}</span>
                                    </div>
                                <div class="panel-body">
                                      <span class="content">内容: {{$val -> content}}</span>
                                      <span class="time" style="float: right">{{$val -> id}}楼</span>
                                    </div>
                              </div>             
                    @endforeach
                    {!! $list->links()!!}
                    @if($is_blacklist==0)
                    <div class="panel ">
                        <div class="contact-box text-center">
                            <form id="ajax-contact" action="/home/note" method="post">

                                <div class="form-group"><textarea style="resize:none;" class="form-control @error('content') is-invalid @enderror" id="content" name="content" rows="10"
                                                                   placeholder="留言内容长度最大1024*" required=""></textarea>
                                    @error('content')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror                                     
                                </div>

                                <button   class="btn btn-primary" type="submit">提 交</button>
                                <div id="form-messages"></div>
                            </form>
                        </div>
                    </div>   

                    @endif
                </div>
            </div>                
        </div>
    </div>
</div>
</div>
@endsection
