<?php

use Illuminate\Database\Capsule\Manager as DB;
use Illuminate\Database\Eloquent\Model;

class Post extends Model {
 
    protected $table = 'vacancylowo';
    /* protected $fillable = [
        'id',
        'text'
    ]; */
	
	public function get_citytot(){
		/* select count(lokasi) as totcity, lokasi from vacancylowo group by lokasi order by totcity desc limit 12 */
		$result = DB::table("vacancylowo")
			->select("lokasi", DB::Raw("count(lokasi) as totcity"))
			->groupBy("lokasi")
			->orderBy("totcity", "desc")
			->limit(12)
			->get();
			
		return $result;
	}
	
	public function get_katot(){
		/* select count(kategori) as totkat, kategori from vacancylowo where kategori !='' group by kategori order by totkat desc limit 8 */
		$result = DB::table("vacancylowo")
			->select("kategori", DB::Raw("count(kategori) as totkat"))
			->where("kategori", "!=", "")
			->groupBy("kategori")
			->orderBy("totkat", "desc")
			->limit(12)
			->get();
			
		return $result;
	}
	
	public function get_city($city){
		
		/*
		 * select * from vacancylowo where lokasi like '$cityName';
		 */
		$city = str_replace("-", " ", $city);
		$city = ucwords($city);
		
		$result = DB::table("vacancylowo")
			->where("lokasi", "LIKE", "%".$city."%")			
			->orderBy("vacid", "desc")
			->limit(10)
			->get();
		return $result;
	}	
	
	public function get_detailJobs($postid){		
		$result = DB::table("vacancylowo")
			->where("vacid", "=", $postid)
			->get();
		return $result;
	}	
	
	public function get_category($name){
		
		/*
		 * select * from vacancylowo where lokasi like '$cityName';
		 */
		/* $name = str_replace("-", " ", $name);
		$name = ucwords($name); */
		
		if (strpos($name, 'sekuritas') !== false) {
			$name = str_replace("-sekuritas", "", $name);
		}
		
		if (strpos($name, 'operasional') !== false) {
			$name = str_replace("-operasional", "", $name);
		}
		
		if (strpos($name, 'human-resources') !== false) {
			$name = str_replace("-human-resources", "", $name);
		}
		
		// $lc = $this->listCategory();
		$lc = self::listCategory();
		foreach($lc as $c){
			// echo $c->kategori.'<br>';
			if($name === self::slugify($c->kategori)){
				$newName = $c->kategori;
			}
		}
		
		/* echo $name." = ".$newName;
		return; */
		
		$result = DB::table("vacancylowo")
			->where("kategori", "LIKE", "%".$newName."%")			
			->orderBy("vacid", "desc")
			->limit(10)
			->get();
			
		return $result;
	}
	
	public function listCategory(){
		/*
		 * Table: 1st_kategori
		 */
		 
		$result = DB::table('1st_kategori')->get();
		return $result;
	}
	
	public function toDebug($builder){
		
		$sql = $builder->toSql();
		foreach ( $builder->getBindings() as $binding ) {
			$value = is_numeric($binding) ? $binding : "'".$binding."'";
			$sql = preg_replace('/\?/', $value, $sql, 1);
		}
		return $sql;
	}
	
	public function slugify($text){
		$slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $text)));
		return $slug;
	}

}