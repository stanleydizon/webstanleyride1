<?php
	/**
	* 
	*/
	class Stack
	{
		private $ctr;
		private $arr;
		function __construct()
		{
			$this->ctr=0;
			$this->arr = array();
		}
		public function push($item){
			$this->arr[$this->ctr++] = $item;
			//$this->ctr++;
		}
		public function isFind($item){
			for($i=0;$i<$this->ctr;$i++){
				if($this->arr[$i]==$item){
					return $item;
					break;
				}
			}
		}

		public function getItem($d){
		
	    $sec = 0;
	    $min=0;
	    $hr=0;
	    $day=0;
	    var_dump($d);
	        $count = time() - $d;
                for($a=0;$a<60;$a++){
                    if($count > 59){
                        $count -= 60;
                        $min++;
                        for($b=0;$b<60;$b++){
                        if($min > 59){
                          $count -= 60;
                          $min -= 60;
                          $hr++;
                          for($c=0;$c<24;$c++){
                            if($hr > 23){
                             $count -= 60;
                             $hr -= 24;
                             $day++;
                            }
                        	}
                        }   
                        }

                    }                                          
                }

                                             
            if($hr==0){
            	if($min==0)echo "<br>Delivered: ".$count." a sec ago";
                else if($min==1) echo "<br>Delivered: ".$min." min ago ";
                else echo "<br>Delivered: ".$min." mins ago ";
            }
            else{
            	if($day>0){
            		if($day==1)$days="day";else $days="days";
            		echo "<br>Delivered: ".$day." ".$days." ago & ".$hr." hrs ago";
            	}
            	else {
            		if($hr==1)$hrs="hr";else $hrs="hrs";
            		if($min==0)$min="";else if($min==1)$min=" & ".$min." min"; else $min=" & ".$min." mins";
            		echo "<br>Delivered: ".$hr." ".$hrs." ago ".$min;
            	}
            }
		}
		public function display(){
			var_dump($this->ctr);
			for($i=0;$i<$this->ctr;$i++){
				return $this->arr[$i];
			}
		}
		public function count(){return $this->ctr;}
	}
?>