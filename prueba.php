<?php
class Validation{
    public $name="";
    public $variable;
    public $result;
    public $message;

    public function vacio($name,$var){

        $this->name="";
        $this->variable="";
        $this->result="";
        $this->message="";

        $var=trim($var);
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
                
                $_SESSION["formValidation"][$this->name]=$this->variable;
            }else{
                $this->variable="";
                $this->message="esNumero Error";
                $this->result=false;
                
                $_SESSION["formValidation"][$this->name]=$this->result;
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

    public function igualA($optional){
        if($this->result==true){
            if($this->variable==$optional){
                $this->result=true;
                $this->message="validated";
                
                $_SESSION["formValidation"][$this->name]=$this->variable;
            }else{
                $this->result=false;
                $this->variable="";
                $this->message="esIgual Error";
                
                $_SESSION["formValidation"][$this->name]=$this->result;
            }
        }
        return $this;
    }

    public function diferenteA($optional){
        if($this->result==true){
            if($this->variable!=$optional){
                $this->result=true;
                $this->message="validated";

                $_SESSION["formValidation"][$this->name]=$this->variable;
            }else{
                $this->result=false;
                $this->variable="";
                $this->message="noEsIgual Error";

                $_SESSION["formValidation"][$this->name]=$this->result;
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
                
                $_SESSION["formValidation"][$this->name]=$this->variable;
            }else{
                $this->result=false;
                $this->variable="";
                $this->message="esEmail Error";

                $_SESSION["formValidation"][$this->name]=$this->result;
            }
        }
        return $this;
    }

    public function esBoolean($name, $bool){
        $this->name="";
        $this->variable="";
        $this->result="";
        $this->message="";
        
        if($bool=="true" || $bool=="false" || $bool=="1" || $bool=="0"){
            //$boolval=boolval($bool);
            $boolval=filter_var($bool, FILTER_VALIDATE_BOOLEAN); //PHP 5
            //if(is_bool($boolval)){
            if($boolval!==null){// PHP 5
                $this->result=true;
                $this->variable=$boolval;
                $this->message="validated";
                $this->name=$name;
    
                $_SESSION["formValidation"][$this->name]=$this->result;
            }else{
                $this->result=false;
                $this->message="esBoolean Error";
                $this->name=$name;
                
                $_SESSION["formValidation"][$this->name]=$this->result;
            }
        }else{
            $this->result=false;
            $this->message="esBoolean Error";
            $this->name=$name;
        }
        return $this;
    }

    public function results(){
        return array("variable"=>$this->variable,"result"=>$this->result,"message"=>$this->message);
    }



    public static function limpiar(){
        unset($_SESSION["formValidation"]);
    }

    public static function limpiarSelect($name){
        unset($_SESSION["formValidation"][$name]);
    }

    public static function success($name){
        if(isset($_SESSION["formValidation"][$name]) && $_SESSION["formValidation"][$name]!=false){
            return true;
        }
    }

    public static function valor($name){
        if(isset($_SESSION["formValidation"][$name]) && $_SESSION["formValidation"][$name]!=false){
            return $_SESSION["formValidation"][$name];
        }
    }

    public static function failed($name){
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
