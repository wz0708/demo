@extends('layouts.admin')
@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">


                <table class="table table-striped">
                    <caption></caption>
                    <thead>
                        <tr>
                            <th>用户名称</th>
                            <th>邮箱</th>
                            <th>是否黑名单</th>
                            <th>操作</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach($userList as $key=>$val)
                        <tr>
                            <td>{{$val -> name}}</td>
                            <td>{{$val -> email}}</td>
                            <td>{{$val -> is_blacklist?'是':'否'}}</td>
                            <td><button data-uid="{{$val -> id}}" type="button" class="btn btn-primary btn-action  {{$val -> is_blacklist?'relieve':'ban'}}">{{$val -> is_blacklist?'移除黑名单':'加入黑名单'}}</button></td>

                        </tr>                        
                                   
                        @endforeach                    
                    </tbody>
                </table>                    


                {!! $userList->links()!!}





            </div>                
        </div>
    </div>
</div>
</div>
<script>
    $(function () {
        $('.btn-action').on('click', function () {
            if ($(this).hasClass('ban')) {
                var isBlacklist = 1;
            } else {
                var isBlacklist = 0;
            }

            var uid = $(this).data('uid');
            $.ajax({
                type: "POST",
                url: "{{ route('admin.useraction') }}",
                dataType: 'json',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                },
                data: {
                    "uid": uid,
                    "isBlacklist": isBlacklist,
                },
                success: function (data) {
                    if (data.code == '200') {
                        alert(data.msg);
                    } else {
                        alert(data.msg);
                    }
                    window.location.reload();
                },
                error: function (request, status, error) {
                    alert(error);
                },
            });
        })
    })
</script>
@endsection

