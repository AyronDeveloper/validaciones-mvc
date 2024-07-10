<?php
class Vali{
    public $name="";
    public $variable;
    public $result;
    public $message;

    private function analisis($analisis){
        $analisis=trim($analisis);
        if($analisis==null || $analisis==""){
            return true;
        }else{
            return false;
        }
    }


    public function vacio($name,$var,$error=null,$message=null){

        $this->name="";
        $this->variable="";
        $this->result="";
        $this->message="";

        $var=trim($var);
        if(!empty($var)){
            $this->result=true;
            $this->variable=$var;
            $this->message=$this->analisis($message)?"validated":$message;
            $this->name=$name;

            $_SESSION["formValidation"][$this->name]=$this->variable;
        }else{
            $this->result=false;
            $this->message=$this->analisis($error)?"vacio Error":$error;
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
                $this->message=$this->analisis($message)?"validated":$message;
                
                $_SESSION["formValidation"][$this->name]=$this->variable;
            }else{
                $this->variable="";
                $this->message=$this->analisis($error)?"esNumero Error":$error;
                $this->result=false;
                
                $_SESSION["formValidation"][$this->name]=$this->result;
            }
            $_SESSION["formValidation"][$this->name."Men"]=$this->message;
        }
        return $this;
    }

    public function esEntero($error=null,$message=null){
        if($this->result==true){
            if(false === strpos($this->variable,".")){
                $entero=intval($this->variable);
                if(is_int($entero)){
                    $this->result=true;
                    $this->message=$this->analisis($message)?"validated":$message;
                    
                    $_SESSION["formValidation"][$this->name]=$this->variable;
                }else{
                    $this->variable="";
                    $this->message=$this->analisis($error)?"esEntero Error":$error;
                    $this->result=false;
                    
                    $_SESSION["formValidation"][$this->name]=$this->result;
                }
            }else{
                $this->variable="";
                $this->message=$this->analisis($error)?"esEntero Error":$error;
                $this->result=false;
                
                $_SESSION["formValidation"][$this->name]=$this->result;
            }
            $_SESSION["formValidation"][$this->name."Men"]=$this->message;
        }
        return $this;
    }

    public function esDecimal($error=null,$message=null){
        if($this->result==true){
            if(false !== strpos($this->variable,".")){
                $double=doubleval($this->variable);
                if(is_double($double)){
                    $this->result=true;
                    $this->message=$this->analisis($message)?"validated":$message;
                    
                    $_SESSION["formValidation"][$this->name]=$this->variable;
                }else{
                    $this->variable="";
                    $this->message=$this->analisis($error)?"esDecimal Error":$error;
                    $this->result=false;
                    
                    $_SESSION["formValidation"][$this->name]=$this->result;
                }
            }else{
                $this->variable="";
                $this->message=$this->analisis($error)?"esDecimal Error":$error;
                $this->result=false;
                
                $_SESSION["formValidation"][$this->name]=$this->result; 
            }
            $_SESSION["formValidation"][$this->name."Men"]=$this->message;
        }
        return $this;
    }
    

    public function esCadena($only=null,$error=null,$message=null){
        if($this->result==true){
            if(is_string($this->variable)){
                $this->result=true;
                $this->message=$this->analisis($message)?"validated":$message;

                $_SESSION["formValidation"][$this->name]=$this->variable;
            }else{
                $this->variable="";
                $this->message=$this->analisis($error)?"esCadena Error":$error;
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
                $this->message=$this->analisis($message)?"validated":$message;
                
                $_SESSION["formValidation"][$this->name]=$this->variable;
            }else{
                $this->result=false;
                $this->variable="";
                $this->message=$this->analisis($error)?"igualA Error":$error;
                
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
                $this->message=$this->analisis($message)?"validated":$message;

                $_SESSION["formValidation"][$this->name]=$this->variable;
            }else{
                $this->result=false;
                $this->variable="";
                $this->message=$this->analisis($error)?"diferenteA Error":$error;

                $_SESSION["formValidation"][$this->name]=$this->result;
            }
            $_SESSION["formValidation"][$this->name."Men"]=$this->message;
        }
        return $this;
    }


    public function esEmail($error=null,$message=null){
        if($this->result==true){
            //strpos($this->variable,"@") && strpos($this->variable,".")
            if(filter_var($this->variable, FILTER_VALIDATE_EMAIL)){
            //if(false !== strpos($this->variable,"@") && false !== strpos($this->variable,".")){
                $this->result=true;
                $this->message=$this->analisis($message)?"validated":$message;
                
                $_SESSION["formValidation"][$this->name]=$this->variable;
            }else{
                $this->result=false;
                $this->variable="";
                $this->message=$this->analisis($error)?"esEmail Error":$error;

                $_SESSION["formValidation"][$this->name]=$this->result;
            }
            $_SESSION["formValidation"][$this->name."Men"]=$this->message;
        }
        return $this;
    }

    public function longitudMax($lon,$error=null,$message=null){
        if($this->result==true){
            if(strlen($this->variable)==$lon || strlen($this->variable)<=$lon){
                $this->result=true;
                $this->message=$this->analisis($message)?"validated":$message;

                $_SESSION["formValidation"][$this->name]=$this->variable;
            }else{
                $this->result=false;
                $this->variable="";
                $this->message=$this->analisis($error)?"longitudMax Error":$error;

                $_SESSION["formValidation"][$this->name]=$this->result;
            }
            $_SESSION["formValidation"][$this->name."Men"]=$this->message;
        }
        return $this;
    }
    
    public function longitudMin($lon,$error=null,$message=null){
        if($this->result==true){
            if(strlen($this->variable)==$lon || strlen($this->variable)>=$lon){
                $this->result=true;
                $this->message=$this->analisis($message)?"validated":$message;

                $_SESSION["formValidation"][$this->name]=$this->variable;
            }else{
                $this->result=false;
                $this->variable="";
                $this->message=$this->analisis($error)?"longitudMin Error":$error;

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
            $boolval=filter_var($bool, FILTER_VALIDATE_BOOLEAN);//PHP 5
            //if(is_bool($boolval)){
            if($boolval!==null){//PHP 5
                if($boolval){
                    $this->result=true;
                    $this->variable=$boolval;
                    $this->message=$this->analisis($message)?"validated TRUE":$message;
                    $this->name=$name;
        
                    $_SESSION["formValidation"][$this->name]=$this->result;
                }else{
                    $this->result=false;
                    $this->variable=$boolval;
                    $this->message=$this->analisis($error)?"validated FALSE":$error;
                    $this->name=$name;
        
                    $_SESSION["formValidation"][$this->name]=$this->result;
                }
            }else{
                $this->result=false;
                $this->message="esBoolean Error";
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


    public function esArray($name, $array, $error=null, $message=null){
        $this->name="";
        $this->variable="";
        $this->result="";
        $this->message="";

        if(is_array($array)){
            $this->result=true;
            $this->variable=$array;
            $this->message=$this->analisis($message)?"validated":$message;
            $this->name=$name;

            $_SESSION["formValidation"][$this->name]=$this->variable;
        }else{
            $this->result=false;
            $this->variable="";
            $this->message=$this->analisis($error)?"esArray error":$error;
            $this->name=$name;

            $_SESSION["formValidation"][$this->name]=$this->result;
        }
        $_SESSION["formValidation"][$this->name."Men"]=$this->message;
        return $this;
    }



    public static function create($name,$valor,$message=null){
        $_SESSION["formValidation"][$name]=$valor;
        if($message!=null){
            $_SESSION["formValidation"][$name."Men"]=$message;
        }
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

    public static function valor($name,$indice=null){
        if(isset($_SESSION["formValidation"][$name]) && $_SESSION["formValidation"][$name]!=false){
            if($indice!=null){
                return $_SESSION["formValidation"][$name][$indice];
            }else{
                return $_SESSION["formValidation"][$name];
            }
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
