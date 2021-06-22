// Remplissage du champ des possibles pour chaque case
function PxC(Position, Grille) {
    // Vérifie qu'on est dans les limites de la grille, si non alors stop
    if (Position == 81)
        return true;
    const i = Math.trunc(Position / 9);
    const j = Position % 9;
    // Si La case possede deja une assignation alors on passe à la case suivante
    if (Grille[i][j] != 0)
        return PxC(Position + 1, Grille);
    for (let k = 1; k <= 9; k++) {
        if (AbsLigne(i, Grille, k) && AbsColonne(j, Grille, k) && AbsGroupe(i, j, Grille, k)) {
            Tp[Position][(k - 1)] = k;
        }
    }
    PxC(Position + 1, Grille);
}