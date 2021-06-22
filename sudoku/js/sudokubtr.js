// Backtrack algo

let nombreboucle = 0;
function ResoudreBTR(Position, Grille) {
    nombreboucle+=1;
    // Si la position est egal à 81 alors le sudoku est résolu
    if (Position == 81)
        return true;
    const i = Math.trunc(Position / 9);
    const j = Position % 9;
    // Si la grille selectionnée n'est pas égal à 0 (déjà remplie) alors on passe à la suivante
    if (Grille[i][j] != 0)
        return ResoudreBTR(Position + 1, Grille);
    // Test chaque nombre possible pour la position donnée
    for (let k = 1; k <= 9; k++) {
        if (AbsLigne(i, Grille, k) && AbsColonne(j, Grille, k) && AbsGroupe(i, j, Grille, k)) {
            Grille[i][j] = k;
            if (ResoudreBTR(Position + 1, Grille)) {
                return true;
            }
        }
    }
    Grille[i][j] = 0;
    return false;
}
// Fin //

function MainTable(Grille) {
    SupprTableau();
    Tableau(Grille);
}

function TableRsdr(Grille) {
    if (grilleVerif(Grille)) {
        SupprTableau();
        ResoudreBTR(0, Grille);
        Tableau(Grille);
    } else {
        alert("La grille n'est pas valide !");
    }
    console.log(nombreboucle);
    nombreboucle=0;
}

function RemiseZero(Grille){
    RAZ(Grille);
    MainTable();
}

function ELG(Grille){
    for (i = 0; i < 9; i++) {
        for (j = 0; j < 9; j++) {
            const Num  = document.getElementById(i + '' + j).innerHTML;
            const INum = parseInt(Num);
            if (Num == '')
                Grille[i][j] = 0;
            else
                Grille[i][j] = INum;
        }
    }
}

function RAZ(Grille) {
    for (i = 0; i < 9; i++)
        for (j = 0; j < 9; j++)
            Grille[i][j] = 0;
}

// Fonctions d'affichage
function RemplissageR(Grille) {
    for (i = 0; i < 9; i++)
        for (j = 0; j < 9; j++)
            Grille[i][j] = 1;
}

// onkeyup='CO()' onkeydown='UCM()'
function CO(div) {
    if (!(div.innerHTML > 0 && div.innerHTML <= 9))
        div.innerHTML = null;
}

function UCM(toto) {
    if (toto.innerHTML.length > 0)
        toto.innerHTML = null;
}


// Fonction bordel

/* function test() {
    // True si '7' est present dans la ligne '0' et false si il est absent
    if (PrstLigne(0, 7) == true)
        console.log('True L');
    else
        console.log('False L');
    // True si '9' est present dans la Colonne '2' et false si il est absent
    if (PrstColonne(2, 9) == true)
        console.log('True C');
    else
        console.log('False C');
    // True si '1' est present dans le Groupe 3-3 et false si il est absent
    if (PrstGroupe(3, 3, 1) == true)
        console.log('True G');
    else
        console.log('False G');
} */



////// y-x \\\\\\
// 1-1 ; 1-2 ; 1-3
// 2-1 ; 2-2 ; 2-3
// 3-1 : 3-2 ; 3-3
// 1x3=3 3-3=0
// 2x3=6 6-3=3 
// 3x3=9 9-3=6


/* const Grid1 = [
    [9, 0, 0, 1, 0, 0, 0, 0, 5],
    [0, 0, 5, 0, 9, 0, 2, 0, 1],
    [8, 0, 0, 0, 4, 0, 0, 0, 0],
    [0, 0, 0, 0, 8, 0, 0, 0, 0],
    [0, 0, 0, 7, 0, 0, 0, 0, 0],
    [0, 0, 0, 0, 2, 6, 0, 0, 9],
    [2, 0, 0, 3, 0, 0, 0, 0, 6],
    [0, 0, 0, 2, 0, 0, 9, 0, 0],
    [0, 0, 1, 9, 0, 4, 5, 7, 0]
]; */

