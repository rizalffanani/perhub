<?php
/*$page = $_GET["page"];
$perpage = 10;
$this->db->limit($perpage,($page-1)*$perpage);
$db = $this->db->get("kab");
foreach($db->result() as $res){
  $curl = curl_init();

  curl_setopt_array($curl, array(
    CURLOPT_URL => "https://pro.rajaongkir.com/api/subdistrict?city=".$res->rajaongkir,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "GET",
    CURLOPT_HTTPHEADER => array(
      "content-type: application/x-www-form-urlencoded",
      "key: 1cb6ca038ddb281f174dbc4264474df0"
    ),
  ));

  $response[] = curl_exec($curl);
  $idkab[] = $res->id;
  $err = curl_error($curl);

  curl_close($curl);

//  print_r($response);
//  exit;
}

//print_r($response);
//exit;

/*if ($err) {
  echo "cURL Error #:" . $err;
} else {
  //echo $response;
  $respon = json_decode($response);
  $respon = $respon->rajaongkir->results;
  //print_r($respon);* /
	for($i=0; $i<count($response); $i++){
    $respons = $response[$i];
    $respons = json_decode($respons);
		$respon = $respons->rajaongkir->results;
    for($a=0; $a<count($respon); $a++){
      //print_r($respon[$a]);
    /*  $idkab = $this->func->getKab($respon[$a]->city_id,"id","rajaongkir");
      $this->db->where("nama",$respon[$a]->subdistrict_name);
      $this->db->where("idkab",$idkab);
      if($this->db->update("kec",array("rajaongkir"=>$respon[$a]->subdistrict_id))){
        echo "Berhasil Update data: <b>".$respon[$a]->subdistrict_name." ID: ".$respon[$a]->subdistrict_id."</b><br/>";
      }else{
        echo "<span style='color:#cc0000;'>GAGAL! Update data: <b>".$respon[$a]->subdistrict_name." ID: ".$respon[$a]->subdistrict_id."</b></span><br/>";
      }* /
      $data = array(
        "idkab" => $idkab[$i],
        "nama" => $respon[$a]->subdistrict_name,
        "rajaongkir"  => $respon[$a]->subdistrict_id//,
        //"kodepos"  => $respon[$a]->postal_code
      );
      $this->db->insert("kec",$data);
      echo "inserted: <b>".$respon[$a]->subdistrict_name."</b><br/>";
    }
  }
		/*$this->db->where("nama",$respon[$i]->type ." ".$respon[$i]->city_name);
		if($this->db->update("kab",array("rajaongkir"=>$respon[$i]->city_id))){
			$id = $this->func->getKab($respon[$i]->city_id,"rajaongkir","rajaongkir");
			echo "berhasil update: ".$respon[$i]->city_name." - ".$respon[$i]->city_id."<br/>Hasil ID: ".$id."<br/>&nbsp;<br/>";
		}else{
			echo "<b>GAGAL</b> update: ".$respon[$i]->city." - ".$respon[$i]->city_id."<br/>&nbsp;<br/>";
		}
	}
}

$string='Phone 111 (111) 1112 to get this for 75% off 085691247751 off - Call Now. Offer open to 5pm only full price after 5.';
preg_match_all('@[^a-zA-Z]{7,}@is',$string,$matches);
$matches=$matches[0];
foreach ($matches AS $key=>$match) {
//$matches[$key]=preg_replace('@[^0-9]@s','',$match);
}
echo '<xmp>';
print_r($matches);
echo '</xmp>';*/

  $this->db->like("url","-");
  $db = $this->db->get("produk");
  foreach($db->result() as $r){
    $url = explode("-",$r->url);
    $url = implode("_",$url);
    $this->db->where("id",$r->id);
    $this->db->update("produk",array("url"=>$url));
  }
//  redirect("404_notfound");
?>
