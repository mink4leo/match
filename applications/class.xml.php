<?php

class xml{

	var $dir;
	var $url;
	var $root;

	function xml(){
		global $config;
		$this->dir = $config['uploaddir'];
		$this->url = $config['url'];
		$this->root = $config['root'];
	}

	function cfile($path){
		$match = "pages/";
		$rep = "pages/video/";
		return str_replace($match, $rep, $path);
	}

	function read($subdir){
		$file = $this->cfile($this->root . $subdir);
		if(file_exists($file)){
			$content = simplexml_load_file($file);
			$data = array();
			$x = 0;
			for($i=0; $i<sizeof($content->imageList[0]->image); $i++){
				foreach($content->imageList[0]->image[$i]->attributes() AS $a => $b){
					//echo $a." = ".$b."<bR>";
					$data[$i][$a] = $b;
				}
				//echo"<hr>";
			}
			return $data;
		}else{
			return null;
		}
	}

	function getvdo($file){
		$file = '../'.$file;
		if(file_exists($file)){
			$content = simplexml_load_file($file);
			$data = "";
			foreach($content->videoProp[0]->children() AS $child){
				//echo $child->getName() ." = ". $child."<br>";
				if($child->getName() == "id"){
					$data = $child;
					break;
				}
			}
			return $data;
		}
	}

	function readall($file){
		if(file_exists($file)){
			$content = simplexml_load_file($file);
			$data = array();
			$i = 0;
			foreach($content->children() AS $child){
				//echo $child->getName() ." = ".$child."<bR>";
				if($child->getName() != "imageList"){
					$data[$i]['name'] = $child->getName();
					$data[$i]['val'] = $child;
					$i++;
				}
			}
			return $data;
		}
	}

	function readMenu($sub = null, $sub2 = null){
		$file = $this->root . 'menu.xml';
		if(file_exists($file)){
			$content = simplexml_load_file($file);
			$data = array();
			$x = 0;
			if($sub!=""){
				if($sub2!=""){
					for($i=0; $i<sizeof($content->menuList[0]->menu[intval($sub)]->menu2[intval($sub2)]->menu3); $i++){
						foreach($content->menuList[0]->menu[intval($sub)]->menu2[intval($sub2)]->menu3[$i]->attributes() AS $a => $b){
							//echo $a." = ".$b."<bR>";
							$data[$i][$a] = $b;
						}
						$data[$i]['bg'] = $this->getbg($data[$i]['xml']);
					}
				}else{
					for($i=0; $i<sizeof($content->menuList[0]->menu[intval($sub)]->menu2); $i++){
						foreach($content->menuList[0]->menu[intval($sub)]->menu2[$i]->attributes() AS $a => $b){
							//echo $a." = ".$b."<bR>";
							$data[$i][$a] = $b;
						}
						$data[$i]['bg'] = $this->getbg($data[$i]['xml']);
					}
				}
			}else{
				for($i=0; $i<sizeof($content->menuList[0]->menu); $i++){
					foreach($content->menuList[0]->menu[$i]->attributes() AS $a => $b){
						//echo $a." = ".$b."<bR>";
						$data[$i][$a] = $b;
					}
					//echo"<hr>";
				}
			}
			return $data;
		}else{
			return null;
		}
	}

	function getbg($dir){
		$dir = str_replace("/config.xml", "", $dir);
		$bgfile = $this->root . $dir . '/layer.xml';
		if(file_exists($bgfile)){
			$content = simplexml_load_file($bgfile);
			$data = array();
			foreach($content->layerList[0]->layer[0]->attributes() AS $a => $b){
				$data[$a] = $b;
			}
			return $data;
		}else{
			return null;
		}
	}

	function getpage($page){
		$file = $this->root . 'pages/' . $page . '/content.xml';
		if(file_exists($file)){
			$content = simplexml_load_file($file);
			$data = array();
			$i = 0;
			foreach($content->children() AS $child){
				$data[$child->getName()] = $child;
				/*$data[$i]['name'] = $child->getName();
				$data[$i]['val'] = $child;*/
				$i++;
			}

			$bgfile = $this->root . 'pages/' . $page . '/layer.xml';
			if(file_exists($bgfile)){
				$bgc = simplexml_load_file($bgfile);
				$bgd = array();
				foreach($bgc->layerList[0]->layer[0]->attributes() AS $a => $b){
					$bgd[$a] = $b;
				}
				$data['layer'] = $bgd;
			}

			$mapfile = $this->root . 'pages/' . $page . '/map.xml';
			if(file_exists($mapfile)){
				$mc = simplexml_load_file($mapfile);
				$md = array();
				foreach($mc->children() AS $child){
					if($child->getName() == "map"){
						$data[$child->getName()] = $child;
					}
				}
			}

			return $data;
		}
	}

	function getMenu(){
		$file = $this->root . 'menu.xml';
		if(file_exists($file)){
			$content = simplexml_load_file($file);
			$data = array();
			$i = 0;
			$needa = 0;
			foreach($content->config[0]->children() AS $child){
				$data[$i]['name'] = $child->getName();
				$data[$i]['val'] = $child;
				if($data[$i]['name'] == "menuColor"){
					$needa = 1;
				}
				if($needa == 1){
					$x = 0;
					foreach($content->config[0]->$data[$i]['name']->attributes() AS $a => $b){
						$data[$i]['attr'][$x]['name'] = $a;
						$data[$i]['attr'][$x]['val'] = $b;
						$x++;
					}
				}
				$i++;
			}
			return $data;
		}
	}

}

?>