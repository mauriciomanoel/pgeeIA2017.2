<?php
	require( 'config.ini.php' );
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
  </head>
  <body>
  <div class="container">
        </br>
        <h1>Sistema Especialista de Recomendação de Vinho</h1>
        </br>
        <form action="sugestao_vinho.php" method="post">
            <div class="form-group" id="div_prato_principal" >
                <label for="prato_principal">Prato Principal</label>
                <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#modal_prato_principal">Ajuda</button>
                    <select class="form-control" name="prato_principal" id="prato_principal" required>
                    <option value="" selected="selected">Selecione</option>
                    <option value="<?php echo PRATO_PRINCIPAL_CARNE; ?>">Carne</option>
                    <option value="<?php echo PRATO_PRINCIPAL_PEIXE; ?>">Peixe</option>
                    <option value="<?php echo PRATO_PRINCIPAL_AVE; ?>">Ave</option>
                    <option value="<?php echo PRATO_PRINCIPAL_VEGETARIANO; ?>">Vegetariano</option>
                </select>
            </div>
            <div class="form-group" id="div_tem_vitela">
                <label for="tem_vitela">Tem Vitela?</label>
                <div class="form-check">
                    <label class="form-check-label">
                        <input class="form-check-input" type="radio" name="tem_vitela" id="tem_vitela_sim" value="<?php echo TEM_VITELA_SIM;?>">
                        Sim
                    </label>
                    <label class="form-check-label">
                        <input class="form-check-input" type="radio" name="tem_vitela" id="tem_vitela_nao" value="<?php echo TEM_VITELA_NAO;?>">
                        Não
                    </label>
                </div>
            </div>        
            <div class="form-group" id="div_tem_peru">
                <label for="tem_peru">Tem Peru?</label>
                <div class="form-check">
                    <label class="form-check-label">
                        <input class="form-check-input" type="radio" name="tem_peru" id="tem_peru_sim" value="<?php echo TEM_MOLHO_SIM;?>">
                        Sim
                    </label>
                    <label class="form-check-label">
                        <input class="form-check-input" type="radio" name="tem_peru" id="tem_peru_nao" value="<?php echo TEM_MOLHO_NAO;?>">
                        Não
                    </label>
                </div>
            </div>
            <div class="form-group" id="div_tem_molho">
                <label for="tem_vitela">Tem Molho?</label>
                <div class="form-check">
                    <label class="form-check-label">
                        <input class="form-check-input" type="radio" name="tem_molho" id="tem_molho_sim" value="SIM" required>
                        Sim
                    </label>
                    <label class="form-check-label">
                        <input class="form-check-input" type="radio" name="tem_molho" id="tem_molho_nao" value="NAO" required>
                        Não
                    </label>
                </div>
            </div>
            <div class="form-group" id="div_molho">
                <label for="molho">Molho</label>
                <select class="form-control" id="molho" name="molho">
                    <option value="" selected="selected">Selecione</option>
                    <option value="<?php echo MOLHO_TEMPERADO; ?>">Temperado</option>
                    <option value="<?php echo MOLHO_DOCE; ?>">Doce</option>
                    <option value="<?php echo MOLHO_TOMATE; ?>">Tomate</option>
                </select>
                <label for="nivel_molho">Nível do Molho</label>
                <input type="range" id="nivel_molho" name="nivel_molho" min="0" max="1" step="0.01"> <label id="range_text_nivel_molho" />
            </div>   
            <div class="form-group" id="div_sabor">
                <label for="sabor">Sabor</label>
                <select class="form-control" id="sabor" name="sabor" required>
                <option value="" selected="selected">Selecione</option>
                <option value="<?php echo SABOR_DELICADO; ?>">Delicado</option>
                <option value="<?php echo SABOR_MEDIO; ?>">Médio</option>
                <option value="<?php echo SABOR_FORTE; ?>">Forte</option>
                </select>
                <label for="nivel_sabor">Nível do Sabor</label>
                <input type="range" name="nivel_sabor" min="0" max="1" step="0.01">
            </div>
            <div class="form-group" id="div_docura_preferida">
                <label for="docura_preferida">Docura Preferida</label>
                <select class="form-control" id="docura_preferida" name="docura_preferida" required>
                    <option value="" selected="selected">Selecione</option>
                    <option value="<?php echo DOCURA_PREFERIDA_DOCE; ?>">Doce</option>
                    <option value="<?php echo DOCURA_PREFERIDA_SUAVE; ?>">Suave</option>
                    <option value="<?php echo DOCURA_PREFERIDA_SECO; ?>">Seco</option>
                </select>
                <label for="nivel_docura_preferida">Nível da Doçura Preferida</label>
                <input type="range" name="nivel_docura_preferida" min="0" max="1" step="0.01">
            </div>
            <div class="form-group" id="div_cor_preferida">
                <label for="cor_preferida">Cor Preferida</label>
                <select class="form-control" id="cor_preferida" name="cor_preferida" required>
                    <option value="" selected="selected">Selecione</option>
                    <option value="<?php echo MELHOR_COR_TINTO; ?>">Tinto</option>
                    <option value="<?php echo MELHOR_COR_BRANCO; ?>">Branco</option>
                </select>
                <label for="nivel_cor_preferida">Nível da Cor Preferida</label>
                <input type="range" name="nivel_cor_preferida" min="0" max="1" step="0.01">
            </div>
            <button type="submit" class="btn btn-primary">Sugerir</button>
            <button id="reset" type="reset" class="btn btn-danger" value="Reset">Reset</button>            
        </form>        
  </div>
  </br>

  <!-- Modal -->
    <div class="modal fade" id="modal_prato_principal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Prato Principal</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                A fim de determinar a melhor cor para o seu vinho, preciso de dados sobre o Prato Principal.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>
    <script language="javascript" type="text/javascript"> 
        var PRATO_PRINCIPAL_CARNE       = '<?php echo PRATO_PRINCIPAL_CARNE;?>';
        var PRATO_PRINCIPAL_PEIXE       = '<?php echo PRATO_PRINCIPAL_PEIXE;?>';
        var PRATO_PRINCIPAL_AVE         = '<?php echo PRATO_PRINCIPAL_AVE;?>';
        var PRATO_PRINCIPAL_VEGETARIANO = '<?php echo PRATO_PRINCIPAL_VEGETARIANO;?>';

    </script>
    <script src="comum.js"></script>
  </body>
</html>