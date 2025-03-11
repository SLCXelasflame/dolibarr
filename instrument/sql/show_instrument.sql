SELECT
    i.ID,
    i.perso,
    i.N°membre,
    ti.type_instrument,
    i.membre,
    i.N°série,
    i.marque,
    i.propriétaire,
    i.Référence,
    i.Remarques
FROM
    instrument i
INNER JOIN
    type_instrument ti
ON
    i.N°Type_instrument = ti.N°;