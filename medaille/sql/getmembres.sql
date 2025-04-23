SELECT 
  liste_membre.np, 
  statut_membre.`Date début`, 
  statut_membre.`Date Fin`, 
  statut_membre.`N°statuts` 
FROM statut_membre
JOIN liste_membre 
  ON statut_membre.`N°membre` = liste_membre.id
GROUP BY 
  liste_membre.np, 
  statut_membre.`N°statuts`;
