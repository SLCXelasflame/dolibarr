UPDATE instrument
SET perso = :perso, N°membre = :Nmembre, N°Type_instrument = :NType_instrument, membre = :membre, N°série = :Nserie, marque = :marque, propriétaire = :proprietaire, Référence = :Reference, Remarques = :Remarques
WHERE ID = :rowid;
