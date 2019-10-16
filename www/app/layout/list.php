<br>
<div id="wrapper" class="form-inline">
    <!--<div class="row">
        <div class="col-sm-3">
            <label>Show entries</label>
            <input type="text" id="count" name="count" class="form-control input-sm" placeholder="Enter count">
        </div>
        <div class="col-sm-3 col-sm-offset-6">
            <label>Search:</label>
            <input type="search" id="search" name="search" class="form-control input-sm" placeholder="Enter search">
        </div>
    </div>
    <br>-->
    <div class="row">
        <div class="table-responsive">
            <div class="col-sm-12">
                <table id="example" class="table table-striped table-bordered" cellspacing="0"> 
                    <thead> 
                        <tr>
                            <th tabindex="0" rowspan="1" colspan="1" style="width: 10%">Name</th>
                            <th tabindex="1" rowspan="1" colspan="1" style="width: 16%">Email</th>
                            <th tabindex="2" rowspan="1" colspan="1" style="width: 20%">Home page</th>
                            <th tabindex="2" rowspan="1" colspan="1" style="width: 14%">Date</th>
                            <th tabindex="3" rowspan="1" colspan="1" style="width: auto">Massage</th>
                            <?php 
                                if(isset($_SESSION['uid'])) {
                                    echo '<th tabindex="4" rowspan="1" colspan="1" style="width: 6%"></th>';
                                } else {
                                    echo ''; 
                                }
                            
                            ?>
                            
                        </tr>
                    </thead> 
                    <tbody>
                        <?php 
                        $result = '';
                        //var_dump($data);
                        foreach ($data['result'] as $row) {
                            $result .= '<tr><td>'.$row['name'].'</td><td>'.$row['email'].'</td><td>'.$row['hpage'].'</td><td>'.date('d.m.Y h:i:s', $row['cdate']).'</td><td>'.$row['gmsg'];
                            if($row['fpath'] !== ''){
                                $type = explode('.',$row['fpath']);
                                if($type[1] !== 'txt'){
                                    $sizes = getimagesize($_SERVER['DOCUMENT_ROOT'].$row['fpath']);
                                    $result .= '<br><div class="anim"><img style="display: block; max-width: 100%; max-height: 100%; margin-top: 0px; margin-left: 0px; top: 0px; left: 0px; width: 100px; height: 100px; padding: 5px;" class="images" src="'.$row['fpath'].'"></div>';
                                } else {
                                    $result .= '<br><div class="anim"><img style="display: block; max-width: 100%; max-height: 100%; margin-top: 0px; margin-left: 0px; top: 0px; left: 0px; width: 100px; height: 100px; padding: 5px;" class="images" src="/uploads/text.png"></div>';
                                }
                            } else $result .= '</td>';
                            if(isset($_SESSION['uid'])){
                                if($_SESSION['uid'] === $row['uid']){
                                    $result .= '<td><a href="http://'.$_SERVER['SERVER_NAME'].'/guest/edit/'.$row['id'].'"><span class="glyphicon glyphicon-pencil"></span></a></td></tr>';
                                } else {
                                    if(intval($_SESSION['role']) === 1){
                                        $result .= '<td><a href="http://'.$_SERVER['SERVER_NAME'].'/guest/edit/'.$row['id'].'"><span class="glyphicon glyphicon-pencil"></span></a></td></tr>';
                                    } else {
                                        $result .= '<td></td>';
                                    }
                                }
                            } else {
                                $result .= '</tr>';
                            }
                        }
                        echo $result;
                        ?>
                    </tbody> 
                </table>
            </div>
        </div>
    </div>
        <?php 
            $count_list = $data['count'];
            $count_page = 0;
            if(isset($_SESSION['pag']) && intval($_SESSION['pag']) > 0){
                $count_page = intval($_SESSION['pag']);
            } else {
                $count_page = PAGE_COUNT;
            }
            $count_pagination = ceil($count_list/$count_page);
            //$currentURI = rtrim($_SERVER['REQUEST_URI'], '/') . '/';
            $currentURI = preg_replace('~/[0-9]+~', '', CURRENT_URI_GUEST);
            if($count_pagination > 1){
                $pagination = '<div class="row"><div class="col-sm-4 col-sm-offset-4"><ul class="pagination">';
                for ($i = 1; $i <= $count_pagination; $i++) {
                    if(intval($data['start']) === $i){
                        $pagination .= '<li class="paginate_button active"><a href="#">'.$i.'</a></li>';
                    } else {
                        $pagination .= '<li class="paginate_button"><a href="http://'.$_SERVER['SERVER_NAME'].CURRENT_URI_GUEST.$i.'">'.$i.'</a></li>';
                    }                    
                }
                $pagination .= '</ul></div></div>';
                echo $pagination;
            }
        ?>
</div>

