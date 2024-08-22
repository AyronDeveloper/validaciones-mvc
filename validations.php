<?php
class Vali{
    private $name="";
    private $variable;
    private $result;
    private $message;

    private function analisis($analisis){
        $analisis=trim($analisis);
        if($analisis==null || $analisis==""){
            return true;
        }else{
            return false;
        }
    }


    //required
    public function vacio($name,$value,$error=null,$message=null){

        $this->name="";
        $this->variable="";
        $this->result="";
        $this->message="";

        $value=trim($value);
        if(!empty($value)){
            $this->result=true;
            $this->variable=$value;
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

    //isNumber
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

    //isInteger
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

    //isFloat
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
    
    //isString
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

    //equalTo
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

    //differentTo
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

    //isEmail
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

    //lenMax
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
    
    //lenMin
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


    public function uploadFile($name, $arrayFile, $error=null, $message=null){
        $this->name="";
        $this->variable="";
        $this->result="";
        $this->message="";

        
        $this->name=$name;

        if($arrayFile["error"]==0){
            $this->result=true;
            $this->variable=$arrayFile;
            $this->$message=$this->analisis($message)?"validated":$message;
            $_SESSION["formValidation"][$this->name]=$this->variable;
        }else{
            $this->result=false;
            $this->$message=$this->analisis($error)?"validated Error":$error;
            $_SESSION["formValidation"][$this->name]=$this->result;
        }
        $_SESSION["formValidation"][$this->name."Men"]=$this->message;

        return $this;

    }

    public function sizeFile(){

    }

    public function typeFile(){

    }

    //isBoolean
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

    //isArray
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


    //create
    public static function create($name,$valor,$message=null){
        $_SESSION["formValidation"][$name]=$valor;
        if($message!=null){
            $_SESSION["formValidation"][$name."Men"]=$message;
        }
    }



    public function results($value=null){
        if($value=="value"){
            return $this->variable;
        }else{
            return array("variable"=>$this->variable,"result"=>$this->result,"message"=>$this->message);
        }
    }


    //clear
    public static function limpiar(){
        unset($_SESSION["formValidation"]);
    }
    //clearSelect
    public static function limpiarSelect($name){
        unset($_SESSION["formValidation"][$name]);
        unset($_SESSION["formValidation"][$name."Men"]);
    }
    //clearExcep
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
    //value
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
