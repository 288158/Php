<DOCTYPE html>
    <html>
    <head>
        <meta charset="utf-8">
        <title>Test2</title>
    </head>
    </head>
    <body>
    <divstyle="width: 600px">
        <center><h3>修改Home</h3></center>
        <form action="update_home_op" method="post">
            <div>
                <label for="work" >Work：</label>
                <input type="text" id="work" name="work" value="{{$data->work}}">
            </div>

            <div>
                <label for="status">Status：</label>
                <input type="text" name="status" id="status" value="{{$data->status}}">
            </div>

            <div>
                <label for="share" >Share：</label>
                <input type="text" id="share" name="share" value="{{$data->share}}">
            </div>

            <div>
                <input type="submit" value="提交" style="margin-left: 250px">
            </div>

            <input type="hidden" name="_token" value="{{csrf_token()}}">
        </form>
    </div>
    </body>
    </html>
