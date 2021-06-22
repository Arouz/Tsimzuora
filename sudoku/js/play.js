// Determine si la grille est terminé ou non 
function grilleTermine(Grille) {
    for (let i = 0; i < 9; i++)
        for (let j = 0; j < 9; j++)
            if (Grille[i][j] == 0)
                return false;
    return true;
}

// Créer le tableau à partir d'une grid
function Tableau(Grille) {
    const Dtableau = document.getElementById('Tableau');
    for (let i = 0; i < 9; i++) {
        Dtableau.innerHTML += "<tr id='TR" + i + "'>";
        const Dtr = document.getElementById('TR' + i);
        for (let j = 0; j < 9; j++) {
            let X = parseInt(i.toString() + j.toString()) - i;
            if (Grille[i][j] == 0)

                if (i == 2 || i == 5) {
                    if (j == 2 || j == 5)
                        Dtr.innerHTML += "<td id='c" + X + "' class='grille droite bas'><div id='" + X + "' class='DivEdit' contenteditable='true'>" + '' + "</div></td>"
                    else 
                        Dtr.innerHTML += "<td id='c" + X + "' class='grille bas'><div id='" + X + "' class='DivEdit' contenteditable='true'>" + '' + "</div></td>"
                } else {
                    if (j == 2 || j == 5)
                        Dtr.innerHTML += "<td id='c" + X + "' class='grille droite'><div id='" + X + "' class='DivEdit' contenteditable='true'>" + '' + "</div></td>"
                    else
                        Dtr.innerHTML += "<td id='c" + X + "' class='grille'><div id='" + X + "' class='DivEdit' contenteditable='true'>" + '' + "</div></td>"
                }

            else
                if (i==2 ||  i==5){
                    if (j == 2 || j == 5)
                        Dtr.innerHTML += "<td id='c" + X + "' class='grille droite bas'><div id='" + X + "' class='DivNEdit'>" + Grille[i][j] + "</div></td>"
                    else
                        Dtr.innerHTML += "<td id='c" + X + "' class='grille bas'><div id='" + X + "' class='DivNEdit'>" + Grille[i][j] + "</div></td>"
                } else {
                    if (j == 2 || j == 5)
                        Dtr.innerHTML += "<td id='c" + X + "' class='grille droite'><div id='" + X + "' class='DivNEdit'>" + Grille[i][j] + "</div></td>"
                    else
                        Dtr.innerHTML += "<td id='c" + X + "' class='grille'><div id='" + X + "' class='DivNEdit'>" + Grille[i][j] + "</div></td>"
                }
        }
        Dtableau.innerHTML += "</tr>";
    }
};

function ReplaceT(Grille) {
    SupprTableau();
    Tableau(Grille);
}

function SupprTableau(){
    const Dtableau = document.getElementById('Tableau');
    Dtableau.innerHTML = '';
}

// Fonctions d'aléatoire 
function Aleatoire(min, max) {
    return Math.floor(Math.random() * (max - min + 1)) + min;
}

const GridV = [
    [0, 0, 0, 0, 0, 0, 0, 0, 0],
    [0, 0, 0, 0, 0, 0, 0, 0, 0],
    [0, 0, 0, 0, 0, 0, 0, 0, 0],
    [0, 0, 0, 0, 0, 0, 0, 0, 0],
    [0, 0, 0, 0, 0, 0, 0, 0, 0],
    [0, 0, 0, 0, 0, 0, 0, 0, 0],
    [0, 0, 0, 0, 0, 0, 0, 0, 0],
    [0, 0, 0, 0, 0, 0, 0, 0, 0],
    [0, 0, 0, 0, 0, 0, 0, 0, 0]
];

const GridF = [
    [0, 5, 0, 7, 2, 4, 3, 0, 0],
    [3, 7, 0, 0, 0, 1, 0, 2, 4],
    [9, 0, 2, 0, 0, 0, 5, 0, 0],
    [7, 0, 4, 2, 3, 6, 0, 8, 0],
    [0, 0, 0, 0, 0, 0, 0, 0, 0],
    [0, 3, 0, 9, 4, 7, 1, 0, 2],
    [0, 0, 3, 0, 0, 0, 6, 0, 8],
    [1, 9, 0, 6, 0, 0, 0, 4, 3],
    [0, 0, 7, 4, 5, 3, 0, 1, 0]
];

const GridM = [
    [0, 5, 7, 0, 9, 0, 0, 6, 4],
    [0, 0, 0, 3, 0, 0, 2, 9, 0],
    [1, 0, 9, 4, 6, 0, 7, 0, 5],
    [7, 0, 4, 2, 0, 0, 0, 0, 0],
    [0, 0, 0, 9, 0, 8, 0, 0, 0],
    [0, 0, 0, 0, 0, 4, 5, 0, 8],
    [8, 0, 1, 0, 4, 7, 6, 0, 9],
    [0, 4, 6, 0, 0, 9, 0, 0, 0],
    [9, 7, 0, 0, 8, 0, 1, 4, 0]
];

const GridD = [
    [4, 0, 0, 7, 0, 0, 5, 0, 0],
    [3, 0, 0, 8, 0, 0, 0, 0, 1],
    [7, 0, 0, 9, 0, 0, 0, 0, 8],
    [0, 6, 0, 0, 3, 0, 0, 1, 0],
    [0, 9, 0, 0, 7, 0, 0, 5, 0],
    [0, 8, 0, 0, 1, 0, 7, 9, 0],
    [0, 0, 2, 0, 0, 6, 9, 0, 0],
    [0, 0, 5, 0, 0, 0, 0, 3, 0],
    [0, 0, 0, 0, 0, 4, 2, 0, 0]
];

const GridTD = [
    [1, 0, 0, 5, 7, 0, 3, 0, 0],
    [0, 0, 0, 0, 0, 0, 5, 7, 0],
    [6, 0, 0, 0, 9, 0, 0, 0, 8],
    [0, 0, 0, 0, 0, 0, 0, 4, 1],
    [0, 0, 0, 6, 0, 3, 0, 0, 0],
    [7, 2, 8, 0, 0, 0, 0, 0, 0],
    [0, 9, 0, 2, 0, 6, 0, 0, 0],
    [0, 0, 0, 0, 0, 1, 2, 0, 3],
    [3, 5, 2, 0, 0, 0, 9, 0, 0]
];

const GridH = [
    [8, 0, 0, 0, 0, 0, 0, 0, 0],
    [0, 0, 3, 6, 0, 0, 0, 0, 0],
    [0, 7, 0, 0, 9, 0, 2, 0, 0],
    [0, 5, 0, 0, 0, 7, 0, 0, 0],
    [0, 0, 0, 0, 4, 5, 7, 0, 0],
    [0, 0, 0, 1, 0, 0, 0, 3, 0],
    [0, 0, 1, 0, 0, 0, 0, 6, 8],
    [0, 0, 8, 5, 0, 0, 0, 1, 0],
    [0, 9, 0, 0, 0, 0, 4, 0, 0]
];

const GridoD = [
    [0, 0, 0, 0, 0, 0, 0, 0, 0],
    [0, 0, 0, 0, 0, 3, 0, 8, 5],
    [0, 0, 1, 0, 2, 0, 0, 0, 0],
    [0, 0, 0, 5, 0, 7, 0, 0, 0],
    [0, 0, 4, 0, 0, 0, 1, 0, 0],
    [0, 9, 0, 0, 0, 0, 0, 0, 0],
    [5, 0, 0, 0, 0, 0, 0, 7, 3],
    [0, 0, 2, 0, 1, 0, 0, 0, 0],
    [0, 0, 0, 0, 4, 0, 0, 0, 9]
];


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

// Vérification par ligne
function AbsLigne(i, Grille, k) {
    if (Grille[i].indexOf(k) != -1)
        return false;
    return true;
}

// Vérification par colonne
function AbsColonne(j, Grille, k) {
    for (i = 0; i < 9; i++)
        if (Grille[i][j] == k)
            return false;
    return true;
}
// Vérification par groupe
function AbsGroupe(i, j, Grille, x) {
    wi = i - (i % 3);
    wj = j - (j % 3);
    for (i = wi; i < wi + 3; i++)
        for (j = wj; j < wj + 3; j++)
            if (Grille[i][j] == x)
                return false;
    return true;
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
    //ReplaceT(Grille);
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
    //ReplaceT(Grille);
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

function RazPxC(){
    for (let i = 0; i < 81; i++)
        for (let j = 0; j < 9; j++)
            Tp[i][j] = 0;
}

function ResoudreCSTN(Grille) {
    // Remet à zéro la liste des possibles
    RazPxC();
    // Créer la liste des possible pour chaque case
    PxC(0, Grille);
    // Boucle tant que des cases sont solutionées
    do {
        // Traque les naked twins et MAJ la liste des possibile 
        Twin();
        CbtC(Grille);
        CSU(Grille);
    } while (CSU(Grille) || CbtC(Grille))
    // Vérifie si la grille est terminé ou non et determine la validité de celle ci 
    if (grilleTermine(Grille)) {
        //ReplaceT(Grille);
        return Grille;
    } else
        console.log('La grille est incomplete !');
}