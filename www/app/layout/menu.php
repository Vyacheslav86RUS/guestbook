<nav role="navigation" class="navbar navbar-default navbar-fixed-top">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" data-target="#navbarCollapse" data-toggle="collapse" class="navbar-toggle">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
        </div>
        <!-- Collection of nav links and other content for toggling -->
        <div id="navbarCollapse" class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <a href="http://<?= $_SERVER['SERVER_NAME'] ?>/guest/list" class="navbar-brand">Гостевая книга</a>
            </ul>
            <?php
            /* if($_SESSION['uid']){
              $nav = '<form class="navbar-form navbar-left" method="post">';
              $nav .= '<div class="input-group">';
              $nav .= '<input type="text" class="form-control" placeholder="Введите количество отображаеммых сообщений" id="pagination">';
              $nav .= '<div class="input-group-btn">';
              $nav .= '<button class="btn btn-default" type="submit" id="pag">';
              $nav .= '<i class="glyphicon glyphicon-send"></i>';
              $nav .= '</button>';
              $nav .= '</div>';
              $nav .= '</div>';
              $nav .= '</form>';
              } */
            ?>  
            <form class="navbar-form navbar-left" method="post">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Количество сообщений" id="pagination">
                    <div class="input-group-btn">
                        <button class="btn btn-default" type="button" id="pag">
                            <i class="glyphicon glyphicon-send"></i>
                        </button>
                    </div>
                </div>
            </form>
            <ul class="nav navbar-nav navbar-right">
                <?php
                if (isset($_SESSION['uid'])) {
                    echo '<li><a href="http://' . $_SERVER['SERVER_NAME'] . '/app/core.php?id=logout">Выход</a></li>';
                } else {
                    echo '<li><a href="http://' . $_SERVER['SERVER_NAME'] . '/user/login">Вход</a></li>';
                }
                ?>
            </ul>
        </div>
    </div>
</nav>

