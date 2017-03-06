<?php

if (!defined("_ECRIRE_INC_VERSION")) return;

// Se brancher sur le pipeline du noizetier pour configurer les blocs
// par défaut ou seront ajouté les pre_, post_
// Chaque insertions spécifiques peuvent ensuite êtres réalisé par les compositions de page
// avec par exemple les couples /aside/sommaire.html et /aside/sommaire.xml

function spipdist_noizetier_blocs_defaut($blocs) {
       $blocs = array (
            'header' => array(
				'nom' => _T('noizetier:nom_bloc_header'),
				'description' => _T('noizetier:description_bloc_header'),
				'icon' => 'bloc-contenu-24.png'
			),
			'nav' => array(
				'nom' => _T('noizetier:nom_bloc_navigation'),
				'description' => _T('noizetier:description_bloc_navigation'),
				'icon' => 'bloc-navigation-24.png'
				),
            'footer' => array(
				'nom' => _T('noizetier:nom_bloc_footer'),
				'description' => _T('noizetier:description_bloc_footer'),
				'icon' => 'bloc-extra-24.png'
			),
		);
       return $blocs;
}
// Innsserer les blocs déclarés
function spipdist_recuperer_fond($flux){
    // Le pipeline n'est utilisé que si le noiZetier est actif,
	if (defined('_DIR_PLUGIN_NOIZETIER')) {
		include_spip('inc/noizetier');
		$fond = $flux['args']['fond'];
		if(!is_array($fond))
			$bloc = substr($fond,0,strpos($fond,'/'));
		else
			$bloc = '';

		//$noizettier_blocs_default = noizetier_noizetier_blocs_defaut() ;
		// Si on est sur un bloc contenu, navigation ou extra, on ajoute les noisettes de la page par defaut
		// On ajoute également une ancre correspondant au nom du bloc
		if (in_array($bloc, array('header','nav','footer'))) {
			$contexte = $flux['data']['contexte'];
			$contexte['bloc'] = 'pre_'.$bloc;
			$contexte['type-page'] = 'defaut';
			$contexte['composition'] = '';
			if ($flux['args']['contexte']['voir']=='noisettes' && autoriser('configurer','noizetier'))
					$complements_pre = recuperer_fond('noizetier-generer-bloc-voir-noisettes',$contexte,array('raw'=>true));
				else
					$complements_pre = recuperer_fond('noizetier-generer-bloc',$contexte,array('raw'=>true));
			$contexte['bloc'] = 'post_'.$bloc;
			if ($flux['args']['contexte']['voir']=='noisettes' && autoriser('configurer','noizetier'))
					$complements_post = recuperer_fond('noizetier-generer-bloc-voir-noisettes',$contexte,array('raw'=>true));
				else
					$complements_post = recuperer_fond('noizetier-generer-bloc',$contexte,array('raw'=>true));
			$ancre = "<a name=\"$bloc\"></a>\n";
			$flux['data']['texte'] = $ancre.$complements_pre['texte'].$flux['data']['texte'].$complements_post['texte'];
		}
	}
	return $flux;
    
}



?>