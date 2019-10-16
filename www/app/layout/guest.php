<div class="container">
    <div class="row">
        <h2>Гостевая книга</h2>
        <div class="result">
            <?php
            include 'list.php';
            ?>
        </div>
        <div id="alert" class="8"></div>
        <form id="MyForm" class="form-horizontal" enctype="multipart/form-data" method="POST">
            <div class="form-group">
                <label class="col-sm-2 control-label" for="uname"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Name:<b style="color: red;font-size: 18px">*</b></font></font></label>
                <div class="col-sm-8 has-feedback">
                    <input type="text" class="form-control" id="uname" name="uname" placeholder="Enter name">
                    <span class='glyphicon form-control-feedback'></span>
                    <em class='help-block'></em>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label" for="inputEmail"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Email:<b style="color: red;font-size: 18px">*</b></font></font></label>
                <div class="col-sm-8 has-feedback">
                    <input type="text" class="form-control" id="inputEmail" name="inputEmail" placeholder="Enter email">
                    <span class='glyphicon form-control-feedback'></span>
                    <em class='help-block'></em>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label" for="inputURL"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">URL:</font></font></label>
                <div class="col-sm-8 has-feedback">
                    <input type="text" class="form-control" id="inputURL" name="inputURL" placeholder="Enter url">
                    <span class='glyphicon form-control-feedback'></span>
                    <em class='help-block'></em>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label" for="msg"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Message:<b style="color: red;font-size: 18px">*</b></font></font></label>
                <div class="col-sm-8 has-feedback">
                    <textarea class="form-control" id="msg" name="msg" placeholder="Enter messages" rows="5"></textarea>
                    <span class='glyphicon form-control-feedback'></span>
                    <em class='help-block'></em>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label" for="MyFile"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">File:</font></font></label>
                <div class="col-sm-8 has-feedback">
                    <input type="file" class="form-control" id="MyFile" name="MyFile" accept="text/plain, image/png, image/gif, image/jpeg">
                    <span class='glyphicon form-control-feedback'></span>
                    <em class='help-block'></em>
                    <!--<img id="output"/>-->
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-8 col-sm-offset-4">
                    <button type="button" class="btn btn-primary" id="MySend">Добавить запись</button>
                    <button type="reset" class="btn btn-default" >Очистить форму</button>
                </div>
            </div>
        </form>
    </div>
</div>