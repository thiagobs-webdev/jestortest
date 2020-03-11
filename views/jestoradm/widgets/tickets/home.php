<?php $v->layout("jestoradm/_template"); ?>

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Dashboard > Tickets</h1>
</div>


<div class="card">

    <!-- Message -->
    <div class="row my-2">
        <div class="form_callback">
            <?= flash(); ?>
        </div>
    </div>


    <h5 class="card-header bg-dark">
        <a class="btn btn-primary" href="#" data-toggle="modal" data-target="#newTicket">
            <i class="fas fa-plus"></i>
            Novo
        </a>
    </h5>
    <div class="card-body">
        <table class="table table-striped table-bordered table-hover">
            <thead class="bg-success text-white">
                <tr>
                    <th scope="col">Título</th>
                    <th scope="col">Descrição</th>
                    <th scope="col">Data de criação</th>
                    <th scope="col">Status</th>
                    <th scope="col">Ações</th>
                </tr>
            </thead>
            <tbody>

                <?php if (!empty($tickets)): ?>
                <?php foreach ($tickets as $ticket): ?>
                <tr>
                    <td><?= $ticket->title;?></td>
                    <td><?= $ticket->description;?></td>
                    <td><?= $ticket->created_at;?></td>
                    <td><?= $ticket->status;?></td>
                    <td>

                        <button type="button" class="btn btn-outline-primary btn-sm btn-pill" data-toggle="modal"
                            data-toggle="modal" data-target="#viewTicket" title="Visualizar"
                            data-whateverticketid="<?= $ticket->id;?>"
                            data-whatevertickettitle="<?= $ticket->title;?>"
                            data-whateverticketdescription="<?= $ticket->description;?>"
                            data-whateverticketstatus="<?= $ticket->status;?>">
                            <i class="fa fa-fw fa-eye"></i>
                        </button>

                        <button type="button" class="btn btn-outline-warning btn-sm btn-pill" title="Editar"
                            data-toggle="modal" data-target="#editTicket" data-whateverticketid="<?= $ticket->id;?>"
                            data-whatevertickettitle="<?= $ticket->title;?>"
                            data-whateverticketdescription="<?= $ticket->description;?>">
                            <i class="fa fa-fw fa-edit"></i>
                        </button>

                        <a href="#" class="btn btn-outline-danger btn-sm btn-pill" title="Delete"
                            data-post="<?= $router->route("tickets.delete"); ?>" data-action="delete"
                            data-confirm="ATENÇÃO: Tem certeza que deseja excluir o Ticket?"
                            data-ticket_id="<?= $ticket->id; ?>">
                            <i class="fa fa-fw fa-trash"></i>

                        </a>


                    </td>
                <tr>
                    <?php endforeach; ?>
                    <?php else: ?>
                    <p class="">
                        No momento, não existem tickets.
                    </p>
                    <?php endif; ?>

            </tbody>
        </table>
    </div>
</div>


<!-- Create Modal-->
<div class="modal fade" id="newTicket" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">

    <!-- Ajax Load -->
    <div class="ajax_load">
        <div class="ajax_load_box">
            <div class="ajax_load_box_circle"></div>
            <div class="ajax_load_box_title">Aguarde, carrengando...</div>
        </div>
    </div>

    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-dark text-white">
                <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-ticket-alt"></i> Novo Ticket</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form name="ticket_store" action="<?= $router->route("tickets.store"); ?>" method="post" autocomplete="off">
                <div class="modal-body">

                    <!-- Error Message -->
                    <div class="row">
                        <div class="form_callback">
                            <?= flash(); ?>
                        </div>
                    </div>


                    <div class="form-group">
                        <label for="inputTitle">Título</label>
                        <input name="title" type="text" class="form-control" id="tilte" aria-describedby="titlelHelp"
                            placeholder="Digite o Título">
                        <small id="titlelHelp" class="form-text text-muted"></small>
                    </div>
                    <div class="form-group">
                        <label for="inputDescription">Descrição</label>
                        <input name="description" type="text" class="form-control" id="exampleInputPassword1"
                            placeholder="Digite a descrição">
                    </div>


                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
                    <button class="btn btn-success" type="submit">Salvar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- EDIT Modal-->
<div class="modal fade" id="editTicket" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">

    <!-- Ajax Load -->
    <div class="ajax_load">
        <div class="ajax_load_box">
            <div class="ajax_load_box_circle"></div>
            <div class="ajax_load_box_title">Aguarde, carrengando...</div>
        </div>
    </div>

    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-warning text-white">
                <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-ticket-alt"></i> Editar Ticket</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form name="ticket_update" action="<?= $router->route("tickets.update"); ?>" method="post"
                autocomplete="off">
                <div class="modal-body">

                    <!-- Error Message -->
                    <div class="row">
                        <div class="form_callback">
                            <?= flash(); ?>
                        </div>
                    </div>

                    <input type="hidden" name="ticketId" id="ticketId">
                    <div class="form-group">
                        <label for="inputTitle">Título</label>
                        <input name="title" type="text" class="form-control" id="title" aria-describedby="titlelHelp"
                            placeholder="Digite o Título">
                        <small id="titlelHelp" class="form-text text-muted"></small>
                    </div>
                    <div class="form-group">
                        <label for="inputDescription">Descrição</label>
                        <input name="description" type="text" class="form-control" id="description"
                            placeholder="Digite a descrição">
                    </div>


                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
                    <button class="btn btn-success" type="submit">Salvar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- View Modal -->
<div class="modal fade" id="viewTicket" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="exampleModalCenterTitle">Visualizar Ticket</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <dl class="row">
                    <dt class="col-sm-3">Título:</dt>
                    <dd class="col-sm-9" id="ticketViewTitle"></dd>

                    <dt class="col-sm-3">Descrição:</dt>
                    <dd class="col-sm-9" id="ticketViewDescription"></dd>

                    <dt class="col-sm-3">Status:</dt>
                    <dd class="col-sm-9" id="ticketViewStatus"></dd>
                </dl>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div>