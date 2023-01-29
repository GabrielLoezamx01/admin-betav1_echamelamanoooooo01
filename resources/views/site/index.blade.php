<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Bienvenido</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/uikit@3.15.22/dist/css/uikit.min.css" />
    <style>
        .bg-primary {
            background-color: #249f11;
        }

        .bg-primary>div>ul>li>a {
            color: white;
        }
    </style>
</head>

<body>
    <nav class="uk-padding-small bg-primary" uk-navbar>
        <div class="uk-navbar-left">

            <ul class="uk-navbar-nav">
                <li class="uk-nav"><a href="#">Publicaciones</a></li>
                <li><a href="#">Soporte</a></li>
            </ul>
        </div>
        <div class="uk-navbar-right">
            <ul class="uk-navbar-nav">
                <li class="uk-nav"><a href="#">Mi Perfil</a></li>
                <li class="uk-nav"><a href="#">Salir</a></li>
            </ul>
        </div>
    </nav>
    <div class="uk-container uk-padding-small ">
        <div class="uk-column-1">
            <div class="uk-margin uk-card uk-card-default uk-card-body">
                <legend class="uk-legend">Nueva Publicacion</legend>
                <textarea class="uk-textarea" rows="5"></textarea>
                <button class="uk-button uk-button-default uk-margin-top">Publicar</button>
            </div>
        </div>
    </div>
    <div class=" uk-text-center uk-text-large">Publicaciones recientes</div>
    <div class="uk-container uk-padding-small ">
        <article class="uk-comment uk-comment-primary" role="comment">
            <header class="uk-comment-header">
                <div class="uk-grid-medium uk-flex-middle" uk-grid>
                    <div class="uk-width-auto">
                        <img class="uk-comment-avatar" src="https://getuikit.com/docs/images/avatar.jpg" width="80" height="80" alt="">
                    </div>
                    <div class="uk-width-expand">
                        <h4 class="uk-comment-title uk-margin-remove"><a class="uk-link-reset" href="#">Author</a></h4>
                        <ul class="uk-comment-meta uk-subnav uk-subnav-divider uk-margin-remove-top">
                            <li><a href="#">12 days ago</a></li>
                            <li><a href="#">Reply</a></li>
                        </ul>
                    </div>
                </div>
            </header>
            <div class="uk-comment-body">
                <p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.</p>
            </div>
            <footer>
                <button class="uk-button uk-button-default uk-margin-top">Comentar</button>
                <button class="uk-button uk-button-secondary uk-margin-top">Me interesa</button>
            </footer>
        </article>
    </div>
    <div class="uk-container uk-padding-small ">
        <article class="uk-comment uk-comment-primary" role="comment">
            <header class="uk-comment-header">
                <div class="uk-grid-medium uk-flex-middle" uk-grid>
                    <div class="uk-width-auto">
                        <img class="uk-comment-avatar" src="https://getuikit.com/docs/images/avatar.jpg" width="80" height="80" alt="">
                    </div>
                    <div class="uk-width-expand">
                        <h4 class="uk-comment-title uk-margin-remove"><a class="uk-link-reset" href="#">Author</a></h4>
                        <ul class="uk-comment-meta uk-subnav uk-subnav-divider uk-margin-remove-top">
                            <li><a href="#">12 days ago</a></li>
                            <li><a href="#">Reply</a></li>
                        </ul>
                    </div>
                </div>
            </header>
            <div class="uk-comment-body">
                <p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.</p>
            </div>
            <footer>
                <button class="uk-button uk-button-default uk-margin-top">Comentar</button>
                <button class="uk-button uk-button-secondary uk-margin-top">Me interesa</button>
            </footer>
        </article>
    </div>
    <div class="uk-container uk-padding-small ">
        <article class="uk-comment uk-comment-primary" role="comment">
            <header class="uk-comment-header">
                <div class="uk-grid-medium uk-flex-middle" uk-grid>
                    <div class="uk-width-auto">
                        <img class="uk-comment-avatar" src="https://getuikit.com/docs/images/avatar.jpg" width="80" height="80" alt="">
                    </div>
                    <div class="uk-width-expand">
                        <h4 class="uk-comment-title uk-margin-remove"><a class="uk-link-reset" href="#">Author</a></h4>
                        <ul class="uk-comment-meta uk-subnav uk-subnav-divider uk-margin-remove-top">
                            <li><a href="#">12 days ago</a></li>
                            <li><a href="#">Reply</a></li>
                        </ul>
                    </div>
                </div>
            </header>
            <div class="uk-comment-body">
                <p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.</p>
            </div>
            <footer>
                <button class="uk-button uk-button-default uk-margin-top">Comentar</button>
                <button class="uk-button uk-button-secondary uk-margin-top">Me interesa</button>
            </footer>
        </article>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/uikit@3.15.22/dist/js/uikit.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/uikit@3.15.22/dist/js/uikit-icons.min.js"></script>
</body>

</html>
