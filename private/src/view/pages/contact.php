            <div class="wrapper">
                <div class="out">
                    <form class="container-fluid pb-4 pt-4 bg-form" method="POST">
                        <div class="text-center w-100 pb-3">
                            <h4>Tem alguma dúvida? Fala com a gente!</h4>
                        </div>
                        <div class="form-group m-0 mb-3 row w-100">
                            <label for="name" class="col-sm-2 col-form-label pl-0"><b>Nome:</b></label>
                            <div class="col-sm-10 w-100 p-0">
                                <input type="text" class="form-control" id="name" name="name" required>
                            </div>
                        </div>
                        <div class="form-group m-0 mb-3 row w-100">
                            <label for="email" class="col-sm-2 col-form-label pl-0"><b>E-mail:</b></label>
                            <div class="col-sm-10 w-100 p-0">
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>
                        </div>
                        <div class="form-group m-0 mb-3 row w-100">
                            <label for="phone" class="col-sm-2 col-form-label pl-0"><b>Telefone:</b></label>
                            <div class="col-sm-10 w-100 p-0">
                                <input type="number" class="form-control" id="phone" name="phone" placeholder="(Opcional)">
                            </div>
                        </div>
                        <div class="form-group m-0 mb-3 row w-100">
                            <label for="subject" class="col-sm-2 col-form-label pl-0"><b>Assunto:</b></label>
                            <div class="col-sm-10 w-100 p-0">
                                <select class="form-control" id="subject" name="subject" required>
                                    <option value="" selected>Selecione...</option>
                                    <option value="Grupo de Estudos|grupodeestudos">Grupo de Estudos</option>
                                    <option value="PS Alunos|processoseletivo">Processo Seletivo de Alunos</option>
                                    <option value="PS Gestores|processoseletivo">Processo Seletivo de Gestores</option>
                                    <option value="PS Professores|processoseletivo">Processo Seletivo de Professores</option>
                                    <option value="Suporte Técnico|suporte">Suporte Técnico (site)</option>
                                    <option value="Outros|contato">Outros</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group m-0 row w-100">
                            <label for="message" class="col-sm-2 col-form-label pl-0"><b>Mensagem:</b></label>
                            <textarea rows="5" class="form-control" id="message" name="message" minlength="20" maxlength="1000" required></textarea>
                        </div>
                        <div class="w-100 text-center pt-3">
                            <button type="submit" class="btn btn-verde w-25">Enviar</button>
                        </div>
                    </form>
                </div>
            </div>