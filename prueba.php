<?php
class Validation{
    public $name="";
    public $variable;
    public $result;
    public $message;

    public function vacio($name,$var,$error=null,$message=null){

        $this->name="";
        $this->variable="";
        $this->result="";
        $this->message="";

        $var=trim($var);
        if(!empty($var)){
            $this->result=true;
            $this->variable=$var;
            $this->message=$message==null?"validated":$message;
            $this->name=$name;

            $_SESSION["formValidation"][$this->name]=$this->variable;
        }else{
            $this->result=false;
            $this->message=$error==null?"vacio Error":$error;
            $this->name=$name;
            
            $_SESSION["formValidation"][$this->name]=$this->result;
        }
        $_SESSION["formValidation"][$this->name."Men"]=$this->message;
        return $this;
    }

    public function esNumero($error=null,$message=null){
        if($this->result==true){
            if(is_numeric($this->variable)){
                $this->result=true;
                $this->message=$message==null?"validated":$message;
                
                $_SESSION["formValidation"][$this->name]=$this->variable;
            }else{
                $this->variable="";
                $this->message=$error==null?"esNumero Error":$error;
                $this->result=false;
                
                $_SESSION["formValidation"][$this->name]=$this->result;
            }
            $_SESSION["formValidation"][$this->name."Men"]=$this->message;
        }
        return $this;
    }

    public function esCadena($error=null,$message=null){
        if($this->result==true){
            if(is_string($this->variable)){
                $this->result=true;
                $this->message=$message==null?"validated":$message;

                $_SESSION["formValidation"][$this->name]=$this->variable;
            }else{
                $this->variable="";
                $this->message=$error==null?"esCadena Error":$error;
                $this->result=false;
                
                $_SESSION["formValidation"][$this->name]=$this->result;
            }
            $_SESSION["formValidation"][$this->name."Men"]=$this->message;
        }
        return $this;
    }

    public function igualA($optional,$error=null,$message=null){
        if($this->result==true){
            if($this->variable==$optional){
                $this->result=true;
                $this->message=$message==null?"validated":$message;
                
                $_SESSION["formValidation"][$this->name]=$this->variable;
            }else{
                $this->result=false;
                $this->variable="";
                $this->message=$error==null?"esIgual Error":$error;
                
                $_SESSION["formValidation"][$this->name]=$this->result;
            }
            $_SESSION["formValidation"][$this->name."Men"]=$this->message;
        }
        return $this;
    }

    public function diferenteA($optional,$error=null,$message=null){
        if($this->result==true){
            if($this->variable!=$optional){
                $this->result=true;
                $this->message=$message==null?"validated":$message;

                $_SESSION["formValidation"][$this->name]=$this->variable;
            }else{
                $this->result=false;
                $this->variable="";
                $this->message=$error==null?"noEsIgual Error":$error;

                $_SESSION["formValidation"][$this->name]=$this->result;
            }
            $_SESSION["formValidation"][$this->name."Men"]=$this->message;
        }
        return $this;
    }


    public function esEmail($error=null,$message=null){
        if($this->result==true){
            //strpos($this->variable,"@") && strpos($this->variable,".")
            if(false !== strpos($this->variable, "@") && false !== strpos($this->variable, ".")){
                $this->result=true;
                $this->message=$message==null?"validated":$message;
                
                $_SESSION["formValidation"][$this->name]=$this->variable;
            }else{
                $this->result=false;
                $this->variable="";
                $this->message=$error==null?"esEmail Error":$error;

                $_SESSION["formValidation"][$this->name]=$this->result;
            }
            $_SESSION["formValidation"][$this->name."Men"]=$this->message;
        }
        return $this;
    }

    public function esBoolean($name, $bool,$error=null,$message=null){
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
                $this->message=$message==null?"validated":$message;
                $this->name=$name;
    
                $_SESSION["formValidation"][$this->name]=$this->result;
            }else{
                $this->result=false;
                $this->message=$error==null?"esBoolean Error":$error;
                $this->name=$name;
                
                $_SESSION["formValidation"][$this->name]=$this->result;
            }
            $_SESSION["formValidation"][$this->name."Men"]=$this->message;
        }else{
            $this->result=false;
            $this->message="Booleanos no reconocidos";
            $this->name=$name;

            $_SESSION["formValidation"][$this->name."Men"]=$this->message;
            $_SESSION["formValidation"][$this->name]=$this->result;
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
        unset($_SESSION["formValidation"][$name."Men"]);
    }

    public static function limpiarExcep($name){
        foreach($_SESSION["formValidation"] as $session=>$valor){
            if($session!==$name){
                unset($_SESSION["formValidation"][$session]);
                unset($_SESSION["formValidation"][$session."Men"]);
            }
        }
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

    public static function showMessage($name){
        if(isset($_SESSION["formValidation"][$name])){
            return $_SESSION["formValidation"][$name."Men"];
        }
    }

}
?>
