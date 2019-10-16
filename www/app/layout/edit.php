<?php
//var_dump($data);
?>
<div class="container">
    <div class="row">
        <h2>Редактирование</h2>
        <div class="result">
        </div>
        <div id="alert" class="8"></div>
        <form id="MyForm" class="form-horizontal" enctype="multipart/form-data" method="POST">
            <div class="form-group">
                <label class="col-sm-2 control-label" for="uname"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Name:<b style="color: red;font-size: 18px">*</b></font></font></label>
                <div class="col-sm-8 has-feedback">
                    <input type="text" class="form-control" id="uname" name="uname" placeholder="Enter name" value="<?=$data['name'];?>">
                    <span class='glyphicon form-control-feedback'></span>
                    <em class='help-block'></em>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label" for="inputEmail"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Email:<b style="color: red;font-size: 18px">*</b></font></font></label>
                <div class="col-sm-8 has-feedback">
                    <input type="text" class="form-control" id="inputEmail" name="inputEmail" placeholder="Enter email" value="<?=$data['email'];?>">
                    <span class='glyphicon form-control-feedback'></span>
                    <em class='help-block'></em>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label" for="inputURL"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">URL:</font></font></label>
                <div class="col-sm-8 has-feedback">
                    <input type="text" class="form-control" id="inputURL" name="inputURL" placeholder="Enter url" value="<?= $data['hpage'];?>">
                    <span class='glyphicon form-control-feedback'></span>
                    <em class='help-block'></em>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label" for="msg"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Message:<b style="color: red;font-size: 18px">*</b></font></font></label>
                <div class="col-sm-8 has-feedback">
                    <textarea class="form-control" id="msg" name="msg" placeholder="Enter messages" rows="5"><?=$data['gmsg'];?></textarea>
                    <span class='glyphicon form-control-feedback'></span>
                    <em class='help-block'></em>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label" for="MyFile"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">File:</font></font></label>
                <div class="col-sm-8 has-feedback">
                    <?php
                        $disable = '';
                        if($data['fpath'] !== ''){
                            $disable = 'disabled';
                            $type = explode('.',$data['fpath']);
                            if($type[1] !== 'txt'){
                                echo '<div id="panel" class="panel"><img style="display: block; max-width: 100%; max-height: 100%; margin-top: 0px; margin-left: 0px; top: 0px; left: 0px; width: 100px; height: 100px; padding: 5px;" src="'.$data['fpath'].'">';
                            } else {
                                echo '<img style="display: block; max-width: 100%; max-height: 100%; margin-top: 0px; margin-left: 0px; top: 0px; left: 0px; width: 100px; height: 100px; padding: 5px;" src="/uploads/text.png">';
                            }
                            echo '<button type="button" class="btn btn-link" id="dimg" name="dimg"><span class="glyphicon glyphicon-remove" style="color:red;"></span></button></div>';
                        } 
                    ?>
                    <input type="file" class="form-control" id="MyFile" name="MyFile" accept="text/plain, image/png, image/gif, image/jpeg"  <?php echo $disable;?>>
                    <span class='glyphicon form-control-feedback'></span>
                    <em class='help-block'></em>
                    <!--<img id="output"/>-->
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-8 col-sm-offset-4">
                    <button type="button" class="btn btn-primary" id="MyEdit">Редактировать</button>
                    <button type="button" class="btn btn-success" onclick="javascript:document.location.href = 'http://<?=$_SERVER['SERVER_NAME']?>/guest/list'">Назад</button>
                </div>
            </div>
        </form>
    </div>
</div>