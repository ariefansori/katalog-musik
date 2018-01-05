<?php

function getExtension ($mime_type){
	$extensions = array('audio/mpeg' => 'mp3',
						'audio/wav'  => 'wav',
						'audio/ogg'  => 'ogg'
						);
	return $extensions[$mime_type];
}

?>