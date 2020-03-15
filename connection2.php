<?php


	// on importe le fichier contenant les informations de connexion à la base de données
    include('bdd.php');


	// on vérifie que le visiteur a correctement saisi puis envoyé le formulaire
    if (isset($_POST['connexion']) && $_POST['connexion'] == 'Connexion') 
    {
    	if ((isset($_POST['login']) && !empty($_POST['login'])) && (isset($_POST['pwd']) && !empty($_POST['pwd']))) 
	    {

	    	$username = $_POST['login'];
	    	$password = $_POST['pwd'];

	    	$sql = "SELECT * FROM users WHERE username = ? ";
	    	$result = $bdd->prepare($sql);
		//passage de $username dans l'array pour validité
	    	$result->execute(array($username));
		//compte le nombre de résultats pour username
		$userExist = $result->rowCunt();

	    	if($userExist > 0)
	    	{
	    		$data = $result->fetchAll();
	    		if (password_verify($password, $data[0]["password"]))
	    		{
	    			echo "Connexion réussie.";
	    			$_SESSION['login'] = $username;
	    		}
	    	}
	    }
    }






?>
