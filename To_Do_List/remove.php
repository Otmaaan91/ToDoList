<?php

// --------------------------------------------------------------------------------------
// DEPENDANCES
// --------------------------------------------------------------------------------------

include 'utilities.php';



// --------------------------------------------------------------------------------------
// FONCTIONS
// --------------------------------------------------------------------------------------

function removeTasks(array $allTasks, array $indexes)
{
    // Création d'un nouveau tableau de tâches.
	$tasks = array();

	// Parcours de la liste de tâches spécifiées.
	foreach($allTasks as $index => $taskData)
    {
        /*
         * Est-ce que l'indice de la tâche se trouve dans la liste des indices
         * de tâches qu'on ne doit pas conserver ?
         */
        if(in_array($index, $indexes) == false)
        {
            // Non, on conserve donc la tâche en la copiant dans notre nouveau tableau.
            array_push($tasks, $taskData);
        }
    }
	return $tasks;
}



// --------------------------------------------------------------------------------------
// CODE PRINCIPAL
// --------------------------------------------------------------------------------------

// Si aucune case à cocher n'est cochée, l'indice n'existera pas dans $_POST !
if(array_key_exists('indexes', $_POST) == true)
{
    // Chargement de toutes les tâches existantes.
    $allTasks = loadTasks();

    /*
     * Création d'une nouvelle liste de tâches ne comprenant que les tâches qui n'ont pas
     * été sélectionnées.
     */
    $tasks = removeTasks($allTasks, $_POST['indexes']);

    // Sauvegarde de la nouvelle liste de tâches (les tâches qui n'ont pas été cochées).
    saveTasks($tasks);
}

/*
 * Redirection vers la page d'accueil.
 */
header('Location: index.php');
exit();