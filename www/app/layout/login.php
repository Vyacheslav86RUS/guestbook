<div class="container">
    <div class="row">
        <h2>Вход</h2>
        <div id="alert" class="5"></div>
        <form id="MyForm" method="post" class="form-horizontal">
            <div class="form-group">
                <label class="col-sm-4 control-label" for="login"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Login:<b style="color: red;font-size: 18px">*</b></font></font></label>
                <div class="col-sm-5 has-feedback">
                    <input type="text" class="form-control" id="login" name="login" placeholder="Enter login">
                    <span class='glyphicon form-control-feedback'></span>
                    <em class='help-block'></em>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-4 control-label" for="inputPassword"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Password:<b style="color: red;font-size: 18px">*</b></font></font></label>
                <div class="col-sm-5 has-feedback">
                    <input type="password" class="form-control" id="inputPassword" name="inputPassword" placeholder="Enter password">
                    <span class='glyphicon form-control-feedback'></span>
                    <em class='help-block'></em>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-4 col-sm-4">
                    <button type="button" class="btn btn-primary" id="btn_login">Подтвердить</button>
                    <span style="padding-left: 15px;"><a href="http://<?=$_SERVER['SERVER_NAME']?>/user/reg">Зарегистрироваться</a></span>
                </div>
            </div>
        </form>
    </div>
</div>