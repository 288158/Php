<DOCTYPE html>
    <html>
    <head>
        <meta charset="utf-8">
        <title>Test2</title>
    </head>
    </head>
    <body>
    <div style="width: 600px">
        <center><h3>添加Thing</h3></center>
        <form action="insert_home" method="post">
            <div >
                <label for="work">Work：</label>
                <input type="text"  id="work" name="work" placeholder="Work">
            </div>

            <div >
                <label for="status">Status：</label>
                <input type="text" name="status" id="status">
            </div>

            <div >
                <label for="share" >Share：</label>
                <input type="text"  id="share" name="share" placeholder="Share">
            </div>

            <div >
                <input type="submit" value="提交" style="margin-left: 250px">
            </div>

            <input type="hidden" name="_token" value="{{csrf_token()}}">
        </form>
    </div>
    </body>
    </html>

