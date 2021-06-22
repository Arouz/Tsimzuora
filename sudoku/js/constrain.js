// Matrices des possibilités

// 1 - 2 - 3 - 4 - 5 - 6 - 7 - 8 - 9 - L - C - G
const Tp = [
    [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
    [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0],
    [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 2, 0],
    [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 3, 1],
    [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 4, 1],
    [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 5, 1],
    [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 6, 2],
    [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 7, 2],
    [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 8, 2],
    [0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0],
    [0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 1, 0],
    [0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 2, 0],
    [0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 3, 1],
    [0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 4, 1],
    [0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 5, 1],
    [0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 6, 2],
    [0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 7, 2],
    [0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 8, 2],
    [0, 0, 0, 0, 0, 0, 0, 0, 0, 2, 0, 0],
    [0, 0, 0, 0, 0, 0, 0, 0, 0, 2, 1, 0],
    [0, 0, 0, 0, 0, 0, 0, 0, 0, 2, 2, 0],
    [0, 0, 0, 0, 0, 0, 0, 0, 0, 2, 3, 1],
    [0, 0, 0, 0, 0, 0, 0, 0, 0, 2, 4, 1],
    [0, 0, 0, 0, 0, 0, 0, 0, 0, 2, 5, 1],
    [0, 0, 0, 0, 0, 0, 0, 0, 0, 2, 6, 2],
    [0, 0, 0, 0, 0, 0, 0, 0, 0, 2, 7, 2],
    [0, 0, 0, 0, 0, 0, 0, 0, 0, 2, 8, 2],
    [0, 0, 0, 0, 0, 0, 0, 0, 0, 3, 0, 3],
    [0, 0, 0, 0, 0, 0, 0, 0, 0, 3, 1, 3],
    [0, 0, 0, 0, 0, 0, 0, 0, 0, 3, 2, 3],
    [0, 0, 0, 0, 0, 0, 0, 0, 0, 3, 3, 4],
    [0, 0, 0, 0, 0, 0, 0, 0, 0, 3, 4, 4],
    [0, 0, 0, 0, 0, 0, 0, 0, 0, 3, 5, 4],
    [0, 0, 0, 0, 0, 0, 0, 0, 0, 3, 6, 5],
    [0, 0, 0, 0, 0, 0, 0, 0, 0, 3, 7, 5],
    [0, 0, 0, 0, 0, 0, 0, 0, 0, 3, 8, 5],
    [0, 0, 0, 0, 0, 0, 0, 0, 0, 4, 0, 3],
    [0, 0, 0, 0, 0, 0, 0, 0, 0, 4, 1, 3],
    [0, 0, 0, 0, 0, 0, 0, 0, 0, 4, 2, 3],
    [0, 0, 0, 0, 0, 0, 0, 0, 0, 4, 3, 4],
    [0, 0, 0, 0, 0, 0, 0, 0, 0, 4, 4, 4],
    [0, 0, 0, 0, 0, 0, 0, 0, 0, 4, 5, 4],
    [0, 0, 0, 0, 0, 0, 0, 0, 0, 4, 6, 5],
    [0, 0, 0, 0, 0, 0, 0, 0, 0, 4, 7, 5],
    [0, 0, 0, 0, 0, 0, 0, 0, 0, 4, 8, 5],
    [0, 0, 0, 0, 0, 0, 0, 0, 0, 5, 0, 3],
    [0, 0, 0, 0, 0, 0, 0, 0, 0, 5, 1, 3],
    [0, 0, 0, 0, 0, 0, 0, 0, 0, 5, 2, 3],
    [0, 0, 0, 0, 0, 0, 0, 0, 0, 5, 3, 4],
    [0, 0, 0, 0, 0, 0, 0, 0, 0, 5, 4, 4],
    [0, 0, 0, 0, 0, 0, 0, 0, 0, 5, 5, 4],
    [0, 0, 0, 0, 0, 0, 0, 0, 0, 5, 6, 5],
    [0, 0, 0, 0, 0, 0, 0, 0, 0, 5, 7, 5],
    [0, 0, 0, 0, 0, 0, 0, 0, 0, 5, 8, 5],
    [0, 0, 0, 0, 0, 0, 0, 0, 0, 6, 0, 6],
    [0, 0, 0, 0, 0, 0, 0, 0, 0, 6, 1, 6],
    [0, 0, 0, 0, 0, 0, 0, 0, 0, 6, 2, 6],
    [0, 0, 0, 0, 0, 0, 0, 0, 0, 6, 3, 7],
    [0, 0, 0, 0, 0, 0, 0, 0, 0, 6, 4, 7],
    [0, 0, 0, 0, 0, 0, 0, 0, 0, 6, 5, 7],
    [0, 0, 0, 0, 0, 0, 0, 0, 0, 6, 6, 8],
    [0, 0, 0, 0, 0, 0, 0, 0, 0, 6, 7, 8],
    [0, 0, 0, 0, 0, 0, 0, 0, 0, 6, 8, 8],
    [0, 0, 0, 0, 0, 0, 0, 0, 0, 7, 0, 6],
    [0, 0, 0, 0, 0, 0, 0, 0, 0, 7, 1, 6],
    [0, 0, 0, 0, 0, 0, 0, 0, 0, 7, 2, 6],
    [0, 0, 0, 0, 0, 0, 0, 0, 0, 7, 3, 7],
    [0, 0, 0, 0, 0, 0, 0, 0, 0, 7, 4, 7],
    [0, 0, 0, 0, 0, 0, 0, 0, 0, 7, 5, 7],
    [0, 0, 0, 0, 0, 0, 0, 0, 0, 7, 6, 8],
    [0, 0, 0, 0, 0, 0, 0, 0, 0, 7, 7, 8],
    [0, 0, 0, 0, 0, 0, 0, 0, 0, 7, 8, 8],
    [0, 0, 0, 0, 0, 0, 0, 0, 0, 8, 0, 6],
    [0, 0, 0, 0, 0, 0, 0, 0, 0, 8, 1, 6],
    [0, 0, 0, 0, 0, 0, 0, 0, 0, 8, 2, 6],
    [0, 0, 0, 0, 0, 0, 0, 0, 0, 8, 3, 7],
    [0, 0, 0, 0, 0, 0, 0, 0, 0, 8, 4, 7],
    [0, 0, 0, 0, 0, 0, 0, 0, 0, 8, 5, 7],
    [0, 0, 0, 0, 0, 0, 0, 0, 0, 8, 6, 8],
    [0, 0, 0, 0, 0, 0, 0, 0, 0, 8, 7, 8],
    [0, 0, 0, 0, 0, 0, 0, 0, 0, 8, 8, 8]
];

// Chaque ligne correspond à un groupe 
const Grp = [
    [0, 1, 2, 9, 10, 11, 18, 19, 20],
    [3, 4, 5, 12, 13, 14, 21, 22, 23],
    [6, 7, 8, 15, 16, 17, 24, 25, 26],
    [27, 28, 29, 36, 37, 38, 45, 46, 47],
    [30, 31, 32, 39, 40, 41, 48, 49, 50],
    [33, 34, 35, 42, 43, 44, 51, 52, 53],
    [54, 55, 56, 63, 64, 65, 72, 73, 74],
    [57, 58, 59, 66, 67, 68, 75, 76, 77],
    [60, 61, 62, 69, 70, 71, 78, 79, 80]
];
// Tableau Map
const GrPs = [
    [0, 1, 2, 3, 4, 5, 6, 7, 8],
    [9, 10, 11, 12, 13, 14, 15, 16, 17],
    [18, 19, 20, 21, 22, 23, 24, 25, 26],
    [27, 28, 29, 30, 31, 32, 33, 34, 35],
    [36, 37, 38, 39, 40, 41, 42, 43, 44],
    [45, 46, 47, 48, 49, 50, 51, 52, 53],
    [54, 55, 56, 57, 58, 59, 60, 61, 62],
    [63, 64, 65, 66, 67, 68, 69, 70, 71],
    [72, 73, 74, 75, 76, 77, 78, 79, 80]
];




/////////////////////////////////////////////////////////////
///////////////                               ///////////////
/////////////////////////////////////////////////////////////

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

/////////////////////////////////////////////////////////////
///////////////                               ///////////////
/////////////////////////////////////////////////////////////

// Case à solution unique // Célibataires nus
function CSU(Grille) {
    let NbP = 0;
    let LbN = 0;
    let CSU_ = false;
    for (let i = 0; i < Tp.length; i++) {
        for (let j = 0; j < 9; j++) {
            if (Tp[i][j] != 0) {
                NbP++;
                LbN = Tp[i][j];
            }
        }
        if (NbP == 1) {
            Grille[Tp[i][9]][Tp[i][10]] = LbN;
            Tp[i][LbN - 1] = 0;
            MaJAll(i, LbN - 1);
            CSU_ = true;
        }
        NbP = 0;
        LbN = 0;
    }
    ReplaceT(Grille);
    return CSU_;
}

/////////////////////////////////////////////////////////////
///////////////                               ///////////////
/////////////////////////////////////////////////////////////

// Célibataires cachés
function CbtC(Grille) {
    let CbtC_ = false;
    let SimG = [0, 0, 0];

    for (let i = 0; i < 9; i++) {
        for (let j = 0; j < 9; j++) {
            for (let k = 0; k < 9; k++) {
                if (Tp[Grp[i][k]][j] != 0) {
                    SimG[0] += 1;
                    SimG[1] = (j + 1);
                    SimG[2] = Grp[i][k];
                }
                if (SimG[0] > 1) {
                    break;
                }
            }
            if (SimG[0] == 1) {
                Grille[Math.trunc(SimG[2] / 9)][SimG[2] % 9] = SimG[1];
                MaJAll(SimG[2], (SimG[1] - 1));
                CbtC_ = true;
            }
            for (let l = 0; l < 3; l++) {
                SimG[l] = 0;
            }
        }
    }
    ReplaceT(Grille);
    return CbtC_;
}

/////////////////////////////////////////////////////////////
///////////////                               ///////////////
/////////////////////////////////////////////////////////////


// Function  de MaJ 
function MaJAll(Pos, LbN) {
    MaJLigne(Tp[Pos][9], LbN);
    MaJColonne(Tp[Pos][10], LbN);
    MaJGroupe(Tp[Pos][11], LbN);
    MaJCase(Pos);
}

function MaJLigne(l, n) {
    for (let li = 0; li < 9; li++)
        Tp[GrPs[l][li]][n] = 0;
}

function MaJColonne(c, n) {
    for (let ci = 0; ci < 9; ci++)
        Tp[GrPs[ci][c]][n] = 0;
}

function MaJGroupe(g, n) {
    for (let gi = 0; gi < 9; gi++)
        Tp[Grp[g][gi]][n] = 0;
}

function MaJCase(Pos) {
    for (let c = 0; c < 9; c++)
        Tp[Pos][c] = 0;
}


/////////////////////////////////////////////////////////////
///////////////                               ///////////////
/////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////
///////////////                               ///////////////
/////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////
///////////////                               ///////////////
/////////////////////////////////////////////////////////////


// Function Main
function APxC(Grille) {
    PxC(0, Grille);
}

function ResoudreCSTN(Grille) {
    // Créer la liste des possible pour chaque case
    PxC(0, Grille);
    // Boucle tant que des cases sont solutionées
    do {
        // Traque les nakeds twins et MAJ la liste des possibles
        Twin();
        CbtC(Grille);
        CSU(Grille);
    } while (CSU(Grille) || CbtC(Grille))
    // Vérifie si la grille est terminé ou non et determine la validité de celle ci 
    if (grilleTermine(Grille)) {
        ReplaceT(Grille);
        return Grille;
    } else 
        return false;
        /* console.log('La grille est incomplete !'); */
}


/////////////////////////////////////////////////////////////
///////////////                               ///////////////
/////////////////////////////////////////////////////////////
// Technique des segments 1 


// Quand dans un carré, un chiffre n'est possible que sur un segment, alors le candidat peut être exclu de cette colonne/ligne dans les autres carrés.
function CheckSegment1() {
    let nboccrL = [0, 0],
        nboccrC = [0, 0];
    // Les 3 segments ligne d'une case
    let pSL1 = [0, 0, 0, 0, 0, 0, 0, 0, 0],
        pSL2 = [0, 0, 0, 0, 0, 0, 0, 0, 0],
        pSL3 = [0, 0, 0, 0, 0, 0, 0, 0, 0];
    // Les 3 segments colonne d'une case
    let pSC1 = [0, 0, 0, 0, 0, 0, 0, 0, 0],
        pSC2 = [0, 0, 0, 0, 0, 0, 0, 0, 0],
        pSC3 = [0, 0, 0, 0, 0, 0, 0, 0, 0];

    for (let l = 0; l < 9; l++) {
        // Eventail des possibles : Segment de ligne
        for (let k = 0; k < 3; k++) {
            for (let i = 0; i < 9; i++) {
                if (Tp[Grp[l][k]][i] != 0) pSL1[i] = Tp[Grp[l][k]][i];
                if (Tp[Grp[l][k + 3]][i] != 0) pSL2[i] = Tp[Grp[l][k + 3]][i];
                if (Tp[Grp[l][k + 6]][i] != 0) pSL3[i] = Tp[Grp[l][k + 6]][i];
            }
        }

        // Eventail des possibles : Segment de colonne
        for (let k = 0; k < 9; k += 3) {
            for (let i = 0; i < 9; i++) {
                if (Tp[Grp[l][k]][i] != 0) pSC1[i] = Tp[Grp[l][k]][i];
                if (Tp[Grp[l][k + 1]][i] != 0) pSC2[i] = Tp[Grp[l][k + 1]][i];
                if (Tp[Grp[l][k + 2]][i] != 0) pSC3[i] = Tp[Grp[l][k + 2]][i];
            }
        }

        //console.log('Groupe : ' + (l + 1));
        //console.log('L = ' + pSL1 + ' ' + pSL2 + ' ' + pSL3);
        //console.log('C = ' + pSC1 + ' ' + pSC2 + ' ' + pSC3); 

        // Comparer chacun des segments par categories entre eux
        for (let k = 0; k < 9; k++) {
            if (pSL1.indexOf(k + 1) >= 0) {
                nboccrL[0]++;
                nboccrL[1] = 0;
            }
            if (pSL2.indexOf(k + 1) >= 0) {
                nboccrL[0]++;
                nboccrL[1] = 1;
            }
            if (pSL3.indexOf(k + 1) >= 0) {
                nboccrL[0]++;
                nboccrL[1] = 2;
            }

            if (nboccrL[0] == 1) {
                // retire k+1 des choix pour le reste de la ligne
                // Si la ligne concernée fait parti des groupe compris entre 1 et 3 
                for (let i = 0; i < 9; i++) {
                    // Si il s'agit du groupe 1 alors modifier que la parti des groupes 2 et 3 de la ligne
                    if (l == 0)
                        if (i > 2)
                            Tp[GrPs[(nboccrL[1])][i]][k] = 0;
                    // Si il s'agit du groupe 2 alors modifier que la parti des groupes 1 et 3 de la ligne
                    if (l == 1)
                        if (i < 3 && i > 5)
                            Tp[GrPs[(nboccrL[1])][i]][k] = 0;
                    // Si il s'agit du groupe 3 alors modifier que la parti des groupes 1 et 2 de la ligne
                    if (l == 2)
                        if (i < 6)
                            Tp[GrPs[(nboccrL[1])][i]][k] = 0;
                    // Si la ligne concernée fait parti des groupe compris entre 4 et 6 
                    if (l == 3)
                        if (i > 2)
                            Tp[GrPs[(nboccrL[1] + 3)][i]][k] = 0;
                    if (l == 4)
                        if (i < 3 && i > 5)
                            Tp[GrPs[(nboccrL[1] + 3)][i]][k] = 0;
                    if (l == 5)
                        if (i < 6)
                            Tp[GrPs[(nboccrL[1] + 3)][i]][k] = 0;
                    // Si la ligne concernée fait parti des groupe compris entre 7 et 9 
                    if (l == 6)
                        if (i > 2)
                            Tp[GrPs[(nboccrL[1] + 6)][i]][k] = 0;
                    if (l == 7)
                        if (i < 3 && i > 5)
                            Tp[GrPs[(nboccrL[1] + 6)][i]][k] = 0;
                    if (l == 8)
                        if (i < 6)
                            Tp[GrPs[(nboccrL[1] + 6)][i]][k] = 0;
                }
                //console.log((k + 1) + " n'est possible que dans ... L" + nboccrL[1])
            }
            nboccrL[0] = 0;

            if (pSC1.indexOf(k + 1) >= 0) {
                nboccrC[0]++;
                nboccrC[1] = 0;
            }
            if (pSC2.indexOf(k + 1) >= 0) {
                nboccrC[0]++;
                nboccrC[1] = 1;
            }
            if (pSC3.indexOf(k + 1) >= 0) {
                nboccrC[0]++;
                nboccrC[1] = 2;
            }
            if (nboccrC[0] == 1) {
                // retire k+1 des choix pour le reste de la Colonne
                //console.log((k + 1) + " n'est possible que dans ... C" + nboccrC[1])
                for (let i = 0; i < 9; i++) {
                    // Si il s'agit du groupe 1 alors modifier que la parti des groupes 3 et 6 de la colonne
                    if (l == 0)
                        if (i > 2)
                            Tp[GrPs[i][(nboccrC[1])]][k] = 0;
                    // Si il s'agit du groupe 3 alors modifier que la parti des groupes 1 et 6 de la colonne
                    if (l == 3)
                        if (i < 3 && i > 5)
                            Tp[GrPs[i][(nboccrC[1])]][k] = 0;
                    // Si il s'agit du groupe 6 alors modifier que la parti des groupes 1 et 3 de la colonne
                    if (l == 6)
                        if (i < 6)
                            Tp[GrPs[i][(nboccrC[1])]][k] = 0;

                    if (l == 1)
                        if (i > 2)
                            Tp[GrPs[i][(nboccrC[1] + 3)]][k] = 0;
                    if (l == 4)
                        if (i < 3 && i > 5)
                            Tp[GrPs[i][(nboccrC[1] + 3)]][k] = 0;
                    if (l == 7)
                        if (i < 6)
                            Tp[GrPs[i][(nboccrC[1] + 3)]][k] = 0;

                    if (l == 2)
                        if (i > 2)
                            Tp[GrPs[i][(nboccrC[1] + 6)]][k] = 0;
                    if (l == 5)
                        if (i < 3 && i > 5)
                            Tp[GrPs[i][(nboccrC[1] + 6)]][k] = 0;
                    if (l == 8)
                        if (i < 6)
                            Tp[GrPs[i][(nboccrC[1] + 6)]][k] = 0;
                }
            }
            nboccrC[0] = 0;
        }
        for (let g = 0; g < 9; g++) {
            pSC1[g] = 0;
            pSC2[g] = 0;
            pSC3[g] = 0;
            pSL1[g] = 0;
            pSL2[g] = 0;
            pSL3[g] = 0;
        }
    }
}

// Segment 2
// Quand dans une ligne/colonne un seul carré peut contenir un chiffre, ce chiffre peut être exclu des autres cases de ce carré.
function CheckSegment2() {
    let SLp1 = [0, 0, 0, 0, 0, 0, 0, 0, 0],
        SLp2 = [0, 0, 0, 0, 0, 0, 0, 0, 0],
        SLp3 = [0, 0, 0, 0, 0, 0, 0, 0, 0];

    let SCp1 = [0, 0, 0, 0, 0, 0, 0, 0, 0],
        SCp2 = [0, 0, 0, 0, 0, 0, 0, 0, 0],
        SCp3 = [0, 0, 0, 0, 0, 0, 0, 0, 0];

    let nboccL = [0, 0],
        nboccC = [0, 0];

    for (let l = 0; l < 9; l++) {
        // Eventail des possibles : ligne / carré
        for (let k = 0; k < 3; k++) {
            for (let i = 0; i < 9; i++) {
                if (Tp[GrPs[l][k]][i] != 0) SLp1[i] = Tp[GrPs[l][k]][i];
                if (Tp[GrPs[l][k + 3]][i] != 0) SLp2[i] = Tp[GrPs[l][k + 3]][i];
                if (Tp[GrPs[l][k + 6]][i] != 0) SLp3[i] = Tp[GrPs[l][k + 6]][i];
            }
        }

        // Eventail des possibles : Segment de colonne
        for (let k = 0; k < 3; k++) {
            for (let i = 0; i < 9; i++) {
                if (Tp[GrPs[k][l]][i] != 0) SCp1[i] = Tp[GrPs[k][l]][i];
                if (Tp[GrPs[k + 3][l]][i] != 0) SCp2[i] = Tp[GrPs[k + 3][l]][i];
                if (Tp[GrPs[k + 6][l]][i] != 0) SCp3[i] = Tp[GrPs[k + 6][l]][i];
            }
        }

        /*      
        console.log('----------------------------------------------');
        console.log('L' + (l+1) + ' = ' + SLp1 + ' ' + SLp2 + ' ' + SLp3);
        console.log('C' + (l+1) + ' = ' + SCp1 + ' ' + SCp2 + ' ' + SCp3);
        console.log('----------------------------------------------'); 
        */

        for (k = 0; k < 9; k++) {
            // Chaque segment ligne
            if (SLp1.indexOf(k + 1) >= 0) {
                nboccL[0]++;
                nboccL[1] = 0;
            }
            if (SLp2.indexOf(k + 1) >= 0) {
                nboccL[0]++;
                nboccL[1] = 1;
            }
            if (SLp3.indexOf(k + 1) >= 0) {
                nboccL[0]++;
                nboccL[1] = 2;
            }

            if (nboccL[0] == 1) {
                //console.log((k + 1) + " n'est possible que dans ... L" + (l+1) +  ', Segment : ' + (nboccL[1]))
                // Boucle pour retirer les propositions inutiles
                for (let i = 0; i < 9; i++) {
                    // Si ligne = 0
                    if (l == 0)
                        // Alors retirer que les 6 derniers chiffre du groupe
                        if (i > 2)
                            Tp[Grp[nboccL[1]][i]][k] = 0;
                    if (l == 1)
                        if (i < 3 && i > 5)
                            Tp[Grp[nboccL[1]][i]][k] = 0;
                    if (l == 2)
                        if (i < 6)
                            Tp[Grp[nboccL[1]][i]][k] = 0;

                    if (l == 3)
                        if (i > 2)
                            Tp[Grp[nboccL[1] + 3][i]][k] = 0;
                    if (l == 4)
                        if (i < 3 && i > 5)
                            Tp[Grp[nboccL[1] + 3][i]][k] = 0;
                    if (l == 5)
                        if (i < 6)
                            Tp[Grp[nboccL[1] + 3][i]][k] = 0;

                    if (l == 6)
                        if (i > 2)
                            Tp[Grp[nboccL[1] + 6][i]][k] = 0;
                    if (l == 7)
                        if (i < 3 && i > 5)
                            Tp[Grp[nboccL[1] + 6][i]][k] = 0;
                    if (l == 8)
                        if (i < 6)
                            Tp[Grp[nboccL[1] + 6][i]][k] = 0;
                }
            }
            nboccL[0] = 0;


            if (SCp1.indexOf(k + 1) >= 0) {
                nboccC[0]++;
                nboccC[1] = 0;
            }
            if (SCp2.indexOf(k + 1) >= 0) {
                nboccC[0]++;
                nboccC[1] = 3;
            }
            if (SCp3.indexOf(k + 1) >= 0) {
                nboccC[0]++;
                nboccC[1] = 6;
            }

            if (nboccC[0] == 1) {
                //console.log((k + 1) + " n'est possible que dans ... C" + (l+1) +  ', Segment : ' + nboccC[1])
                for (let i = 0; i < 9; i++) {
                    if (l == 0)
                        if (i != 0 && i != 3 && i != 6)
                            Tp[Grp[nboccC[1]][i]][k] = 0;
                    if (l == 1)
                        if (i != 1 && i != 4 && i != 7)
                            Tp[Grp[nboccC[1]][i]][k] = 0;
                    if (l == 2)
                        if (i != 2 && i != 5 && i != 8)
                            Tp[Grp[nboccC[1]][i]][k] = 0;

                    if (l == 3)
                        if (i != 0 && i != 3 && i != 6)
                            Tp[Grp[nboccC[1] + 1][i]][k] = 0;
                    if (l == 4)
                        if (i != 1 && i != 4 && i != 7)
                            Tp[Grp[nboccC[1] + 1][i]][k] = 0;
                    if (l == 5)
                        if (i != 2 && i != 5 && i != 8)
                            Tp[Grp[nboccC[1] + 1][i]][k] = 0;

                    if (l == 6)
                        if (i != 0 && i != 3 && i != 6)
                            Tp[Grp[nboccC[1] + 2][i]][k] = 0;
                    if (l == 7)
                        if (i != 1 && i != 4 && i != 7)
                            Tp[Grp[nboccC[1] + 2][i]][k] = 0;
                    if (l == 8)
                        if (i != 2 && i != 5 && i != 8)
                            Tp[Grp[nboccC[1] + 2][i]][k] = 0;
                }
            }
            nboccC[0] = 0;
        }
        for (let g = 0; g < 9; g++) {
            SLp1[g] = 0;
            SLp2[g] = 0;
            SLp3[g] = 0;
            SCp1[g] = 0;
            SCp2[g] = 0;
            SCp3[g] = 0;
        }
    }
}

/////////////////////////////////////////////////////////////
///////////////                               ///////////////
/////////////////////////////////////////////////////////////
// Technique des pares nues 

function Twin() {
    let StriLtwin = '';
    let ArrLigneTwin = [null, null, null, null, null, null, null, null, null];
    let StriCtwin = '';
    let ArrColonneTwin = [null, null, null, null, null, null, null, null, null];
    let StriGtwin = '';
    let ArrGroupeTwin = [null, null, null, null, null, null, null, null, null];

    for (let i = 0; i < 9; i++) {
        for (let j = 0; j < 9; j++) {
            for (let k = 0; k < 9; k++) {
                // L
                if (Tp[GrPs[i][j]][k] != 0) {
                    StriLtwin += k.toString();
                }
                // C
                if (Tp[GrPs[j][i]][k] != 0) {
                    StriCtwin += k.toString();
                }
                // G
                if (Tp[Grp[i][j]][k] != 0) {
                    StriGtwin += k.toString();
                }
            }
            // L
            if (StriLtwin.length == 2)
                ArrLigneTwin[j] = StriLtwin;
            // C
            if (StriCtwin.length == 2)
                ArrColonneTwin[j] = StriCtwin;
            // G
            if (StriGtwin.length == 2)
                ArrGroupeTwin[j] = StriGtwin;

            StriGtwin = '';
            StriLtwin = '';
            StriCtwin = '';
        }
        //console.log(ArrLigneTwin);
        // L
        ComparaisonArray(ArrLigneTwin, 1, i);
        // C
        ComparaisonArray(ArrColonneTwin, 2, i);
        // G
        ComparaisonArray(ArrGroupeTwin, 3, i);
    }
}

function ComparaisonArray(ArrayT, z, i) {
    for (let l = 0; l < ArrayT.length; l++) {
        for (let m = (l + 1); m < ArrayT.length; m++) {
            if (ArrayT[l] == ArrayT[m] && ArrayT[l] != null) {
                let c1 = parseInt(ArrayT[l].toString().substring(0, 1));
                let c2 = parseInt(ArrayT[l].toString().substring(1, 2));
                switch (z) {
                    case 1:
                        MaJTLigne(i, l, m, c1, c2);
                        break;
                    case 2:
                        MaJTColonne(i, l, m, c1, c2);
                        break;
                    case 3:
                        MaJTGroupe(i, l, m, c1, c2);
                        break;
                    default:
                        break;
                }
            }
        }
    }
    for (let n = 0; n < ArrayT.length; n++) {
        ArrayT[n] = null;
    }
}

function MaJTLigne(it, tw1, tw2, c1, c2) {
    for (let li = 0; li < 9; li++)
        if (li != tw1 && li != tw2) {
            Tp[GrPs[it][li]][c1] = 0;
            Tp[GrPs[it][li]][c2] = 0;
        }
}

function MaJTColonne(jt, tw1, tw2, c1, c2) {
    for (let ci = 0; ci < 9; ci++)
        if (ci != tw1 && ci != tw2) {
            Tp[GrPs[ci][jt]][c1] = 0;
            Tp[GrPs[ci][jt]][c2] = 0;
        }
}

function MaJTGroupe(gt, tw1, tw2, c1, c2) {
    for (let gi = 0; gi < 9; gi++)
        if (gi != tw1 && gi != tw2) {
            Tp[Grp[gt][gi]][c1] = 0;
            Tp[Grp[gt][gi]][c2] = 0;
        }
}


/////////////////////////////////////////////////////////////
///////////////                               ///////////////
/////////////////////////////////////////////////////////////
/* 3.1.2 Triplet et quatrain
Quand trois cases d'un groupe ne contiennent pas d'autres chiffres que trois candidats, ces chiffres peuvent être exclus des autres cases du groupe. Attention!
Il n'y a pas besoin que ces trois cases contiennent tous les chiffres du triplet, il faut seulement que ces cases soient les seules à avoir les trois chiffres en commun.  */

function Triplet() {
    let StriLTQ = '';
    let ArrLigneTQ = [null, null, null, null, null, null, null, null, null];

    for (let i = 0; i < 9; i++) {
        for (let j = 0; j < 9; j++) {
            for (let k = 0; k < 9; k++) {
                // L
                if (Tp[GrPs[i][j]][k] != 0) {
                    StriLTQ += k.toString();
                }
            }
            // L
            if (StriLTQ.length >= 2 && StriLTQ.length <= 4)
                ArrLigneTQ[j] = StriLTQ;

            StriLTQ = '';
        }

        console.log(ArrLigneTQ);

        // L
        ComparaisonArrayTQ(ArrLigneTQ, 1, i);
    }
}

function ComparaisonArrayTQ(ArrayT, z, i) {

    for (let n = 0; n < ArrayT.length; n++) {
        ArrayT[n] = null;
    }
}

/* 
// C
if (Tp[GrPs[j][i]][k] != 0) {
    StriCTQ += k.toString();
}
// G
if (Tp[Grp[i][j]][k] != 0) {
    StriGTQ += k.toString();
} */

/* 
// C
if (StriCTQ.length == 3)
    ArrColonneTQ[j] = parseInt(StriCTQ);
// G
if (StriGTQ.length == 3)
    ArrGroupeTQ[j] = parseInt(StriGTQ); 
*/

/*     
let StriCTQ = '';
let ArrColonneTQ = [0, 0, 0, 0, 0, 0, 0, 0, 0];
let StriGTQ = '';
let ArrGroupeTQ = [0, 0, 0, 0, 0, 0, 0, 0, 0]; 
*/

// C
//ComparaisonArrayTQ(ArrColonneTQ,2,i);
// G
//ComparaisonArrayTQ(ArrGroupeTQ,3,i);