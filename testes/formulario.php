<?php
  
 /*     include("conexao.php");
    
  if (isset($_SERVER['REQUEST_METHOD'] ) && $_SERVER['REQUEST_METHOD'] === 'POST') {
    echo "Form submitted!";
}

   echo "<pre>";
   print_r($_POST);
   echo "</pre>";

   if(isset($_POST['cadastro_submit']))
   {
    echo $_POST['nome'];
    echo $_POST['email'];
    echo $_POST['senha'];

    $pstmt = $conexao -> prepare("insert into users (nome,email,password) values(?,?,?) ");
    $pstmt -> bind_param("s",$_POST["nome"]);
    $pstmt -> bind_param("s",$_POST["email"]);
    $pstmt -> bind_param("s",$_POST["senha"]);

    if($pstmt -> execute()){
        echo "cadastrado"; 

    }else{
        echo "erro ao cadastrar";
    }


    print_r($_POST['nome']);
    print_r($_POST['email']);
    print_r($_POST['senha']);

   }
*/
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        body{
            font-family: Arial, Helvetica, sans-serif;
            background-color:  rgb(29, 26, 26);
        }
        .box{
            color: white;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%,-50%);
            background-color: rgba(0, 0, 0, 0.308);
            padding: 15px;
           
            width: 20%;
        }
        
        
        
        
        .inputBox{
            position: relative;
        }
        .inputUser{
            background: none;
            border: none;
            border-bottom: 1px solid gray;
            outline: none;
            color: gray;
            font-size: 15px;
            width: 100%;
            letter-spacing: 2px;
        }
        .labelInput{
            position: absolute;
            top: 0px;
            left: 0px;
            pointer-events: none;
            transition: .5s;
        }
        .inputUser:focus ~ .labelInput,
        .inputUser:valid ~ .labelInput{
            top: -20px;
            font-size: 12px;
            color: rgb(90, 15, 30);
        }
     
        
        #submit{
            background-color: rgb(180, 45, 45);
            width: 100%;
            border: none;
            padding: 15px;
            color: white ;
            font-size: 15px;
            cursor: pointer;
           
        }
        #submit:hover{
            background-color: rgb(150, 39, 39);
        }
    </style>
</head>
<!--<body>
    <div class="box">
        <form action="" method="GET"> 
           
                <br>
                <div class="inputBox">
                    <input type="text" name="nome" id="nome" class="inputUser" required/>
                    <label for="nome" class="labelInput">Nome</label>
                </div>
                <br><br>
                <div class="inputBox">
                    <input type="text" name="email" id="email" class="inputUser" required/>
                    <label for="email" class="labelInput">Email</label>
                </div>


                <br><br>
                <div class="inputBox">
                    <input type="password" name="senha" id="senha" class="inputUser" required/>
                    <label for="senha" class="labelInput">Senha</label>
                </div>
                
               
                <div class="inputBox">
                   
                </div>
               
                <div class="inputBox">
                    
                </div>
                <br><br>
                <input type="submit" name="cadastro_submit" id="submit"/>
            </fieldset>
        </form>
    </div>
</body>
</html> -->
<div class="box">
              <form action="acoes.php" method="POST">
                <div class="inputBox">
                <br>
                <input type="text" name="nome" id="nome" class="inputUser" required/>
                <label for="nome" class="labelInput">Nome</label>
                </div>
                
                <br><br>
                <div class="inputBox">
                    <input type="text" name="email" id="email" class="inputUser" required/>
                    <label for="email" class="labelInput">Email</label>
                </div>
                <br><br>
               <!--  <div class="mb-3">
                   <label>Data de Nascimento</label> 
                  <input type="date" name="data_nascimento" class="form-control">
                </div> -->
                <div class="inputBox">
                    <input type="password" name="senha" id="senha" class="inputUser" required/>
                    <label for="senha" class="labelInput">Senha</label>
                <br><br>
                <div class="inputBox">
                <input type="submit" name="create_usuario" id="submit"/>
               
                </div>

              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>