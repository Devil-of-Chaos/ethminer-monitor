<?
$request_url = $_SERVER['REQUEST_URI'];

preg_match("/\/([a-z-_0-9]*)?(\.html)/", $request_url, $uri_parts);
if (isset($uri_parts[1]) && $uri_parts[1]) $content = $uri_parts[1];
else {
	preg_match("/\/([a-z-_0-9]*)\/(.*)/", $request_url, $uri_parts);
	if (isset($uri_parts[1]) && $uri_parts[1]) $content = $uri_parts[1];
	if (isset($uri_parts[2]) && $uri_parts[2]) $uri_content = $uri_parts[2];
}

if (isset($uri_content)){
	preg_match("/([A-Za-z-_0-9]*),([0-9]+)?(.html)/", $uri_content, $uri_id);
	if ($uri_id[2]) {
		$id = $uri_id[2];
	} else {
		preg_match("/([A-Za-z-_0-9]*),([0-9]+)\/(.*)/",$uri_content, $uri_typ);
		if ($uri_typ[2]) $id_typ = $uri_typ[2];
		if ($uri_typ[3]){
			preg_match("/([A-Za-z-_0-9]*),([0-9]+)\/(.*)/",$uri_typ[3], $uri_utyp);
			if ($uri_utyp[2]) $id_utyp = $uri_utyp[2];
			if ($uri_utyp[3]){
				preg_match("/([A-Za-z-_0-9]*),([0-9]+)\/(.*)/",$uri_utyp[3], $uri_uutyp);
				if ($uri_uutyp[2]) $id_uutyp = $uri_uutyp[2];
			}
		}
	}
}