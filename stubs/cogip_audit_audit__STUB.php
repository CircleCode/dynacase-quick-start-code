<?php
namespace Dcp\Family {
	/**   */
	class Cogip_audit_audit extends \COGIP\COGIP_AUDIT_AUDIT { const familyName="COGIP_AUDIT_AUDIT";}
}

namespace Dcp\AttributeIdentifiers {
	/**   */
	class Cogip_audit_audit extends Cogip_audit_base {
		/** [frame] Descriptif */
		const caa_f_desc='caa_f_desc';
		/** [text] Titre */
		const caa_titre='caa_titre';
		/** [date] Date de début */
		const caa_date_debut='caa_date_debut';
		/** [int] Durée */
		const caa_duree='caa_duree';
		/** [date] Date de fin */
		const caa_date_fin='caa_date_fin';
		/** [account] Site audité */
		const caa_site='caa_site';
		/** [docid("COGIP_AUDIT_REFERENTIEL")] Référentiel */
		const caa_ref='caa_ref';
		/** [longtext] Descriptif */
		const caa_desc='caa_desc';
		/** [frame] Auditeurs */
		const caa_f_auditeur='caa_f_auditeur';
		/** [account] Responsable d'audit */
		const caa_resp_audit='caa_resp_audit';
		/** [array] Auditeurs */
		const caa_a_auditeur='caa_a_auditeur';
		/** [account] Auditeur */
		const caa_auditeur_auditeur='caa_auditeur_auditeur';
		/** [tab] Constats */
		const caa_t_constat='caa_t_constat';
		/** [frame] Constats */
		const caa_f_constat='caa_f_constat';
		/** [array] Point fort */
		const caa_a_point_fort='caa_a_point_fort';
		/** [longtext] Description */
		const caa_point_fort_desc='caa_point_fort_desc';
		/** [array] Point faible */
		const caa_a_point_faible='caa_a_point_faible';
		/** [longtext] Description */
		const caa_point_faible_desc='caa_point_faible_desc';
		/** [array] Fiche de non conformités */
		const caa_a_fnc='caa_a_fnc';
		/** [docid("COGIP_AUDIT_FNC")] Fiche de non conformités */
		const caa_fnc_fnc='caa_fnc_fnc';
		/** [tab] Pièces jointes */
		const caa_t_pj='caa_t_pj';
		/** [frame] Pièces jointes */
		const caa_f_pj='caa_f_pj';
		/** [array] Pièces jointes */
		const caa_a_pj='caa_a_pj';
		/** [file] Pièce jointe */
		const caa_pj='caa_pj';
	}
}
