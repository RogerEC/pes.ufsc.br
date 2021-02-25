<?php
    $classUser = '';
    $classPassword = '';
    $unknownError = null;
    $errorUser = null;
    $errorPassword = null;
    $user = '';
    if(!empty($parameters)){
        if(isset($parameters[0]) && isset($parameters[1]) 
        && $parameters[0] === "userNotFound"){
            $errorUser = "Usuário não encontrado!";
            $classUser = " is-invalid";
            $user = $parameters[1];
        } else if(isset($parameters[0]) && isset($parameters[1]) 
        && $parameters[0] === "wrongPassword") {
            $errorPassword = "Senha incorreta!";
            $classPassword = " is-invalid";
            $user = $parameters[1];
        } else {
            $unknownError = "Ocorreu um erro desconhecido ao realizar o login. Tente novamente! Caso o erro persista entre em contato com o suporte em: <b>contato@pes.ufsc.br</b>.";
        }
    }
?>
            <div class="wrapper">
                <div class="out">
                    <div class="form-row bg-form p-4">
                        <div class="form-group col-md-6 mb-0">
                            <img src="/assets/img/logo-pes-circular.png" width="100%" alt="">
                        </div>
                        <div class="form-group col-md-6 mb-0">
                            <form class="container-fluid" method="POST">
                                <h4 class="pb-2 pt-4 desktop">Bem vindo!</h4>
                                <h4 class="pb-2 pt-2 mobile">Bem vindo!</h4>
                                <h6 class="pb-2 text-left">Realize o login antes de continuar.</h6>
                                <div class="form-row">
                                    <div class="form-group w-100 text-justify">
<?php if(!empty($unknownError)) {?>
                                        <p id="unknownError"><small class="text-danger"><?=$unknownError;?></small></p>
<?php } ?>
                                        <input type="text" class="form-control<?=$classUser;?>" id="user" name="user" placeholder="CPF" value="<?=$user;?>" required>
<?php if(!empty($errorUser)) {?>
                                        <small class="text-danger" id="errorUser"><?=$errorUser;?></small>
<?php } ?>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group w-100 mb-0 text-left">
                                        <input type="password" class="form-control<?=$classPassword;?>" id="password" name="password" placeholder="Senha" required>
<?php if(!empty($errorPassword)) {?>
                                        <small class="text-danger" id="errorPassword"><?=$errorPassword;?></small>
<?php } ?>
                                    </div>
                                </div>
                                <div class="w-100 text-right">
                                    <a href="/recuperar-senha" class="text-right"><small>Esqueceu sua senha?</small></a>
                                </div>
                                <div class="form-row mt-3">
                                    <div class="form-group col-6">
                                        <a href="/" class="btn btn-bordo w-100">Voltar ao site</a>
                                    </div>
                                    <div class="form-group col-6">
                                        <button class="btn btn-verde w-100">Entrar</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
