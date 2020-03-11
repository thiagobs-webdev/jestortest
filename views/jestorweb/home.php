<?php $v->layout("jestorweb/_theme"); ?>

<div class="jumbotron">
    <h1 class="display-4">Bem-vindo ao Sistema de <i>Tickets</i> para atendimento <b>Jestor</b>.</h1>
    <p class="lead">
        Faça seu Cadastro ou Login para registrar seus <i>Tickets</i>.
    </p>
    <hr class="my-4">
    <p>

    </p>
    <p>
        Você poderá cadastrar, editar, deletar e listar seus <i>Tickets</i>. Venha Conferir.
    </p>
    <div class="text-center mt-5">
        <a class="btn btn-outline-success btn-lg" href="<?= $router->route("web.register"); ?>"
            role="button">Cadastre-se</a>
        <a class="btn btn-outline-dark btn-lg" href="<?= $router->route("web.login"); ?>" title="Login">Login</a>
    </div>

</div>



<?php $v->start("scripts"); ?>

<?php $v->end(); ?>