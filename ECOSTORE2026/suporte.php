<?php include 'header.php'; ?>
<section class="container py-5">

    <div class="text-center mb-5">
        <h1 class="fw-bold text-success">Central de Suporte</h1>
        <p class="lead">
            Estamos aqui para ajudar você.
        </p>
    </div>

    <div class="row">

        <div class="col-md-6">

            <h3 class="text-success">Entre em Contato</h3>

            <p>
                Se você tiver dúvidas, sugestões ou precisar de ajuda com um pedido,
                nossa equipe está pronta para atendê-lo.
            </p>

            <ul class="list-unstyled">
                <li><strong>📧 E-mail:</strong> suporte@ecostore.com</li>
                <li><strong>📞 Telefone:</strong> (43) 99999-9999</li>
                <li><strong>🕒 Atendimento:</strong> Segunda a Sexta, das 8h às 18h</li>
            </ul>

        </div>

        <div class="col-md-6">

            <div class="card shadow">
                <div class="card-body">

                    <h4 class="card-title text-success mb-3">
                        Envie uma Mensagem
                    </h4>

                    <form>

                        <div class="mb-3">
                            <label class="form-label">Nome</label>
                            <input type="text" class="form-control">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">E-mail</label>
                            <input type="email" class="form-control">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Assunto</label>
                            <input type="text" class="form-control">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Mensagem</label>
                            <textarea class="form-control" rows="4"></textarea>
                        </div>

                        <button type="submit" class="btn btn-success w-100">
                            Enviar Mensagem
                        </button>

                    </form>

                </div>
            </div>

        </div>

    </div>

    <hr class="my-5">

    <div>
        <h3 class="text-success text-center mb-4">
            Perguntas Frequentes
        </h3>

        <div class="accordion" id="faq">

            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed"
                            type="button"
                            data-bs-toggle="collapse"
                            data-bs-target="#faq1">
                        <i class="bi bi-box-seam me-2"></i>
                        Como acompanho meu pedido?
                    </button>
                </h2>
                <div id="faq1" class="accordion-collapse collapse">
                    <div class="accordion-body">
                        Você pode acompanhar seus pedidos na área "Meus Pedidos".
                    </div>
                </div>
            </div>

            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#faq2">
                        Qual o prazo de entrega?
                    </button>
                </h2>
                <div id="faq2" class="accordion-collapse collapse">
                    <div class="accordion-body">
                        O prazo varia conforme a região e será informado no momento da compra.
                    </div>
                </div>
            </div>

            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#faq3">
                        Posso trocar um produto?
                    </button>
                </h2>
                <div id="faq3" class="accordion-collapse collapse">
                    <div class="accordion-body">
                        Sim. Consulte nossa política de trocas e devoluções.
                    </div>
                </div>
            </div>

        </div>
    </div>

</section>
<?php include 'footer.php'; ?>
