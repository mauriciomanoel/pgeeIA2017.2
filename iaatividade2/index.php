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
        <form>
        <div class="form-group" id="div_prato_principal">
            <label for="prato_principal">Prato Principal</label>
            <select class="form-control" id="prato_principal">
            <option value="" selected="selected">Selecione</option>
            <option value="1">Carne</option>
            <option value="2">Peixe</option>
            <option value="3">Ave</option>
            <option value="4">Vegetariano</option>
            </select>
        </div>
        <div class="form-group" id="div_tem_vitela">
            <label for="tem_vitela">Tem Vitela?</label>
            <div class="form-check">
                <label class="form-check-label">
                    <input class="form-check-input" type="radio" name="tem_vitela" id="tem_vitela_sim" value="sim">
                    Sim
                </label>
                <label class="form-check-label">
                    <input class="form-check-input" type="radio" name="tem_vitela" id="tem_vitela_nao" value="nao">
                    Não
                </label>
            </div>
        </div>        

        <div class="form-group" id="div_tem_peru">
            <label for="tem_peru">Tem Peru?</label>
            <div class="form-check">
                <label class="form-check-label">
                    <input class="form-check-input" type="radio" name="tem_peru" id="tem_peru_sim" value="sim">
                    Sim
                </label>
                <label class="form-check-label">
                    <input class="form-check-input" type="radio" name="tem_peru" id="tem_peru_nao" value="nao">
                    Não
                </label>
            </div>
        </div>

        <div class="form-group" id="div_tem_molho">
            <label for="tem_vitela">Tem Molho?</label>
            <div class="form-check">
                <label class="form-check-label">
                    <input class="form-check-input" type="radio" name="tem_molho" id="tem_molho_sim" value="sim">
                    Sim
                </label>
                <label class="form-check-label">
                    <input class="form-check-input" type="radio" name="tem_molho" id="tem_molho_nao" value="nao">
                    Não
                </label>
            </div>
        </div>

        <div class="form-group" id="div_molho">
            <label for="prato_principal">Molho</label>
            <select class="form-control" id="molho">
            <option value="" selected="selected">Selecione</option>
            <option value="1">Temperado</option>
            <option value="2">Doce</option>
            <option value="3">Tomate</option>
            </select>
        </div>
    
        <div class="form-group" id="div_sabor">
            <label for="prato_principal">Sabor</label>
            <select class="form-control" id="molho">
            <option value="" selected="selected">Selecione</option>
            <option value="1">Delicado</option>
            <option value="2">Médio</option>
            <option value="3">Forte</option>
            </select>
        </div>

        <div class="form-group" id="docura_preferida">
            <label for="prato_principal">Docura Preferida</label>
            <select class="form-control" id="molho">
            <option value="" selected="selected">Selecione</option>
            <option value="1">Doce</option>
            <option value="2">Suave</option>
            <option value="3">Seco</option>
            </select>
        </div>

        <div class="form-group" id="cor_preferida">
            <label for="prato_principal">Cor Preferida</label>
            <select class="form-control" id="molho">
            <option value="" selected="selected">Selecione</option>
            <option value="1">Tinto</option>
            <option value="2">Branco</option>
            </select>
        </div>
    <button type="submit" class="btn btn-primary">Sugerir</button>
    <button id="reset" type="reset" class="btn btn-danger" value="Reset">Reset</button>
    </form>
  </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>
    <script src="comum.js"></script>
  </body>
</html>