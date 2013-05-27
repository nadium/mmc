<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>MeetMyCreature</title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
	<link rel="stylesheet" href="css/style.css">

</head>
<body>
	<h1>MeetMyCreature</h1>
	<h2>V1 Testing</h2>

	<div id="creature"> </div>

	<?php
		$keywords = array( "#mmc","#mmcphoto","#mmcmusic","#mmcfood");
		// On recherche les tweets avec #MeetMyCreature 
		for ($i=0; $i < count($keywords); $i++) {
		
		$keyword = $keywords[$i]; 
		
		//$keyword = #MeetMyCreature;  
		// On doit percent-encoder la recherche  
		 
		$prct_keyword = urlencode($keyword);  
		  
		// Chaine d'appel à l'API  
		$search_string = "http://search.twitter.com/search.json?q=".$prct_keyword."&rpp=100&include_entities=false&result_type=recent";  

		//Récupération du résultat final
		$json = file_get_contents($search_string);  
		$array = json_decode($json,true); 

		// Mot utilisé pour la recherche  
		$search_keyword = $array['query'];  

		$compteur=0;
		foreach($array['results'] as $result) {   
			$compteur++;
		          
		         // ID du tweet (format String)  
		    $tweet_id = $result['id_str'];  
		         // Texte du tweet, brut, sans code HTML pour les URLs  
		    $tweet_text = $result['text'];  
		         // Nom d'affichage de l'auteur du tweet  
		    $user_name = $result['from_user_name'];  
		         // Nom d'utilisateur de l'auteur du tweet  
		         // c'est-à-dire @User  
		    $user_username = $result['from_user']; 
		         // Date de création du tweet, à l'heure GMT  
		    $tweet_date = $result['created_at'];  
		         // ID utilisateur de l'auteur  
		    $user_id = $result['from_user_id_str']; 

		    echo $user_name.": "; 
		    echo $tweet_text."<br/>";       
		}
		echo "Nombre de Tweets:".$compteur."<br/><br/>";
		
		if ($compteur > 5) {?>
		 	<script type="text/javascript">
		 		document.getElementById('creature').className="change";
		 	</script>
	 	<?php }
	 	}//end for 
	?>

	


</body>
</html>