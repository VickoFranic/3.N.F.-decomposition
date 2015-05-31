<?php

class SchemeController extends BaseController {

	public function details($shema_id) {

		$schema = DB::table('rel_schema')->where('ID', $shema_id)->first();
		$pk = DB::table('primary_key')->where('Schema_ID', $shema_id)->get();			// dohvati primarne kljuceve sheme
		$fd = DB::table('func_depend')->where('Schema_ID', $shema_id)->get();	// dohvati sve funkcijske ovisnosti za shemu

		return View::make('showSchemes')->with('id', $shema_id)->with('sch', $schema)->with('pk', $pk)->with('fd', $fd);
	}

	/********************************************* ALGORITAM DEKOMPOZICIJE ********************************************/
	public function decomposition($shema_id) {

		$schema = DB::table('rel_schema')->where('ID', $shema_id)->first();
		$pk = DB::table('primary_key')->where('Schema_ID', $shema_id)->get();			
		$fd = DB::table('func_depend')->where('Schema_ID', $shema_id)->get();

		$keysNum = count($pk);	// broj kljuceva za relacijsku shemu
		
		$FDcnt = 0;
		foreach ($fd as $row) {
			$test = false;
			$testCnt = 0;
			$tmpL = $row->fd_L;
			$tmpR = $row->fd_R;

			//	splitanje stringa na niz charova
			$in = $tmpL;
			$chars = str_split($in);
			sort($chars);

			/************************************* TRIVIJALNE OVISNOSTI ****************************/
			foreach ($chars as $char) {
				if(strstr($tmpR, $char)) {	
					$test = true;
				}
			}
			if ($test) {
				$testCnt++;
			}

			/************************************* DA LI JE LIJEVA STRANA NADKLJUC ? ****************************/
			for ($i=0; $i < $keysNum; $i++) {
				$cnt = 0;
				$k = $pk[$i]->pr_key;

				foreach ($chars as $char) {
					if (strstr($k, $char)) {
						$cnt++;
					}
				}
				if ($cnt == strlen($k)) {
					$test = true;
				}
			}
			if ($test) {
				$testCnt++;
			}


			// splitanje stringa na niz charova
			$in = $tmpR;
			$chars = str_split($in);
			sort($chars);

			/************************************* DA LI JE DESNA STRANA OSNOVNI ATRIBUT(dio kljuca) ? ****************************/
			for ($i=0; $i < $keysNum; $i++) {
				$cnt = 0;
				$k = $pk[$i]->pr_key;
				foreach ($chars as $char) {
					if (strstr($k, $char))
						$cnt++;
				}
				if ($cnt == count($chars)) {
					$test = true;
				}
			}

			if ($test) {
				$testCnt++;
			}
			
			if (($FDcnt == count($fd)) && ($testCnt > 0))
				return View::make('showSchemes')->with('test', true)->with('sch', $schema)->with('pk', $pk)->with('fd', $fd);

			$FDcnt++;
	}
			
				// ako nađe ovisnost koja ne zadovoljava uvjete, znaci da nije u 3.N.F. , radimo algoritam
				$dcmp = array();
				$dcmp[] = '';

				foreach ($fd as $row) {
					$tmp = $row->fd_L . $row->fd_R;

					//	Sortiranje stringa po abecedi radi provjere
					$in = $tmp;
					$chars = str_split($in);
					sort($chars);

					$charsLen = count($chars);	// broj znakova
					$cnt = 0;

					foreach ($dcmp as $key => $value) {	
						foreach ($chars as $char) {
							if(strstr($value, $char))
								$cnt++;
						}
					}
					$out = implode($chars);		// sortirani string
					if ($cnt < $charsLen)
						array_push($dcmp, $out);
				}


		/***************************************************** PROVJERAVAMO ZA KLJUC ****************************************/

				$kljuc = $pk[0]->pr_key;
				$len = strlen($kljuc);
				$flag = false;

				//	Sortiranje stringa po abecedi radi provjere
				$in = $kljuc;
				$chars = str_split($in);
				sort($chars);

				// Zadnja provjera je za kljuc
				foreach ($dcmp as $value) {
					$count = 0;
					foreach ($chars as $char) {
						if (strstr($value, $char))	// provjerava da li se char nalazi u stringu
							$count++;

					if ($count == $len) {
						$flag = true;
							return View::make('decomposition')->with('shema_id', $shema_id)->with('sch', $schema)->with('pk', $pk)->with('fd', $fd)->with('dcmp', $dcmp)->with('flag', $flag);
					}
				}
			}
			if (!$flag) {
				array_push($dcmp, $pk[0]->pr_key);
				return View::make('decomposition')->with('shema_id', $shema_id)->with('sch', $schema)->with('pk', $pk)->with('fd', $fd)->with('dcmp', $dcmp);
		}
	}

/********************************************* EDITIRANJE POSTOJECE SHEME *****************************************/
public function showAll() {

	$schema = DB::table('rel_schema')->get();
		$pk = DB::table('primary_key')->get();			// dohvati primarne kljuceve sheme
		$fd = DB::table('func_depend')->get();	// dohvati sve funkcijske ovisnosti za shemu

		return View::make('editSchemes')->with('sch', $schema)->with('pk', $pk)->with('fd', $fd);
	}

	public function editScheme($id) {

		$schema = DB::table('rel_schema')->where('ID', $id)->first();
		$pk = DB::table('primary_key')->where('Schema_ID', $id)->get();			// dohvati primarne kljuceve sheme
		$fd = DB::table('func_depend')->where('Schema_ID', $id)->get();	// dohvati sve funkcijske ovisnosti za shemu

		return View::make('editSchemes')->with('scheme_id', $id)->with('schema', $schema)->with('pk', $pk)->with('fd', $fd);
	}

	public function saveScheme($id) {

		$newSch = Input::get('schema');
		$cntKeys = Input::get('cntKeys');
		$cntDep = Input::get('cntDep');

		$keys = DB::table('primary_key')->where('Schema_ID', $id)->get();
		$deps = DB::table('func_depend')->where('Schema_ID', $id)->get();

		/**************************************** RELACIJSKA SHEMA *****************************/

		DB::table('rel_schema')->where('ID', $id)->update(array('rschema' => $newSch));


		/**************************************** KLJUCEVI *****************************/
		$NewKeys = array();
		for ($i=0; $i < $cntKeys; $i++)
			$NewKeys[] = Input::get('key' . $i);
		
		$i = 0;
		foreach ($keys as $key) {
			DB::table('primary_key')->where('ID', $key->ID)->update(array('pr_key' => $NewKeys[$i]));
			$i++;
		}

		/**************************************** FUNKCIJSKE OVISNOSTI *****************************/
		$NewDepsL = array();
		for ($i=0; $i < $cntDep; $i++)
			$NewDepsL[] = Input::get('depL' . $i);

		$NewDepsR = array();
		for ($i=0; $i < $cntDep; $i++)
			$NewDepsR[] = Input::get('depR' . $i);

		$i = 0;
		foreach ($deps as $dep) {
			DB::table('func_depend')->where('ID', $dep->ID)->update(array('fd_L' => $NewDepsL[$i]));
			DB::table('func_depend')->where('ID', $dep->ID)->update(array('fd_R' => $NewDepsR[$i]));
			$i++;
		}

		return View::make('hello')->with('saved', true);		
	}

	public function newScheme() {

		return View::make('newScheme');
	}

	public function saveNew() {

		$schema = Input::get('schema');
		$keyNum = Input::get('keyNum');
		$fdNum = Input::get('fdNum');

		return View::make('newScheme')->with('schema', $schema)->with('keyNum', $keyNum)->with('fdNum', $fdNum);
	}

	public function saveNewFinal() {

		$keyNum = Input::get('keyNum');
		$fdNum = Input::get('fdNum');

		$id = DB::table('rel_schema')->insertGetId(array('rschema' => Input::get('schema') ));

		for ($i=0; $i < $keyNum; $i++) { 
			DB::table('primary_key')->insert(array('Schema_ID' => $id, 'pr_key' => Input::get('key' . $i)));	
		}

		for ($i=0; $i < $fdNum; $i++) { 
			DB::table('func_depend')->insert(array('Schema_ID' => $id, 'fd_L' => Input::get('depL' . $i), 'fd_R' => Input::get('depR' . $i)));
		}
		return View::make('hello')->with('new', true);
	}
}