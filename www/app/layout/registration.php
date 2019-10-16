<div class="container">
    <div class="row">
        <h2>Регистрация</h2>
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
                <label class="col-sm-4 control-label" for="inputEmail"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Email:<b style="color: red;font-size: 18px">*</b></font></font></label>
                <div class="col-sm-5 has-feedback">
                    <input type="text" class="form-control" id="inputEmail" name="inputEmail" placeholder="Enter email">
                    <span class='glyphicon form-control-feedback'></span>
                    <em class='help-block'></em>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-4 control-label" for="inputPassword"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Password:<b style="color: red;font-size: 18px">*</b></font></font></label>
                <div class="col-sm-5 has-feedback">
                    <input type="password" class="form-control validate-equalTo-blur" id="inputPassword" name="inputPassword" placeholder="Enter password">
                    <span class='glyphicon form-control-feedback'></span>
                    <em class='help-block'></em>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-4 control-label" for="confirmPassword"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Confirm password:<b style="color: red;font-size: 18px">*</b></font></font></label>
                <div class="col-sm-5 has-feedback">
                    <input type="password" class="form-control" id="confirmPassword" name="confirmPassword" placeholder="Confirm password" aria-required="true" aria-describedby="confirm_password1-error">
                    <span class='glyphicon form-control-feedback'></span>
                    <em class='help-block'></em>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-9 col-sm-offset-4">
                    <button type="button" class="btn btn-primary" id="btn_reg">Регистрация</button>
                    <button type="reset" class="btn btn-default">Очистить форму</button>
                    <button type="button" class="btn btn-success" onclick="javascript:document.location.href = 'http://<?=$_SERVER['SERVER_NAME']?>/user/login'">Назад</button>
                </div>
            </div>
        </form>
    </div>
</div>