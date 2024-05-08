<?php
class FormValidation{
    public $name="";
    public $variable;
    public $result;
    public $message;

    public function vacio($name,$var){

        $this->name="";
        $this->variable="";
        $this->result="";
        $this->message="";

        if(!empty($var)){
            $this->result=true;
            $this->variable=$var;
            $this->message="validated";
            $this->name=$name;

            $_SESSION["formValidation"][$this->name]=$this->variable;
        }else{
            $this->result=false;
            $this->message="vacio Error";
            $this->name=$name;
            
            $_SESSION["formValidation"][$this->name]=$this->result;
        }
        return $this;
    }

    public function esNumero(){
        if($this->result==true){
            if(is_numeric($this->variable)){
                $this->result=true;
                $this->message="validated";
            }else{
                $this->variable="";
                $this->message="esNumero Error";
                $this->result=false;
            }
        }
        return $this;
    }

    public function esCadena(){
        if($this->result==true){
            if(is_string($this->variable)){
                $this->result=true;
                $this->message="validated";

                $_SESSION["formValidation"][$this->name]=$this->variable;
            }else{
                $this->variable="";
                $this->message="esCadena Error";
                $this->result=false;
                
                $_SESSION["formValidation"][$this->name]=$this->result;
            }
        }
        return $this;
    }

    public function esIgual($optional){
        if($this->result==true){
            if($this->variable==$optional){
                $this->result=true;
                $this->message="validated";
            }else{
                $this->result=false;
                $this->variable="";
                $this->message="esIgual Error";
            }
        }
        return $this;
    }

    public function noEsIgual($optional){
        if($this->result==true){
            if($this->variable!=$optional){
                $this->result=true;
                $this->message="validated";
            }else{
                $this->result=false;
                $this->variable="";
                $this->message="noEsIgual Error";
            }
        }
        return $this;
    }


    public function esEmail(){
        if($this->result==true){
            //strpos($this->variable,"@") && strpos($this->variable,".")
            if(false !== strpos($this->variable, "@") && false !== strpos($this->variable, ".")){
                $this->result=true;
                $this->message="validated";
            }else{
                $this->result=false;
                $this->variable="";
                $this->message="esEmail Error";
            }
        }
        return $this;
    }

    public function validationsResults(){
        return array("variable"=>$this->variable,"result"=>$this->result,"message"=>$this->message);
    }

    public function clearValidations(){
        unset($_SESSION["formValidation"]);
    }

    public function succesValidation($name){
        if(isset($_SESSION["formValidation"][$name]) && $_SESSION["formValidation"][$name]!=false){
            return $_SESSION["formValidation"][$name];
        }
    }

    public function failValidation($name){
        if(isset($_SESSION["formValidation"][$name]) && $_SESSION["formValidation"][$name]==false){
            return true;
        }
    }
}

//$validaciones= new FormValidation();
/*$años=$validaciones->vacio("1")->esNumero()->esCadena()->validationsResults();
if($años["result"]){
    echo $años["variable"];
    echo "<br>";
    echo $años["message"];
}
echo "<hr>";
$años02=$validaciones->vacio("12")->esIgual(12)->noEsIgual(15)->validationsResults();
echo $años02["variable"];
echo "<br>";
echo $años02["message"];
echo "<hr>";
$años02=$validaciones->vacio("ayron@ayron.com")->esEmail()->validationsResults();
echo $años02["variable"];
echo "<br>";
echo $años02["message"];*/


//$validaciones->vacio("nombre","ayron")->esCadena();

//$validaciones->vacio("apellido","Acuña")->esCadena()->validationsResults();

//var_dump($_SESSION["formValidation"]);
//$validaciones->clearValidations();
//header("Location: ./prueba2.php");
?>